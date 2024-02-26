<?php session_start(); ?>


<?php
include('traitement/config.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <title>USTHB - classement licence</title>
  <?php include_once('head.php'); ?>
  <script src="jquery.min.js"></script>
  <script>
      $(document).ready(function(){
          $('#faculte').on('change',function(){
              var faculteID = $(this).val();
              if(faculteID){
                  $.post(
                      "traitement/ajax.php",
                      {faculte: faculteID},
                      function(data){
                          $('#specialite').html(data);
                      }
                  );
              }else{
                  $('#specialite').html("<option>Choisissez une Faculté d'abord</option>");
              }
          });
      });
      $('#chercher').on('click', function() {
alert("msdlfksdmfkmdf");
    var val = $("#mat").val(); 
   if(val != "")
    {

              $.ajax({
              url: 'Matricule.php',
              data: {mat: val},
              type: 'POST',
              success: function(data) {
                data = data.replace(/^\s+|\s+$/g, '');
                var tab = new Array();
                tab = data.split("+");

                matricule = document.getElementById('matricule');
                nom= document.getElementById('name');
                pname= document.getElementById('pname');

                matricule.innerHTML =val;
                nom.innerHTML =tab[0];
                pname.innerHTML =tab[1];
              
                
                
              }
           });
    }

});
      function show_hide(x)
{

   
   if(x==1)
  {
     document.getElementById("choix").style.display="block";
  }
  else
  { if(x==0)
    {
    document.getElementById("choix").style.display="none";
    document.getElementById("infor").style.display="none";
    }
    else
    { 
document.getElementById("infor").style.display="block";
      var val = $("#mat").val(); 
   if(val != "")
    {

              $.ajax({
              url: 'Matricule.php',
              data: {mat: val},
              type: 'POST',
              success: function(data) {
                data = data.replace(/^\s+|\s+$/g, '');
                var tab = new Array();
                tab = data.split("+");

                matricule = document.getElementById('matricule');
                nom= document.getElementById('name');
                pname= document.getElementById('pname');

                matricule.innerHTML =val;
                nom.innerHTML =tab[0];
                pname.innerHTML =tab[1];
              
                
                
              }
           });
    }
    }

  }
  
  
 return;
}

      $(document).ready(function(){
          $('#specialite').on('change',function(){
              var specialiteID = $(this).val();
              if(specialiteID){
                  $.post(
                      "traitement/ajax.php",
                      {specialite: specialiteID},
                      function(data){
                          $('#annee').html(data);
                      }
                  );
              }else{
                  $('#annee').html("<option>Choisissez une Spécialité d'abord</option>");
              }
          });
      });
  </script>
</head>

<body>

  <?php include_once('header.php'); ?>
  <?php include_once('sidebar.php'); ?>
  
  <main id="main" class="main">

  <div class="pagetitle">
      
    
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-xl- 12">

          <div class="card">
            <div class="card-body">
              
              <br>
                <form action="Annexe/calcule.php" method="POST">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Faculté</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" id="faculte" name="faculte">
                            <option selected>Choisissez une Faculté</option>
                            <?php
                            $tsql="select distinct faccode, fac from faculte0000 order by fac";
                            $getresults2 = $conn->prepare($tsql);
                            $getresults2->execute();
                            $results = $getresults2->fetchAll(PDO::FETCH_BOTH);
                            foreach($results as $r){
                                switch ($r['faccode']) {
                                    case 'IF':
                                        echo "<option value='".$r["faccode"]. "'>INFORMATIQUE</option>";
                                        break;
                                    case 'IE':
                                        echo "<option value='".$r["faccode"]. "'>ELECTRONIQUE</option>";
                                        break;
                                    case 'GM':
                                        echo "<option value='".$r["faccode"]. "'>GENIE MECANIQUE</option>";
                                        break;
                                    case 'CI':
                                        echo "<option value='".$r["faccode"]. "'>GENIE DES PROCEDES</option>";
                                        break;                               
                                    default:
                                        echo "<option value='".$r["faccode"]. "'>".$r["fac"]."</option>";                              
                                        break;
                                }
                                
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Spécialité</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" id="specialite" name="specialite">
                            <option selected>Choisissez une Spécialité</option>
                            </select>
                        </div>
                  </div>
                  <br>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Année</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" id="annee" name="annee">
                            <option selected>Choisissez une Année</option>
                            </select>
                        </div>
                  </div>
                  <br>
                  <div class="form-group">
            
            <input onclick="show_hide(0)" type="radio" name="choix"  />
            <label > Promo </label>
            <input onclick="show_hide(1)" type="radio" name="choix" />
            <label > Etudiant </label>
        </div>
        <br>
        <br>
        <div id="choix" name ="mat" style="display: none;">
          <label > Matricule </label>
            <input type="text" name="mat" id="mat"/>  
       
         <button type="button" id="chercher" class="chercher" onclick="show_hide(2)"><i class="bi bi-search"></i></button>
  

        </div>
        
     <div >   
        <table id="infor" class="table"  style="display: none;">
  <thead>
    <tr>
      
      <th scope="col">Matricule</th>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td id="matricule"></td>
        <td id="name"></td>
        <td id="pname"></td>
    </tr>
    
  </tbody>
</table>
</div>
                <div class="text-center">
                    <div class="col-xl-12">
                    <button type="submit" class="btn btn-primary">Générer</button>
                    </div>
                </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </section>      
    </main><!-- End #main -->


<?php include_once('script.php'); ?>
</body>

</html>



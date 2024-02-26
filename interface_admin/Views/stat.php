<?php session_start(); 
$serverName = "DESKTOP-O7N9N47";
$connectionInfo = array('Database'=>'usthb90000L');
$conn=sqlsrv_connect($serverName,$connectionInfo);
$result="";
if($conn){

}else{
     echo "Unable to connect<br />";
     die( print_r(sqlsrv_errors(), true));
}
//$id=$_SESSION['user'];
//$tsql1="SELECT STRUCT FROM USER0000 WHERE ID='$id'";
    // $stmt1=sqlsrv_query($conn,$tsql1);
     //$row=sqlsrv_fetch_array($stmt1);

//$tsql2="SELECT FACCODE FROM faculte0000 WHERE FAC='$row[0]'";
    // $stmt2=sqlsrv_query($conn,$tsql2);
     //$row2=sqlsrv_fetch_array($stmt2);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Statistique </title>
  <script src="Chart.min.js"></script>
   <script> </script>
  <?php include_once('../includes/head.php'); ?>
</head>

<body>

  <?php include_once('../includes/header.php'); ?>
  <?php include_once('../includes/sidebar.php'); ?>
  
 <main id="main" class="main">
<section>
    <div class="pagetitle">
      <br>
    
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" id="faculte" name="faculte" >
                            <option selected>Choisissez une Specialité</option>
                            <?php

     $tsql="select distinct specialite from filiere0000 where faccode='IF'
          AND specialite!=' ' ";
     $stmt=sqlsrv_query($conn,$tsql);
     if($stmt==false)
     {
        echo "Error<br />";
        die( print_r(sqlsrv_errors(), true));
     }
     else
     {
        while ($row=sqlsrv_fetch_array($stmt))
        echo "<option value='".$row["specialite"]. "'>".$row["specialite"]."</option>";
     }
     
?>
                            </select>
                        </div>
      
    </div><!-- End Page Title -->
  
                        
                    
    <div class="graph" style="width:1000px;">
      <canvas id="myChart" ></canvas>
    </div>
    
<script>
  
 
const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['2017', '2018', '2019', '2020','2021'],
        datasets: [{
            label: 'Diplomé',
            data: [119, 170, 230, 222, 111],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
</section>
  </main><!-- End #main -->
    <?php include_once('../includes/script.php'); ?>
 
</body>
  
</html>


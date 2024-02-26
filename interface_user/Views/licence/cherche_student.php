<?php 
session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title>USTHB -Recherche etudiant licence</title>
  <?php include_once('head.php'); ?>

</head>

<body>

  <?php include_once('../../includes/header.php'); ?>
  <?php include_once('sidebar.php'); ?>
  
  <main id="main" class="main">
  <div class="pagetitle">
    <h1>Classement étudiant(e)</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Classement</a></li>
          <li class="breadcrumb-item">Licence</li>
          <li class="breadcrumb-item active">Chercher un étudiant</li>
          <li class="breadcrumb-item active">Informations classement</li>
        </ol>
      </nav>
    
    </div><!-- End Page Title -->
<?php if(empty($h) or $h==0){ ?>
    <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
              <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Remarque</h4>
                <p>Vous pouvez effectuer une recherche par matricule ou bien par Nom et Prénom (deux champs obligatoires)</p>
                <hr>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
<?php 
}else{
  if($h==3){
     $h;
    ?>
     <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Remarque</h4>
                <p>Vous pouvez effectuer une recherche par matricule ou bien par Nom et Prénom (deux champs obligatoires)</p>
                <hr>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
    <?php
    $h=0;
     $h;
  }
  else{
    if($h==1){
       $h;
      ?>
       <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Remarque</h4>
                <p>Vous pouvez effectuer une recherche par Matricule ou bien par Nom et Prénom (les deux champs sont obligatoires)</p>
                <hr>
                <p class="mb-0">Remplissez le champ Nom</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
      <?php
      $h=0;
       $h;
    }
    else {
      if($h==2){  $h;
        ?>
         <div class="card">
              <div class="card-body">
                <h5 class="card-title"></h5>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <h4 class="alert-heading">Remarque</h4>
                  <p>Vous pouvez effectuer une recherche par matricule ou bien par Nom et Prénom (les deux champs sont obligatoires)</p>
                  <hr>
                  <p class="mb-0">Remplissez le champ Prénom</p>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php
        $h=0;
         $h;
      }
    }
  }
}
?>
              <!-- Multi Columns Form -->
              <form class="row g-3" action="verif_che.php" method="POST">
                <div class="col-md-12">
                  <label for="inputName5" class="form-label">Matricule</label>
                  <input type="text" class="form-control" id="inputName5" name="MAT">
                </div>
                
                <div class="col-md-6">
                <label for="inputName5" class="form-label">Nom</label>
                  <input type="text" class="form-control" id="inputName5" name="name">
                </div>
                <div class="col-md-6">
                <label for="inputName5" class="form-label">Prénom</label>
                  <input type="text" class="form-control" id="inputName5" name="pname">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Chercher</button>
                </div>
              </form><!-- End Multi Columns Form -->
            </div>
    </div>

    </main>
   
</body>

</html>


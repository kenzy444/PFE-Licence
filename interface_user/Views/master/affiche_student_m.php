<?php 
session_start();
$_SESSION['mat']=$mat;
include('traitement/config.php');
include('traitement/cherche.php');
include ('traitement/filtre.php');
$_SESSION['MAT']="";
$tsql="select * from [usthb90000M].[dbo].[CLASSEMENTL] where mat='$mat' and ocode='$ocode' and ANET=$annee order by Rang";
                $getresults2 = $conn->prepare($tsql);
            $getresults2->execute();
            $results = $getresults2->fetchAll(PDO::FETCH_BOTH);
$tsql="select count(*) as c from [usthb90000M].[dbo].[CLASSEMENTL] where ocode='$ocode' and ANET=$annee";
            $getresults2 = $conn->prepare($tsql);
        $getresults2->execute();
        $results3 = $getresults2->fetchAll(PDO::FETCH_BOTH);
foreach($results3 as $r){
  $cmpt=$r['c'];
  $_SESSION['cmpt']=$cmpt;
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <title>USTHB - classement master etudiant</title>
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
          <li class="breadcrumb-item"><a href="index.html">Classement</a></li>
          <li class="breadcrumb-item">Master</li>
          <li class="breadcrumb-item active">Chercher un étudiant</li>
          <li class="breadcrumb-item active">Informations classement d'un étudiant</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
 <?php 
 if(sizeof($results)==0){
    $tsql="delete from [usthb90000M].[dbo].[CLASSEMENTL] where ocode='$ocode' and ANET=$annee";
    $getresults2 = $conn->prepare($tsql);
    $getresults2->execute();
    ?> 
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Cet étudiant(e) n'est pas encore diplomé(e)!
                <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
              </div>
    <?php
}else{
    foreach($results as $row){
    ?>
    <section class="section profile">
      <div class="row">
        <div class="col-xl-12 center">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Informations du classement</h5>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nom et Prénom</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['NAME']." ".$row['PNAME']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date de Naissance</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['DN']; ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Lieu de Naissance</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['LN']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Matricule</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['MAT']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Filière</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['FIL']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Spécialité</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['SPE']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Moyenne semestrielle</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['MSE']; ?>/20</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Moyenne de Classement</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['MC']; ?>/20</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">CLassement </div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['RANG']."/".$cmpt; ?></div>
                  </div>
                </div>
                <form action="../fpdf184/att.php" method="POST">
                <div class="text-center">
                  <button type="submit" class="btn btn-primary"><i class="bi bi-printer"></i>Générer attestation</button>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->
<?php
 }}
 ?>

<?php include_once('../../includes/footer.php'); ?>
<?php include_once('script.php'); ?>
</body>

</html>


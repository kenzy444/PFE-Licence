<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Page d'Accueil -USTHB- </title>
  <?php include_once('../includes/head.php'); ?>
</head>

<body>
   <script> alert("Inscription réussite.".$_SESSION['user']); </script> 
  <?php include_once('../includes/header.php'); ?>
  <?php include_once('../includes/sidebar.php'); ?>
  
  <main id="main" class="main">

    <div class="pagetitle">
      
    </div><!-- End Page Title -->

    <section class="section dashboard" >
      
        
        <!-- Left side columns -->
        
          

             <!-- pics Card -->
             <div class="col-xxl-4 col-xl-12" style="width: 100%; ">

                <div class="card info-card customers-card" style="width: 1000px; height:500px;">

                <div class="card-body"  >
                 <h5 class="card-title">USTHB <span>| Université des sciences et technologies Houari Boumedien</span></h5>

                  <!-- Slides with fade transition -->
                  <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" >
                  <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="../img/usthb.jpg" class="d-block w-100" style="width: 1000px; height:400px;">
                  </div>
                  <div class="carousel-item">
                    <img src="../img/img2.jpg" class="d-block w-100" style="width: 1000px; height:400px;">
                  </div>
                  <div class="carousel-item">
                    <img src="../img/img3.jpg" class="d-block w-100" style="width: 1000px; height:400px;">
                  </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                 </button>

             </div><!-- End Slides with fade transition -->
             
             </div><!-- End pics Card -->
   
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        
    </section>
    

  </main><!-- End #main -->
  <?php include_once('../includes/script.php'); ?>
</body>

</html>

<?php session_start(); ?>

<?php 
 include_once('./../configuration/config.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  
  <title>  Contact </title>
  <?php include_once('../includes/head.php'); ?>
</head>

<body>
  <?php include_once('../includes/header.php'); ?>
  <?php include_once('../includes/sidebar.php'); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Contact</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Contact</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section contact">

      <div class="row gy-4">

        <div class="col-xl-6">

          <div class="row">
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-geo-alt"></i>
                <h3>Addresse</h3>
                <p>BP 32 Bab Ezzouar,<br>16111 - ALGER</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-telephone"></i>
                <h3>Tel</h3>
                <p>+213 (0) 23 93 40 42<br>+213 (0) 23 93 48 26</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-envelope"></i>
                <h3>Email </h3>
                <p>contact@usthb.dz</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-clock"></i>
                <h3>Fax</h3>
                <p>+213 (0) 23 93 48 19</p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-6">
          <div class="card p-4">
            <form action="../forms/contact.php" method="post" class="php-email-form" id="contactform">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Votre Nom" required  data-value-missing=" Nom manquant">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Votre Email" required  data-value-missing=" email manquant">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Objet" required  data-value-missing=" Objet manquant">
                </div>

                <div class="col-md-12">
                  <input type="hidden" name="date" value="<?php echo date("Y-m-d" ); ?>">
                </div>
                

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required data-value-missing=" Message Vide"></textarea>
                </div>


                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message" >Votre Message a été envoyé. Merci!</div>
                  
                  
                  <button type="submit">Envoyer</button>
                </div>
                

              </div>
            </form>
          </div>

        </div>

      </div>

    </section>

  </main><!-- End #main -->

  

  <?php include_once('../includes/footer.php'); ?>
  <?php include_once('../includes/script.php'); ?>

</body>

</html>


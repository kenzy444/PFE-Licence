<?php session_start(); ?>

<?php include("../configuration/fcts.php"); ?>

<?php 
$id =  $_SESSION['user'];
$admin = readAdmin($id);
$postData = $_POST;



try {
    $conn = new PDO("sqlsrv:Server=DESKTOP-O7N9N47;Database=usthb90000L","","");
    //$conn = new PDO("sqlsrv:Server=DESKTOP-3034QEN\SQLEXPRESS;Database=usthb90000L","","");
    $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(isset($postData["password"]) )
     {
        $query = $conn->prepare("SELECT * FROM UTILISATEURS WHERE ID = :id ");
        $query->execute(
            [ 
                'id' => $id,
            ]
            );

         $results = $query->fetchAll(PDO::FETCH_BOTH);
            if (password_verify( $postData["password"],$results[0]["MOT_PASSE"])){
                if( $postData["newpassword"] == $postData["renewpassword"]){
   
                    $insertmessage = $conn->prepare(
                        'UPDATE UTILISATEURS SET
                                            MOT_PASSE = :password
                                            WHERE ID = :id' 
                    );
                    $insertmessage->execute([
                        'password' => $postData["newpassword"],
                        'id' => $id,
                    ]);
                    $message_correct ="Votre Mot de passe a bien été reinitialiser";
                } 
                else{
                    $message = "verifiez le nouveau mot de passe !";
                }
            
            } else {
                $message = "ce mot de passe ne correspond à l'utilisateur !";
            }

     }else {
        $message =  "Saisissez votre mot de passe !";
        }
   }
     
   catch(Exception $e){
    die(print_r($e->getMessage()));
  }

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  
  <title>Profile Utilisateur</title>
  <?php include_once('../includes/head.php'); ?>
</head>

<body>


  <?php include_once('../includes/header.php'); ?>
  <?php include_once('../includes/sidebar.php'); ?>

  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <?php if (! empty($message_correct)) { ?>
      <h4 class="errorMessage"><?php echo $message_correct; ?></h4>
      <?php } ?>
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2><?php echo $_SESSION["ID"] ?></h2>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Details du Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Changer le mot de passe</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">ID</div>
                    <div class="col-lg-9 col-md-8"><?php echo $admin["ID"] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nom Prenom</div>
                    <div class="col-lg-9 col-md-8"><?php echo $admin["NOM_PRENOM"] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $admin["EMAIL"] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Tel</div>
                    <div class="col-lg-9 col-md-8"><?php echo $admin["TEL"] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Faculte</div>
                    <div class="col-lg-9 col-md-8"><?php echo $admin["FACULTE"] ?></div>
                  </div>
                </div>


                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="post" action="">
                    <?php if (! empty($message)) { ?>
                    <p class="errorMessage"><?php echo $message; ?></p>
                    <?php } ?>
                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Mot de passe courant</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">nouveau mot de passe</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-entez le nouveau mot de passe</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Changer de mot de passe</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include_once('../includes/footer.php'); ?>
  <?php include_once('../includes/script.php'); ?>

</body>

</html>


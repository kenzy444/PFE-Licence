<?php
session_start();
include('traitement/config.php');

$spec = $_POST['specialite'];
$_SESSION['spec']=$spec;
$annee = $_POST['annee'];
$_SESSION['annee']=$annee;

include('traitement/filtre.php');

  $tsql="select count(*) as c from [usthb90000M].[dbo].[CLASSEMENTL] where ANET=$annee and DESIGNATION='$spec'";
  $getresults2 = $conn->prepare($tsql);
  $getresults2->execute([$_POST['specialite']]);
  $results = $getresults2->fetchAll(PDO::FETCH_BOTH);
  foreach($results as $r){
    $cmpt=$r['c'];
    $_SESSION['cmpt']=$cmpt;
   }
   $tsql="select * from [usthb90000M].[dbo].[CLASSEMENTL] where ANET=$annee and DESIGNATION='$spec' order by Rang";
   $getresults2 = $conn->prepare($tsql);
   $getresults2->execute([$_POST['specialite']]);
   $results = $getresults2->fetchAll(PDO::FETCH_BOTH);
   $tsql="select FIL_MERS,SPE_MERS from FILSPE_MERS where ocode=(select TOP 1 ocode from filiere0000 where designation=?)";
   $getresults2 = $conn->prepare($tsql);
   $getresults2->execute([$_POST['specialite']]);
   $results1 = $getresults2->fetchAll(PDO::FETCH_BOTH);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <title>USTHB - classement master</title>
  <?php include_once('head.php'); ?>

</head>

<body>

  <?php include_once('../../includes/header.php'); ?>
  <?php include_once('sidebar.php'); ?>
  
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Classement</a></li>
          <li class="breadcrumb-item active"><a href="index.html">Master</a></li>
          <li class="breadcrumb-item active"><a href="generer_class.php">Générer Classement</a></li>
          <li class="breadcrumb-item active"><a href="#">Classement <?php echo $_POST['annee']."/".($_POST['annee']+1);?></a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">

            <div class="pt-3 pb-2">
                    <h5 class="card-title pb-0 fs-4"><span style="font-size: 1.5rem;">Filière </span><?php
                    echo "    \t ";
                      foreach($results1 as $r){
                      echo $r['FIL_MERS'];
                      }
                        ?></h5>
                <h5 class="card-title pb-0 fs-4"><span style="font-size: 1.5rem;">Spécialité </span><?php
                      foreach($results1 as $r){
                      echo $r['SPE_MERS'];
                      }
                        ?></h5>
            </div>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                    <tr>
                        <th scope="col">Rang</th>
                        <th scope="col">Matricule</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">DN</th>
                        <th scope="col">LN</th>
                        <th scope="col">MSE</th>
                        <th scope="col">MC </th>
                        <th scope="col">Catg</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($results as $row){
                          $_SESSION['ocode']=$row['OCODE'];
                        echo '<tr>';
                            echo "<th scope='row'>".$row['RANG']."</th>";
                            echo "<td>".$row['MAT']."</td>";
                            echo "<td>".$row['NAME']."</td>";
                            echo "<td>".$row['PNAME']."</td>";
                            echo "<td>".$row['DN']."</td>";
                            echo "<td>".$row['LN']."</td>";
                            echo "<td>".$row['MSE']."</td>";
                            echo "<td>".$row['MC']."</td>";
                            echo "<td>".$row['categorie']."</td>";
                        echo "</tr>";
                            }
                        ?>
                    </tbody>
               
              </table>
              <!-- End Table with stripped rows -->
              <form action="fpdf184/atts.php" method="POST">
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

<?php include_once('../../includes/footer.php'); ?>
<?php include_once('script.php'); ?>
</body>

</html>


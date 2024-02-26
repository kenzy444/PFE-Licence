<?php
session_start(); 
include 'config.php';

if(isset($_POST['submit'])){
  $ocode = $_POST['ocode'];
  $ddc= $_POST['ddc'];
if($_POST['ocode'] !== null && $_POST['ddc']!== null ){

  $insert = "INSERT INTO DOMAINE_DE_COMP (OCODE , DDC) 
  VALUES ('$ocode',' $ddc')";
  $result = sqlsrv_query($conn,$insert); 
  if($result){
	header('location:Index.php'); 
   }
   else{
	die( print_r( sqlsrv_errors(), true));
   }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" type="x-icon" href="../../img/logo.png">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Ajout d'un domaine</title>
		<?php include_once('head.php'); ?>
		<link
			rel="stylesheet"
			href="css/bootstrap.min.css"
		/>
        <link
			rel="stylesheet"
			href="add.css"
		/>
	</head>

	<body>
		<?php include_once('header.php'); ?>
  <?php include_once('sidebar.php'); ?>

    <main id="main" class="main">
  	
 <section class="section">
		<div class="box justify-content align-items">
			<h1><b>Ajout D'un Domaine</b></h1>
			<form method="post" action="Add.php">
				<!-- ocode input -->
				<div class="form-outline mb-4">
					<label class="form-label" for="form4Example1">OCODE</label>
					<input type="text" name="ocode" id="form4Example1" class="form-control" autocomplete="off" required />
				</div>

				<!-- DDC input -->
				<div class="form-outline mb-4">
					<label class="form-label" for="form4Example3"
						>Domaines De Compétence</label
					>
					<input type="text" class="form-control text" name="ddc" id="form4Example3" autocomplete="off" required/>
				</div>

				<!-- Submit button -->
				<input style ="background-color:#0052a2; color:white; font-weight:bold"
				 type="submit" name="submit" class="btn btn-block btn-lg mb-4" value="Ajouter">
					
				
			</form>
		</div>
		</section>
</main>
	</body>
</html>

<?php
include 'config.php';
// ------------------------------------


if(isset($_GET['modifId'])){
 $id = $_GET['modifId'];
 
 $Values = "SELECT OCODE, DDC From DOMAINE_DE_COMP WHERE ID = $id ";
					
				$stmt =sqlsrv_query($conn, $Values ); 
				if($stmt ){
					while($row=sqlsrv_fetch_array($stmt)){

						$spCode = $row['OCODE'];
						$Domaine = $row['DDC'];
					}
				}

}

// ---------------------------------------
if(isset($_POST['btn'])){
	
  
  $ocode = $_POST['ocode'];
  $ddc= $_POST['ddc'];
   $id= $_POST['id'];
  

 if(!empty($_POST['ocode']) && !empty($_POST['ddc'])  ){
 
  $update = "UPDATE DOMAINE_DC SET OCODE = '$ocode' , DDC = '$ddc' where ID = '$id'";
  $result = sqlsrv_query($conn,$update); 

  if($result){
header("Location: index.php");
   }
   else{
	die( print_r( sqlsrv_errors(), true));
   }
 }
}


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Modification</title>
		<link
			rel="stylesheet"
			href="css/bootstrap.min.css"
		/>
		<link
			rel="stylesheet"
			href="css/formsStyle.css"
		/>
	</head>

	<body>
		<div class="box justify-content align-items">
			<h1>Modification</h1>
			<form method="post" action="Modifier.php">
				<!-- ocode input -->
				<div class="form-outline mb-4" hidden>
					
					<input type="text" name="id" id="form4Example1" class="form-control" autocomplete="off" 
					value=<?php echo $id;?> />
				</div>
				<div class="form-outline mb-4">
					<label class="form-label" for="form4Example1">OCODE</label>
					<input type="text" name="ocode" id="form4Example1" class="form-control" autocomplete="off" 
					value=<?php echo $spCode;?> />
				</div>


				<!-- DDC input -->
				<div class="form-outline mb-4">
					<label class="form-label" for="form4Example3"
						>Domaines De Compétence</label
					>
					<input type="text" class="form-control text" name="ddc" id="form4Example3" autocomplete="off"
					value="<?php echo $Domaine;?>"
					 />
				</div>

				<!-- Submit button -->
				<input style ="background-color:#0052a2; color:white; font-weight:bold"
			    type="submit" name="btn" class="btn btn-block btn-lg mb-4 boutton" value="Modifier"> 
				
					
				
			</form>
		</div>
	</body>
</html>

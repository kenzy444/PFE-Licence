<?php
session_start(); 
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" type="x-icon" href="../../img/logo.png">
	<head>
		<meta charset="utf-8" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, shrink-to-fit=no"
		/>
		<title> Gestion des Domaine De Competence</title>
		 <?php include_once('head.php'); ?>
		 <link rel="stylesheet" href="css/style.css" />
		<link
			rel="stylesheet"
			href="css/bootstrap.min.css"
		/>
		<link
			rel="stylesheet"
			href="css/fonts.css"
		/>
	   <link
			rel="stylesheet"
			href="css/dataTables.bootstrap4.min.css"
		/>
		<link
			rel="stylesheet"
			href="css/Jquery.dataTables.min.css"
		/>
        <script>
		function confirmDelete(self) {
              var id = self.getAttribute("id");
 
             document.getElementById("form-delete-user").id.value = id;
              $("#myModal").modal("show");
        }
		</script>
		
	</head>
	<body>
		<?php include_once('header.php'); ?>
  <?php include_once('sidebar.php'); ?>

  <main id="main" class="main">
  	
 <section class="section">
		<div class="table-responsive py-5">
			<div class="table-wrapper" >
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2><b>Gestion des Domaines</b></h2>
						</div>
						<div class="col-sm-6">
							<button type="button" class="btn btn-dark " >
								<i class="material-icons py-2">&#xE147;</i>
								<span class="py-2"><a href="Add.php" ><b>Ajouter Un Domaine</b></a></span>
							</button>
						</div>
					</div>
				</div>
				
			 <table class="table table-striped table-hover"  id="dataTableid">
				<thead>
		        	<tr>
			 				<th>ID</th>
						    <th>OCODE</th>
							<th>Domaines De Compétences</th>
							<th>Options</th>
							<th></th>
			  				
				  </tr>
				</thead>
				<?php
		
				
				    
					echo	'<tbody>';
                      
					 $Values = "SELECT ID , OCODE, DDC From DOMAINE_DE_COMP";
					
					 $stmt =sqlsrv_query($conn, $Values ); 
					 if($stmt ){
					while($row=sqlsrv_fetch_array($stmt)){

						$id= $row['ID'];
						$ocode = $row['OCODE'];
						$ddc = $row['DDC'];
						
                          
					   
					
					echo	'<tr>';
						echo	"<td>$id</td>";
						echo	"<td>$ocode</td>";
						echo	"<td>$ddc</td>";
						
						echo	'<td>
								<button type="button" class="btn btn-secondary">
								<a href="Modifier.php?modifId='.$id.'" class="text-light">Modifier</a>
								</button>
								</td>'; 
						 
						echo	'<td>
								<button type="button" class="btn btn-danger" 
								id='.$id.' onclick="confirmDelete(this);">
									<a class="text-light">Supprimer</a>
								</button>
								</td>'; 

						
						
					echo	'</tr>';
					} }
				
				echo	'</tbody>';
			
				?>
				</table>
				
			</div>
		</div>
		</div>
		<!-- Alert Box -->
		<div id="myModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
             
            <div class="modal-header">
                <h4 class="modal-title">Suppression</h4>
                <button type="button" class="close" data-dismiss="modal">x</button>
            </div>
 
            <div class="modal-body">
                <p>Souhaitez-vous vraiment supprimer?</p>
                <form method="POST" action="delete.php" id="form-delete-user">
                    <input type="hidden" name="id">
                </form>
            </div>
 
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="submit"  form="form-delete-user" class="btn btn-danger">Oui</button>
            </div>
 
        </div>
    </div>
</section>
</main><!-- End #main -->

       <script src="js/jquery-3.5.js"></script>
       <script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap4.min.js"></script>

       <script>
			 $(document).ready(function () {
              $('#dataTableid').DataTable();
           });
		</script>
		<?php include_once('script.php'); ?>
	</body>
</html>

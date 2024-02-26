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
		<title>GESTION DES COMPTES</title>
		 <?php include_once('head.php'); ?>
		<link
			rel="stylesheet"
			href="user.css"
		/>
		<link
			rel="stylesheet"
			href="css/bootstrap.min.css"
		/>
		<link
			rel="stylesheet"
			href="css/fonts.css"
		/>
		<!-- ----- -->
       <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
       <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css"> -->
	   <link
			rel="stylesheet"
			href="css/dataTables.bootstrap4.min.css"
		/>
		<!-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"> -->
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
		 
		<div class="container-fluid">
		<div class="table-responsive py-5">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2> <b>Gestion Des Comptes Utilisateurs</b></h2>
						</div>
						<div class="col-sm-6">
							<button type="button" class="btn btn-dark ">
								<i class="material-icons py-2">&#xE147;</i>
								<span class="py-2"> <a href="../Ajouter_cmpt_user/insc.php"><b>Ajouter Un Utilisateur</b></a></span>
							</button>
						</div>
					</div>
				</div>
				
			 <table class="table table-striped table-hover"  id="dataTableid">
				<thead>
		        	<tr>
			 				<th>Nom</th>
						    <th>Prenom</th>
							
							<th>ID</th>
							<th>Fonction</th>
							<th>Structure De Rattachment</th>
							<th>Type De Compte</th>
							<th>Statut</th>
							<th>Options</th>
							<th></th>
			  				<th></th>
			  				<th></th>
				  </tr>
				</thead>
				<?php
		
				
				    
					echo	'<tbody>';
                      
					 $tableValues = "SELECT NAME , PNAME, EMAIL,ID, FCT, STRUCT ,STATUTC,TYPEC From USER0000 
					 where TYPEC != 'ADMINRCT'";
					 $stmt =sqlsrv_query($conn, $tableValues ); 
					while($row=sqlsrv_fetch_array($stmt))
					{
						$nom = $row['NAME'];
						$prenom = $row['PNAME'];
						$email = $row['EMAIL'];
						$userId = $row['ID'];
						$fnct = $row['FCT'];
						$struct = $row['STRUCT'];
						$typeCpt= $row['TYPEC'];
				        $statut = $row['STATUTC'];
                          
					   
					
					echo	'<tr>';
						echo	"<td>$nom</td>";
						echo	"<td>$prenom</td>";
						//echo	"<td>$email</td>";
						echo	"<td>$userId</td>";
						echo	"<td>$fnct</td>";
						echo	"<td>$struct</td>";
						echo	"<td>$typeCpt</td>";
						echo	"<td>  $statut</td>";
						
						echo	'<td>
								<button type="button" class="btn btn-danger" 
								id='.$userId.' onclick="confirmDelete(this);">
									<a class="text-light">Supprimer</a>
								</button>
								</td>'; 

						echo	'<td>
								<button type="button" class="btn btn-success">
									<a href="activer.php?activeId='.$userId.'" class="text-light">Activer</a>
								</button>
								</td>'; 
						echo	'<td>	
								<button type="button" class="btn btn-secondary">
									<a href="desactiver.php?passiveId='.$userId.'" class="text-light">Désactiver</a>
								</button>
						        </td>';
					echo	'</tr>';
					}
				

								// ADMIN ACCOUNT 
								$tableValues = "SELECT ID, TYPEC , STATUTC From USER0000
								where TYPEC = 'ADMINRCT'";
							    $stmt =sqlsrv_query($conn, $tableValues ); 
							    while($row=sqlsrv_fetch_array($stmt)){
								  $userId = $row['ID'];
								  $typeCpt= $row['TYPEC'];
								  $statut = $row['STATUTC'];
							   echo	'<tr>';
								  echo	"<td></td>";
								  echo	"<td></td>";
								  echo	"<td></td>";
								  echo	"<td>$userId</td>";
								  
								  echo	"<td></td>";
								  echo	"<td>$typeCpt</td>";
								  echo	"<td>  $statut</td>";
								  echo	"<td></td>";
								  echo	"<td></td>";
								  echo	"<td></td>";
							  echo	'</tr>';
							  } 
								// --------------------
				echo	'</tbody>';
			
				?>
				</table>
				
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
                <p>Souhaitez-vous vraiment supprimer cet utilisateur?</p>
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
</div>
       </div>
<script src="js/jquery-3.5.js"></script>
       <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
       <script src="js/bootstrap.min.js"></script>
		<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
		<script src="js/jquery.dataTables.min.js"></script>
		<!-- <script src="//cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script> -->
		<script src="js/dataTables.bootstrap4.min.js"></script>
		<!-- <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js"></script> -->
		<!--  -->
       <script>
			 $(document).ready(function () {
              $('#dataTableid').DataTable();
           });
		</script>
		</section>
</main>
	<?php include_once('script.php'); ?>
	</body>
</html>

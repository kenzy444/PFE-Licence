<?php

#starts a new session
session_start();
 
#includes a database connection
$serverName = "DESKTOP-O7N9N47";
$connectionInfo = array('Database'=>'usthb90000L');
$conn=sqlsrv_connect($serverName,$connectionInfo);

if($conn){

}else{
     echo "Unable to connect<br />";
     die( print_r(sqlsrv_errors(), true));
}

$msg = "";
#checks if the html form is filled 
if(isset($_POST['submit']) )
{

$user = $_POST['user'];
$password =sha1($_POST['password']);
#searches for user and password in the database
$query = "SELECT * FROM USER0000 WHERE ID='$user' AND MDP='$password' AND STATUTC= 1";
         
$result = sqlsrv_query($conn, $query);  
$row=sqlsrv_fetch_array($result);
#checks if the search was made
if($result === false){
     die( print_r( sqlsrv_errors(), true));
}
#checks if the search brought some row and if it is one only row
if(sqlsrv_has_rows($result) != 1){
       $msg = "User/password Incorrect";
}
else{


#creates sessions
  
     $_SESSION['user'] = $user;
     if( $row[8]=="User")
		{
			
			header("Location: ../interface_user/Views/index.php");
		}
			  else{ echo "string";
			  header("Location: ../interface_admin/Views/index.php");
			}    
		}
}
?>
<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" type="x-icon" href="images/logo.png">
	<head>
		<title>Connexion</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<link
			rel="stylesheet"
			type="text/css"
			href="fonts/font-awesome-4.7.0/css/font-awesome.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
	</head>
	<body>
		
		
         <div class="container">
             <div class="pic">
             <img src="images/logo.jfif" alt="" />
             </div>
					<form name="login" class="login100-form validate-form form" action="main.php" method="POST">
						<span class="login100-form-title">Connexion </span>

						<div class="wrap-input100 validate-input">
							<input
								class="input100"
								type="text"
								name="user"
								placeholder="Nom d'utilisateur"
								required
							/>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-user" aria-hidden="true"></i>
							</span>
						</div>

						<div
							class="wrap-input100 validate-input"
							
						>
							<input
								class="input100 form"
								type="password"
								name="password"
								placeholder="Mot de passe"
								required
							/>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
						</div>
						 <?php 
                        echo '<p style="color:red; margin-left:30px; font-size:14px; font-weight:bold">';
                        echo $msg;
                        echo '</p>';
                        ?>
                        
						<div class="container-login100-form-btn">
							<input class="login100-form-btn" name="submit" type="submit" value="Se connecter">
						</div>
					</form>
                </div>
	</body>
</html>




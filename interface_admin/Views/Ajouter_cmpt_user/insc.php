<?php
session_start(); 
$serverName = "DESKTOP-O7N9N47";
$connectionInfo = array('Database'=>'usthb90000L');
$conn=sqlsrv_connect($serverName,$connectionInfo);

if($conn){

}else{
     echo "Unable to connect<br />";
     die( print_r(sqlsrv_errors(), true));
}
 global $msg1;
 global $msg2;
 global $msg3;

function getData(){

    $info = array();
    $info[1]=$_POST['nom'];
    $info[2]=$_POST['prenom'];
    $info[3]=$_POST['email'];
    $info[4]=$_POST['id'];
    $info[5]= sha1($_POST['mdp']);
    $info[6]= sha1($_POST['cmdp']);
    $info[7]=$_POST['fonction'];
    
    

   return $info;
}
if( isset($_POST['choix']) )
{
    $type=$_POST['choix'];
}
if( isset($_POST['faculte']) )
{

$faculte=$_POST['faculte'];
}

if(isset($_POST['submit']))
{       $infos = getData(); 
              
    if (filter_var($infos[3], FILTER_VALIDATE_EMAIL)) 
    {   $msg3="";

        if($infos[5] == $infos[6])
        {
            $msg2="";

           $var="SELECT * FROM USER0000 WHERE ID='$infos[4]'";
           $result = sqlsrv_query($conn,$var);
         
           if(empty($result[0]))
           {
            $msg1="";
             $sql = "INSERT INTO USER0000 ( NAME , PNAME ,EMAIL,ID, MDP, FCT , STRUCT,STATUTC,TYPEC ) 
                 VALUES ('$infos[1]','$infos[2]','$infos[3]','$infos[4]','$infos[5]','$infos[7]','$faculte',1,'$type')";

                        $result = sqlsrv_query($conn,$sql);   
                        if( $result === false )
                         {
                             die( print_r( sqlsrv_errors(), true));
                         }
                         header("Location: ../Gestion_Users/Index.php");

           }
           else{ $msg1 = "L'Identifiant existe deja!";

           }

        }
        else{ $msg2 = "Les deux mots de passe ne sont pas identiques!";
        }
 

   } 
   else
   { 
       $msg3 = "Adresse email saisie est invalide!";
   }


}          

?>
<!DOCTYPE html>
<html lang="en">

<link rel="shortcut icon" type="x-icon" href="../../img/logo.png">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css" />
<title>Ajouter un compte utilisateur</title>
<?php include_once('head.php'); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">



</head>
<body>
    <?php include_once('header.php'); ?>
  <?php include_once('sidebar.php'); ?>
  <main id="main" class="main">
    
 <section class="section">
<div class="signup-form">

    <form action="insc.php" method="post">
        <div class="form-header">
            <h2>Ajouter un compte utilisateur</h2>
        </div>
        <div class="form-group">
            <label>Nom </label>
            <input type="text" class="form-control" name="nom" required="required" >
        </div>
        <div class="form-group">
            <label>Prénom </label>
            <input type="text" class="form-control" name="prenom" required="required" >
        </div>
        
        
        <div class="form-group">
            <label>Adresse Email</label>
            <input type="email" class="form-control" name="email" required="required" onblur="ValidateEmail(this.value)">
        </div>
         <?php 
                        echo '<p style="color:red; margin-left:30px; font-size:14px; font-weight:bold">';
                        echo $msg3;
                        echo '</p>';
                        ?>
        <div class="form-group">
            <label>Fonction</label>
            <input type="fct" class="form-control" name="fonction" required="required" id="fct">
        </div> 
        <div class="form-group">
            <label>Structure de rattachement</label>
            <select id="faculte" class="form-control" name="faculte">
                 <option selected disabled>choisir faculte</option>
      <?php

     $tsql="select fac,FACCODE from faculte0000 ";
     $stmt=sqlsrv_query($conn,$tsql);
     if($stmt==false)
     {
        echo "Error<br />";
        die( print_r(sqlsrv_errors(), true));
     }
     else
     {
        while ($row=sqlsrv_fetch_array($stmt))
        echo "<option value='".$row["FACCODE"]."-".$row["fac"]. "'>".$row["FACCODE"]."-".$row["fac"]."</option>";
     }
     
?>
              

            </select>
        </div> 
        <div class="form-group">
            <label>Type(adm/user)</label>
            <select id="choix" class="form-control" name="choix">
                 <option selected disabled>Choisir Type</option>
                 <option >Admin</option>
                 <option >User</option>
               </select>  
        <div class="form-group">
            <label>Identifiant</label>
            <input type="id" class="form-control" name="id" required="required" id="id">
        </div> 
        <?php 
                        echo '<p style="color:red; margin-left:30px; font-size:14px; font-weight:bold">';
                        echo $msg1;
                        echo '</p>';
                        ?>
        <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" class="form-control" name="mdp" required="required" id="mdp">
        </div>
        <div class="form-group">
            <label>Confirmer mot de passe</label>
            <input type="password" class="form-control" name="cmdp" required="required" id="cmdp">
        </div>
<?php 
                        echo '<p style="color:red; margin-left:30px; font-size:14px; font-weight:bold">';
                        echo $msg2;
                        echo '</p>';
                        ?>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg">Ajouter</button>
        </div>  
    </form>
    <script type="text/javascript">
//    function ValidateEmail(inputText)
//     {
      
//         var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
//         if(!inputText.match(mailformat))
//         {
//         alert('Adresse mail saisie invalide');

//     }
//   }

  function border() {
    document.getElementByName('nom').style.color = 'red';
  }

  

</script>


        </section>
</main>
    <?php include_once('script.php'); ?>
</body>
</html>
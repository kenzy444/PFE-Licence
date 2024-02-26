<?php
include 'config.php';

if(isset($_POST['id']) ){
    $Id = $_POST['id'];
    $tsql="delete from DOMAINE_DE_COMP where ID = '$Id'";
    $stmt=sqlsrv_query($conn,$tsql);

    if($stmt){
        header('location:Index.php');
    }
    else{
	die( print_r( sqlsrv_errors(), true));

    }
}
?>
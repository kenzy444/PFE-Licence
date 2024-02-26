<?php
include 'config.php';

if(isset($_POST['id']) ){
    $userId = $_POST['id'];
    $tsql="delete from USER0000 where ID = '$userId'";
    $stmt=sqlsrv_query($conn,$tsql);

    if($stmt){
        header('location:Index.php');
    }
    else{
	die( print_r( sqlsrv_errors(), true));

    }
}
?>
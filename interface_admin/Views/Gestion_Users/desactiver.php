<?php
include 'config.php';

if(isset($_GET['passiveId'])){
    $userId = $_GET['passiveId'];

    $tsql=" update USER0000 set 
	 STATUTC = 0
	 where ID='$userId' and TYPEC != 'ADMINRCT'";
     $stmt=sqlsrv_query($conn,$tsql);

    if($stmt){
        header('location:Index.php');
    }
    else{
	die( print_r( sqlsrv_errors(), true));

    }
}
?>
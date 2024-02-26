<?php
include 'config.php';

if(isset($_GET['activeId'])){
    $userId = $_GET['activeId'];

    $tsql=" update USER0000 set 
	 STATUTC = 1
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
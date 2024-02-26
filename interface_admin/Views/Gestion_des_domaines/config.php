<?php
$serverName = "DESKTOP-O7N9N47";
$connectionInfo = array('Database'=>'usthb90000L');
$conn=sqlsrv_connect($serverName,$connectionInfo);
$result="";
if($conn){

}else{
     echo "Unable to connect<br />";
     die( print_r(sqlsrv_errors(), true));
}


?>
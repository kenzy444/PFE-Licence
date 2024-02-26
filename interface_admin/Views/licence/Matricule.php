
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


if( isset($_POST['mat']) ){


$mat=$_POST['mat'];


$tsql="select NAME,PNAME from ETUDIANT0000 where MAT='$mat'";

     $stmt=sqlsrv_query($conn,$tsql);
     
     if($stmt==false)
     {
        echo "Error<br />";
        die( print_r(sqlsrv_errors(), true));
     }
     else
     {
        $NAME=sqlsrv_fetch_array($stmt);

   
        $result =$NAME[0]."+". $NAME[1];
     }

     
echo $result;
exit;
}

?>
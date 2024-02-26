<?php
$serverName = "DESKTOP-O7N9N47";
$connectionInfo = array('Database'=>'usthb90000L');
$conn=sqlsrv_connect($serverName,$connectionInfo);

if($conn){

}else{
     echo "Unable to connect<br />";
     die( print_r(sqlsrv_errors(), true));
}
require __DIR__ . '/createword.php';
include("../creation_table.php");


$spec = $_POST['specialite'];
$annee = $_POST['annee'];
$mat = $_POST['mat'];
$sql2= " SELECT OCODE FROM CLASSEMENTL WHERE DESIGNATION='$spec' and ANET='$annee'";

                        $result2 = sqlsrv_query($conn,$sql2); 
                        $row=sqlsrv_fetch_array($result2);
                        $ocode=$row[0];

     

$sql2= " SELECT * FROM CLASSEMENTL WHERE ocode='$ocode' and ANET='$annee'";

                        $result2 = sqlsrv_query($conn,$sql2); 
                        $row=sqlsrv_fetch_array($result2);
                        
                      
if(!empty($row))
{   
$mama=$row[0];
echo "<script> alert('$mama');  </script>";
 /*$dir = "Annexe_Licence";
 
// Verifier l'existence du dossier
if(!file_exists($dir)){
    // Tentative de création du répertoire
    if(mkdir($dir)){
        echo "Répertoire créé avec succès.";
    } else{
        echo "ERREUR : Le répertoire n'a pas pu être créé.";
    }
} else{
    echo "ERREUR : Le répertoire existe déjà.";
}
$dir = "Annexe_Licence_".$sp."_".$SAUVSP."";
 
// Verifier l'existence du dossier
if(!file_exists($dir)){
    // Tentative de création du répertoire
    if(mkdir("Annexe_Licence/".$dir, 0777, true)){
        echo "Répertoire créé avec succès.";
    } else{
        echo "ERREUR : Le répertoire n'a pas pu être créé.";
    }
} else{
    echo "ERREUR : Le répertoire existe déjà.";
}


    //$sql2= " SELECT * FROM ANNEXE1 WHERE OCODE='' and SAUV='$annee'";

                        $result2 = sqlsrv_query($conn,$sql2);

    $sql1= "INSERT INTO ANNEXE1 (MAT,NAME,PNAME,DN,LN,OCODE,SAUV,MC,MSE,RANG,CATEGORIE) 
SELECT MAT,NAME,PNAME,DN,LN,OCODE,ANET,MC,MSE,RANG,CATEGORIE 
FROM CLASSEMENTL WHERE SPE='$spec' and ANET='$annee'";

                        $result1 = sqlsrv_query($conn,$sql1);  


$tsql="select MAT from ANNEXE1";
    $stmt=sqlsrv_query($conn,$tsql);
    while ($row=sqlsrv_fetch_array($stmt))
       {    $matricule=$row[0];
            
            $tsql="select distinct ANET,OCODE from CURSUS0000 where MAT='$matricule'";
            $stmt1=sqlsrv_query($conn,$tsql);
            while ($result=sqlsrv_fetch_array($stmt1))
            {
                 $anet=$result[0];
                 $ocode=$result[1];
                $tsql="select distinct MCODE,MODULE,CREDITS from MODULUS0000 where OCODE='$ocode' and ANNEE='$anet' ";
                 $stmt2=sqlsrv_query($conn,$tsql);
                while ($result1=sqlsrv_fetch_array($stmt2))
                {
                    $credit=$result1[2];
                    $module=$result1[1];
                    $mcode=$result1[0];
                    
                    
                    $tsql="select Unite from LMDMODULUS where MCODE='$mcode'";
                    $stmt3=sqlsrv_query($conn,$tsql);
                    $result3=sqlsrv_fetch_array($stmt3);
                    $unite=$result3[0];
                    $tsql="select SESSION,NOTE,SAUV from NOTES0000 where MCODE='$mcode' and MAT='$matricule' ";
                    $stmt4=sqlsrv_query($conn,$tsql);
                    $session="";
                    $note="";
                    while($result2=sqlsrv_fetch_array($stmt4))
                    {
                        $session=$result2[0];
                        $note=$result2[1];
                        $note=number_format($note, 2);
                        $sauv=$result2[2]+1;

                    }
                   // echo $matricule . "\n" . $anet . "\n" .$session. "\n".$unite."\n".$credit."\n".$module."\n".$ocode."\n" .$note."\n" .$sauv."<br>";
                    $module = str_replace("'", "''", $module);
                $sql = "INSERT INTO ANNEXE2 ( MAT ,ANET,SESSION,UNITE, INTITULE , CREDIT,OCODE,NOTE,SAUV) 
                    VALUES ('$matricule','$anet','$session','$unite','$module','$credit','$ocode','$note','$sauv')";

                        $result = sqlsrv_query($conn,$sql);   
                    
                        
                    
                 
                }

            }
      }
*/
} 
else
{ 
    echo "Le classement de cette  specialité n'est pas génerer!".$spec;
}

//


?>
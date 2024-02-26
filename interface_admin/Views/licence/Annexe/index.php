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

/*********************** cas de toute la promo ************************/


// récupérer ocode de spécialité 
//****** création du fichier word********/
//$spec=$_SESSION['spec'];
//$annee=$_SESSION['annee'];
//$sql2= " SELECT OCODE FROM CALSSEMENTL WHERE SPE='$spec' and ANET='$annee'";

                        //$result2 = sqlsrv_query($conn,$sql2); 
 //$ocode=$result2[0];

 $sql= " SELECT MAT FROM ANNEXE1 WHERE OCODE='A901' and SAUV='2017'";

                        $result = sqlsrv_query($conn,$sql); 
                         while ($row=sqlsrv_fetch_array($result))
                         {
                         	creation($row[0]);
                         }



// appeller fonction création (createword.php) en envoyant comme parametre "ocode" et "Licence" Ou "Master"

//$ocode="A901";
//$matricule='191931029096';
//create_annexe_licence($matricule);

/*

// Store the path of source file
$source = 'MyDocument.docx'; 
  
// Store the path of destination file
$destination = 'sortie/MyDocument_copie.docx'; 
  
// Copy the file from /user/desktop/geek.txt 
// to user/Downloads/geeksforgeeks.txt'
// directory
if( !copy($source, $destination) ) { 
    echo "File can't be copied! \n"; 
} 
else { 
    echo "File has been copied! \n"; 
} 


$zip = new ZipArchive();

// Use same filename for "save" and different filename for "save as".
$inputFilename = 'sortie/MyDocument_copie.docx';
$outputFilename = 'sortie/MyDocument_copie.docx';

// Some new strings to put in the document.
$token1 = 'BENABDELAZIZ';
$token2 = 'Sarrah';
$token3 = '11/09/1996';
$token4 = 'BOUDOUAOU';
$token5 = '201500009108';


// Open the Microsoft Word .docx file as if it were a zip file... because it is.
if ($zip->open($inputFilename, ZipArchive::CREATE)!==TRUE) {
    echo "Cannot open :( "; die;
}

// Fetch the document.xml file from the word subdirectory in the archive.
$xml = $zip->getFromName('word/document.xml');

// Replace the tokens.
$xml = str_replace('$nom$', $token1, $xml);

// Write back to the document and close the object
if ($zip->addFromString('word/document.xml', $xml)) { echo 'File written!'; }
else { echo 'File not written.  Go back and add write permissions to this folder!l'; }

$zip->close();

*/

?>
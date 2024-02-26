<?php
header("Content-Disposition: attachement; filename:='Export.csv'");
include('config.php');
include('config.php');
// $mat=$_SESSION['mat'];
// $ocode=$_SESSION['ocode'];
// $annee=$_SESSION['annee'];
// $spec= $_SESSION['spec'];
// $cmpt=$_SESSION['cmpt'];

$tsql="select * from [usthb90000L].[dbo].[CLASSEMENTL] where ocode='B902' and ANET = 2018 order by RANG";
            $getresults2 = $conn->prepare($tsql); 
        $getresults2->execute();
        $results = $getresults2->fetchAll(PDO::FETCH_BOTH);
        ?>
"MAT";"NAME";"PNAME";"DN";"LN";"OCODE";"FIL";"SPE";"DESIGNATION";"ANET";"SECT";"MOY1";"CRACQ1";"session1";"SAUV1";"MOY2";"CRACQ2";"session2";"SAUV2";"MOY3";"CRACQ3";"session3";"SAUV3";"MOY4";"CRACQ4";"session4";"SAUV4";"MOY5";"CRACQ5";"session5";"SAUV5";"MOY6";"CRACQ6";"session6";"SAUV6";"MOYL1";"INS1";"MOYL2";"INS2";"MOYL3";"INS3";"MSE";"R";"S";"D";"MC";"RANG";"categorie"
<?php
foreach($results as $row){
    echo '"'.$row['MAT'].'";"'.$row['NAME'].'";"'.$row['PNAME'].'".';
}
?>
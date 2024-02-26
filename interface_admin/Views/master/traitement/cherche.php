<?php
include('config.php');
$tsql="select max(sauv) as sauvm from cursus0000 where mat=? group by mat";
$getresults2 = $conn->prepare($tsql);
$getresults2->execute([$mat]);
$results = $getresults2->fetchAll(PDO::FETCH_BOTH);
foreach($results as $row){
    $annee=$row['sauvm'];
    $_SESSION['annee']=$annee;
}
$tsql="select ocode from cursus0000 where mat=? and sauv=$annee";
$getresults2 = $conn->prepare($tsql);
$getresults2->execute([$mat]);
$results = $getresults2->fetchAll(PDO::FETCH_BOTH);
foreach($results as $row){
    $ocode=$row['ocode'];
    $_SESSION['ocode']=$ocode;
}
$tsql="select designation from FILIERE0000 where ocode='$ocode'";
$getresults2 = $conn->prepare($tsql);
$getresults2->execute();
$results = $getresults2->fetchAll(PDO::FETCH_BOTH);
foreach($results as $row){
    $spec=$row['designation'];
    $_SESSION['spec']=$spec;
}
?>
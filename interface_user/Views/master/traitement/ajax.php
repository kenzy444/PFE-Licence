<?php
include ('config.php');
if(isset($_POST['faculte']) && !empty($_POST['faculte'])){
$faculte= $_POST['faculte'];
echo "<option selected>Choisissez une Spécialité</option>";
// récupérer les noms de spécialité de la faculté choisie 
$tsql="select distinct designation from filiere0000 where faccode IN (select faccode from faculte0000 where faccode='$faculte')
AND specialite!=' ' order by designation";
    $getresults2 = $conn->prepare($tsql);
$getresults2->execute();
$results = $getresults2->fetchAll(PDO::FETCH_BOTH);
foreach($results as $r){
    $tsql="select distinct specialite from filiere0000 where designation='".$r['designation']."' and specialite!=' '";
    $getresults2 = $conn->prepare($tsql);
    $getresults2->execute();
    $results2 = $getresults2->fetchAll(PDO::FETCH_BOTH);

    for($i=0;$i<1;$i++){
            echo "<option value='".$r["designation"]. "'>".$results2[$i]["specialite"]."</option>";    
    }    
}
}else{
echo '<h1>ERROR</h1>';
}

if(isset($_POST['specialite']) && !empty($_POST['specialite'])){
    $specialite=$_POST['specialite'];
    echo "<option selected>Choisissez une Année</option>";
    // récupérer les années ouù la spécialité existais
    $tsql="select distinct sauv from CURSUS0000 where ocode IN (select ocode from filiere0000 where designation='$specialite')
    and sauv > 0 order by sauv asc";
        $getresults2 = $conn->prepare($tsql);
    $getresults2->execute();
    $results = $getresults2->fetchAll(PDO::FETCH_BOTH);
    foreach($results as $r){
        echo "<option value='".$r["sauv"]. "'>".$r["sauv"]."/".($r["sauv"]+1)."</option>";
    }
    }else{
    echo '<h1>ERROR</h1>';
    }
?>
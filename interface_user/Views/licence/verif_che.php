<?php
include('traitement/config.php');
if(!empty(trim($_POST['MAT']))){
$mat = $_POST['MAT'];
include('affiche_student.php');
}else{
    if(!empty(trim($_POST['name'])) && !empty(trim($_POST['pname']))){
        $tsql="select mat from ETUDIANT0000 where name=? and pname=?";
        $getresults2 = $conn->prepare($tsql);
        $getresults2->execute([trim($_POST['name']),trim($_POST['pname'])]);
        $results = $getresults2->fetchAll(PDO::FETCH_BOTH);
        foreach($results as $row){
            $mat=$row['mat'];
        }
        include('affiche_student.php');
    }
    else{
        if(empty(trim($_POST['name'])) && !empty(trim($_POST['pname']))){
            $h=1;
            include('cherche_student.php');
        exit();
        }
        else{
            if(!empty(trim($_POST['name'])) && empty(trim($_POST['pname']))){
                $h=2;
                include('cherche_student.php');
            exit();
            }
            else{
                    $h=3;
                    include('cherche_student.php');
                exit();
           
            }
        }
    }
}
?>
<?php
session_start();
include('../traitement/config.php');
require('fpdf.php');
$mat=$_SESSION['mat'];
$ocode=$_SESSION['ocode'];
$annee=$_SESSION['annee'];
$spec= $_SESSION['spec'];
$cmpt=$_SESSION['cmpt'];
$tsql="select top 1 fac from faculte0000 where faccode=(select top 1 faccode from filiere0000 where ocode='$ocode')";
                $getresults2 = $conn->prepare($tsql);
            $getresults2->execute();
            $results = $getresults2->fetchAll(PDO::FETCH_BOTH);
    foreach($results as $r){
    $faculte= $r['fac'];
    }
    if(!empty($mat)){
    $tsql="select TOP 1 * from [usthb90000M].[dbo].[CLASSEMENTL] where mat='$mat' and ocode='$ocode' and ANET = $annee order by RANG";
                $getresults2 = $conn->prepare($tsql); 
            $getresults2->execute();
            $results = $getresults2->fetchAll(PDO::FETCH_BOTH);
            foreach($results as $r){
                $filiere= $r['FIL'];
            }
        }else{
            $tsql="select * from [usthb90000M].[dbo].[CLASSEMENTL] where ocode='$ocode' and ANET = $annee order by RANG";
            $getresults2 = $conn->prepare($tsql); 
        $getresults2->execute();
        $results = $getresults2->fetchAll(PDO::FETCH_BOTH);
        foreach($results as $r){
            $filiere= $r['FIL'];
        }
    }

function bold(string $s)
{
    $s= "<b>".$s."</b>";
    return $s;
}

function faculte(string $fac)
{
    switch($fac){
        case 'CHIMIE':
            $fac = "De Chimie";
            break;
        case 'GENIE MECANIQUE ET GENIE DES PROCEDES':
            $fac = "de Génie Mécanique et de Génie des Procédés";
            break;
        case 'GENIE CIVIL':
            $fac = "de Génie Civil";
            break;
        case 'ELECTRONIQUE ET INFORMATIQUE':
            $fac = "d'Electronique et d'Informatique";
            break;
        case 'MATHEMATIQUES':
            $fac = "de Mathématique";
            break;
        case 'PHYSIQUE':
            $fac = "de Physique";
            break;
        case 'SCIENCES BIOLOGIQUES':
            $fac = "des Sciences Biologiques";
            break;
        case "SCIENCES DE LA TERRE, DE GEOGRAPHIE ET DE L'AMENAGEMENT DU TERRITOIRE":
            $fac = "des Sciences de la Terre, et de Géographie et de l'Aménagement du territoire";
            break;
        default:
            print "erreur";
            break;
    }
    return $fac;
}

function jour(string $jour)
{
    switch ($jour){
        case 'Monday': 
            $jour='Lundi';
            break;
        case 'Tuesday': 
            $jour='Mardi';
            break;
        case 'Wednesday': 
            $jour='Mercredi';
            break;
        case 'Thursday': 
            $jour='Mercredi';
            break;
        case 'Friday': 
            $jour='Vendredi';
            break;
        case 'Saturday': 
            $jour='Samedi';
            break;
        case 'Sunday': 
            $jour='Dimanche';
            break;
        default:
            // print "error";
            break;
    }
    return $jour;
}

function mois(string $mois)
{
    switch ($mois){
        case 'January': 
            $jour='Janvier';
            break;
        case 'February': 
            $jour='Février';
            break;
        case 'March': 
            $jour='Mars';
            break;
        case 'April': 
            $jour='Avril';
            break;
        case 'May': 
            $jour='Mai';
            break;
        case 'June': 
            $jour='Juin';
            break;
        case 'July': 
            $jour='Juillet';
            break;
        case 'August': 
            $jour='Août';
            break;
        case 'September': 
            $jour='Septembre';
            break;
        case 'October': 
            $jour='Octobre';
            break;
        case 'November': 
            $jour='Novembre';
            break;
        case 'December': 
            $jour='Décembre';
            break;
        default:
            // print "error";
            break;
    }
    return $jour;
}

class PDF extends FPDF
{

function Header()
{

    $this->Image('logo.png',15,6,30);

    $this->Image('header.png',70,6,110);

    $this->SetFont('Arial','B',11);

    $this->Cell(80);

    $this->Cell(70,15,utf8_decode('Université des Sciences et de Technologie  Houari Boumediene'),0,0,'C');

    $this->Ln(10);
 
    $this->Image('ligne.png',50,20,150);
}


function Footer()
{
    
    $this->SetY(-15);    
}
}


$pdf = new PDF();
$pdf->AliasNbPages();


    foreach($results as $r){
    $pdf->AddPage();
    $pdf->Ln(7);
    
    $pdf->Cell(80);
  
    $pdf->SetFont('Arial','',15);

    $pdf->Cell(70,0,utf8_decode("Faculté ".faculte($faculte)),0,0,'C');
    $pdf->Ln(7);

    $pdf->Cell(80);

    $pdf->SetFont('Arial','',15);

    $pdf->Cell(70,0,utf8_decode("Département ".ucfirst (strtolower($filiere))),0,0,'C');

    $pdf->SetFont('Times','',12);
  
    $pdf->Ln(9);

    $pdf->Image('ligne.png',10,38,190);

    $pdf->Cell(120);

    $pdf->SetFont('Times','B',10);

    $pdf->Cell(70,20,utf8_decode('Bab Ezzouar, '.jour(date('l'))." ".date('d')." ".mois(date('F'))." ".date('Y')),0,0,'C');
 
    $pdf->Cell(-130);

    $pdf->SetFont('Times','B',14);

    $pdf->Cell(70,50,utf8_decode('ATTESTATION DE CLASSEMENT FINAL EN MASTER'),0,0,'C');


    $pdf->Ln(40);
  
    $pdf->SetFont('Times','',12);
    $h = 7;
    $retrait = "                     ";
    $pdf->SetLeftMargin(15);
    $pdf->Write($h, utf8_decode("            Je soussigné, Chef de Département Adjoint Chargé de la Scolarité et de la pédagogie au Département Informatique de l'Université USTHB, atteste que l'étudiant(e) : "));
    $pdf->Ln(12);

    $pdf->SetFont('Times','',12);
    $pdf->Write($h, $retrait . utf8_decode("Nom et Prénom :    "));
    $pdf->SetFont('', 'B',12);
    $pdf->Write($h, $r['NAME']."  ".$r['PNAME']."\n");

    $pdf->SetFont('Times','',12);
    $pdf->Write($h, $retrait . utf8_decode("Né(e) le :    "));
    $pdf->SetFont('', 'B',12);
    $pdf->Write($h, $r['DN']." ");
    $pdf->SetFont('Times','',12);
    $pdf->Write($h,utf8_decode("  à   "));
    $pdf->SetFont('', 'B',12);
    $pdf->Write($h, $r['LN']."\n");
    $pdf->SetFont('Times','',12);
    $pdf->Write($h,$retrait .utf8_decode("Matricule:    "));
    $pdf->SetFont('', 'B',12);
    $pdf->Write($h, $r['MAT']."\n");
    $pdf->SetFont('Times','',12);
    $pdf->Write($h,$retrait .utf8_decode("Filière:    "));
    $pdf->SetFont('', 'B',12);
    $pdf->Write($h, $r['FIL']."\n");
    $pdf->SetFont('Times','',12);
    $pdf->Write($h,$retrait .utf8_decode("Spécialité:    "));
    $pdf->SetFont('', 'B',12);
    $pdf->Write($h, $r['SPE']."\n");
    $pdf->Ln(12);
    $pdf->SetLeftMargin(15);
    $pdf->SetFont('Times','',12);
    $pdf->Write($h, utf8_decode("            A obtenu son diplôme de Master à l'année "));
    $pdf->SetFont('Times','B',12);
    $pdf->Write($h, utf8_decode(($r['ANET']+1)));
    $pdf->SetFont('Times','',12);
    $pdf->Write($h, utf8_decode(" avec une moyenne semestrielle de "));
    $pdf->SetFont('Times','B',12);
    $pdf->Write($h, utf8_decode(round($r['MSE'],2)."/20"));
    $pdf->SetFont('Times','',12);
    $pdf->Write($h, utf8_decode(", une moyenne de classement de "));
    $pdf->SetFont('Times','B',12);
    $pdf->Write($h, utf8_decode(round($r['MC'],2)."/20"));
    $pdf->SetFont('Times','',12);
    $pdf->Write($h, utf8_decode(", et un classement au sein de sa promotion de "));
    $pdf->SetFont('Times','B',12);
    $pdf->Write($h, utf8_decode(round($r['RANG'])."/".$cmpt));
    $pdf->SetFont('Times','',12);
    $pdf->Write($h, utf8_decode(" étudiants. L'étudiant(e) est classé dans la catégorie "));
    $pdf->SetFont('Times','B',12);
    $pdf->Write($h, utf8_decode($r['categorie']."."));
    $pdf->Ln(12);
    $pdf->SetFont('Times','',12);
    $pdf->Write($h, utf8_decode("            La moyenne de classement, par rapport à la moyenne semestrielle, tient compte des retards, des rattrapages et des admissions avec dettes."));
    $pdf->Ln(12);
    $pdf->Write($h, utf8_decode("            Cette Attestation est délivrée à l'étudiant pour servir et faire valoir ce que de droit."));
    $pdf->Ln(12);
   
    $pdf->Cell(120);
 
    $pdf->SetFont('Times','',10);
    
    $pdf->Cell(70,20,utf8_decode("Le chef de Département Adjoint "));
    $pdf->Ln(7);
    
    $pdf->Cell(112);
    
    $pdf->SetFont('Times','',10);
  
    $pdf->Cell(70,20,utf8_decode("Chargé de la Scolarité et de la Pédagogies"));

    $pdf->Image('ligne.png',20,250,170);
    $pdf->ln(45);

    $pdf->Cell(82);

    $pdf->SetFont('Arial','B',13);
    $pdf->Cell(20,0,utf8_decode("Département ".ucfirst (strtolower($filiere))."\n"),0,0,'C');

    $pdf->Cell(-39);

    $pdf->SetFont('Times','',9);
    $pdf->Write(13, utf8_decode("B.P. 32 El-Alia, Bab-Ezzouar, Alger 16111 "));
    $pdf->ln(10);

    $pdf->Cell(45);

    $pdf->SetFont('Times','',9);
    $pdf->Write(5, utf8_decode("Tél : 213 (0) 21 24 76 07 Poste 504 et 550  Fax :213 (0) 21 24 76 07"));
    $pdf->ln(4);
}


$pdf->Output();
unset($_SESSION);
?>
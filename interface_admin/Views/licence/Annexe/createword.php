<?php
require("autoloader.php");
 

function creation($mat)
{
  
  $serverName = "DESKTOP-O7N9N47";
  $connectionInfo = array('Database'=>'usthb90000L');
  $conn=sqlsrv_connect($serverName,$connectionInfo);

  if($conn){

  }else{
       echo "Unable to connect<br />";
       die( print_r(sqlsrv_errors(), true));
  }
   $tsql="select * from ANNEXE1 where MAT='$mat'";
        $stmt1=sqlsrv_query($conn,$tsql);
        $result1=sqlsrv_fetch_array($stmt1);
        $nom=$result1[1];
        $prenom=$result1[2];
        $dn=$result1[3];
        $ln=$result1[4];
        $mc=$result1[7];
        $mse=$result1[8];
        $cat=$result1[9];

 $sql="select specialite from filiere0000 where ocode='$result1[5]'";
        $stmt2=sqlsrv_query($conn,$sql);
       $reslt=sqlsrv_fetch_array($stmt2);
        $specialite=$reslt[0];
   $sql="select DESIGNATION from DOMAINE where DOMCODE IN (select DOMCODE from filiere0000 where ocode='$result1[5]')";
 $stmt5=sqlsrv_query($conn,$sql);
 $reslt=sqlsrv_fetch_array($stmt5);
 $domaine=$reslt[0];
     

  $sql="select FIL_MERS from FILSPE_MERS where ocode='$result1[5]'";
    
        $stmt6=sqlsrv_query($conn,$sql);
        $reslt=sqlsrv_fetch_array($stmt6);
        $filiere=$reslt[0];

    $phpWord = new PhpOffice\PhpWord\PhpWord();
$section = $phpWord->addSection( array('marginLeft' => 850, 'marginRight' => 850,
    'marginTop' => 850, 'marginBottom' => 850));
$phpWord->setDefaultFontName('Times New Roman');


/****************** création du premier contenu ******************/

$header = $section->addHeader();
$header->firstPage();


// Add header for all other pages
$subsequent = $section->addHeader();
$textrun = $subsequent->addTextRun();
$textrun->addImage('img/logo.png',
    array(
        'width'         => 40,
        'height'        => 40
    ));

$textrun->addText("   Matricule :  ".$mat."      ", ['name'=>'calibri','size' => 11,'bold' => true]);
$textrun->addText('Nom :                 ', ['name'=>'calibri','size' => 11,'bold' => true]);
$textrun->addText('Prénom :              ', ['name'=>'calibri','size' => 11,'bold' => true]);

$textrun->addImage('img/logo.png',
    array(
        'width'         => 40,
        'height'        => 40
    ));

$textrun = $section->addTextRun();
$textrun->addImage(
   'img/logo.png',
    array(
        'width'            => 60,
        'height'           => 60,
        'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
        'posHorizontal' => 'absolute',
        'posVertical' => 'absolute',
        'posHorizontalRel' => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_PAGE,
        'posVerticalRel'   => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_PAGE,
        'marginLeft'       => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(0.45)),
        'marginTop'        => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(0.55)),
    )
);

$textrun->addText(
   '<w:br/><w:br/>                                                               REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE',
   array('size' => 9, 
      'bold' => true,
      'italic' =>true
    )
);

$textrun->addText(
   '<w:br/>                                             MINISTERE DE L’ENSEIGNEMENT SUPERIEUR ET DE LA RECHERCHE SCIENTIFIQUE<w:br/>                                                    UNIVERSITE DES SCIENCES ET DE LA TECHNOLOGIE HOUARI BOUMEDIENE',
   array('size' => 9, 
      'bold' => true
    )
);
$textrun->addImage(
   'img/logo.png',
    array(
        'width'            => 60,
        'height'           => 60,
        'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
        'posHorizontal' => 'absolute',
        'posVertical' => 'absolute',
        'posHorizontalRel' => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_PAGE,
        'posVerticalRel'   => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_PAGE,
        'marginLeft'       => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(13.45)),
        'marginTop'        => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(0.55)),
    )
);




$section->addText('ANNEXE DESCRIPTIVE AU DIPLOME', ['size' => 14, 'bold' => true], [ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);

$section->addText('<w:br/>La présente annexe descriptive au diplôme donne une information plus complète sur les enseignements suivis par l’étudiant pour obtenir son grade universitaire. Elle assure une meilleure lisibilité des connaissances acquises pendant sa formation lui facilitant ainsi sa mobilité nationale et internationale. Elle est dépourvue de tout jugement de valeur ou déclaration d’équivalence.', ['size' => 11], [ 'align' => 'both' ]);

/********* création contenu informations personnelles ***************/


$section->addText('1. LE TITULAIRE DU DIPLOME', ['size' => 11, 'bold' => true,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)] );

$textrun = $section->addTextRun();
$textrun->addText('Nom: ', ['size' => 11,'bold' => true]);
$textrun->addText($nom, ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);

$textrun = $section->addTextRun();
$textrun->addText('Prénom(s): ', ['size' => 11,'bold' => true]);
$textrun->addText($prenom, ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);

$textrun = $section->addTextRun();
$textrun->addText('Date et lieu de naissance: ', ['size' => 11,'bold' => true]);
$textrun->addText($dn, ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
$textrun->addText('                à  ', ['size' => 11,'bold' => true]);
$textrun->addText($ln, ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);

$textrun = $section->addTextRun();
$textrun->addText('Numéro d’immatriculation: ', ['size' => 11,'bold' => true]);
$textrun->addText($mat, ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);



/********* création contenu informations sur le diplome ***************/

// remplir selon le résultat de la requete avec ocode

$section->addText('2. INFORMATIONS SUR LE DIPLOME:', ['size' => 11, 'bold' => true,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)] );

$diplome='Licence'; // ou master selon l'argument reçu
$textrun = $section->addTextRun();
$textrun->addText('2-1 Intitulé du diplôme: ', ['size' => 11,'bold' => true]);
$textrun->addText($diplome, ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);



$textrun = $section->addTextRun();
$textrun->addText('Domaine : ', ['size' => 11,'bold' => true]);
$textrun->addText($domaine, ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);


$textrun = $section->addTextRun();
$textrun->addText('Filière : ', ['size' => 11,'bold' => true]);
$textrun->addText($filiere, ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);


$textrun = $section->addTextRun();
$textrun->addText('Spécialité : ', ['size' => 11,'bold' => true]);
$textrun->addText($specialite, ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);

// arrêté (texte)
$textrun = $section->addTextRun();
$textrun->addText('Référence du texte règlementaire (circulaire, arrêté ministériel ou interministériel portant habilitation de la formation): ', ['size' => 11,'bold' => true]);
$textrun->addText('Décret exécutif n° 08-265 du 17 Chaâbane 1429 correspondant au 19 août 2008', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);


// informations université
$section->addText('2-2 Etablissement ayant délivré le diplôme: ', ['size' => 11, 'bold' => true,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)] );

$textrun = $section->addTextRun();
$textrun->addText('Dénomination : ', ['size' => 11,'bold' => true]);
$textrun->addText('Université des Sciences et de la Technologie Houari Boumediene', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);


$faculte='Faculté d’électronique et Informatique-Département Informatique';
$section->addText($faculte, ['size' => 11, 'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)] );

$textrun = $section->addTextRun();
$textrun->addText('Adresse : ', ['size' => 11,'bold' => true]);
$textrun->addText('BP 32 EL ALIA 16111 BAB EZZOUAR ALGER', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);

$textrun = $section->addTextRun();
$textrun->addText('Tel : ', ['size' => 11,'bold' => true]);
$textrun->addText('+21321247187  ', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
$textrun->addText('Fax : ', ['size' => 11,'bold' => true]);
$textrun->addText('+21321247187', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
$textrun->addText('Site web :  ', ['size' => 11,'bold' => true]);
$textrun->addText('www.usthb.dz', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);

$textrun = $section->addTextRun();
$textrun->addText('2-3 Langue(s) utilisée(s) pour la formation :  ', ['size' => 11,'bold' => true]);
$textrun->addText('FRANÇAIS', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);

// conditions d'accès change selon $diplome licence ou master

    $condition='Bac+1';
    $niveau='Bac + 03 années';

$textrun = $section->addTextRun();
$textrun->addText('2-4 Condition d’accès : ', ['size' => 11,'bold' => true]);
$textrun->addText($condition, ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
$textrun = $section->addTextRun();
$textrun->addText('2-5 Niveau du diplôme :  ', ['size' => 11,'bold' => true]);
$textrun->addText($niveau, ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);


/********* création contenu les résultat obtenues ***************/
$section->addText('3. INFORMATIONS CONCERNANT LE CONTENU DU DIPLOME ET LES RESULTATS OBTENUS :', ['size' => 11, 'bold' => true,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)] );

$textrun = $section->addTextRun();
$textrun->addText('3-1 Organisation des études et durée officielle du programme:   ', ['size' => 11,'bold' => true]);
$textrun->addText('En présentiel (temps plein). ', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
 
 $section->addText('La formation se déroule sur 06 semestres de 30 crédits chacun. Chaque semestre correspond à une durée de formation de 14 à 16 semaines. Chaque semaine correspond à un volume horaire compris entre vingt (20) et vingt cinq (25) heurs. L’enseignement de la licence est réparti en 6 semestres totalisant chacun 30 crédits (par capitalisation ou par compensation). Ces enseignements sont organisés en Unités d’Enseignement (UE) comprenant des UE fondamental, des UE transversal, des UE de découverte et des UE de méthodologie. ', ['size' => 11], [ 'align' => 'both' ]);

$section->addText('Chaque UE est affectée d’un coefficient et dotée de crédits. Lorsque L’UE est acquise, les crédits qui lui sont alloués sont capitalisables et transférables. Une UE est constituée d’une ou plusieurs matières ; chaque matière est affectée d’un coefficient et dotée de crédits. L’enseignement de la matière est dispensé sous forme de cours magistraux, de travaux dirigés, de travail personnel, stages et projets d’études.   
', ['size' => 11], [ 'align' => 'both' ]);


$textrun = $section->addTextRun();
$textrun->addText('3-2 Résultats obtenus: ', ['size' => 11,'bold' => true]);
$textrun->addText('Renseigner le tableau ci- dessous.', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
$textrun = $section->addTextRun();
$textrun->addText('N.B : ', ['size' => 11,'bold' => true]);
$textrun->addText('Les informations suivantes figurent dans le relevé des notes obtenues par l’étudiant.', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);


/****************** Création du tableau ********************/


 
$table = $section->addTable([
    'borderSize' => 6, 
    'borderColor' => '000000', 
    'afterSpacing' => 0, 
    'Spacing'=> 0, 
    'cellMargin'=> 0,

    
]);




$cellRowSpan = array('vMerge' => 'restart');
$cellRowContinue = array('vMerge' => 'continue');
$cellColSpan = array('gridSpan' => 5);

$table->addRow();
$table->addCell(2000)->addText("Code",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(9000)->addText("Intitulé de l’UE",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(1000)->addText("Crédits",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(1000)->addText("Grade",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(2000)->addText("Date obtention",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(2000)->addText("Code",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(9000)->addText("Intitulé de l’UE",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(1000)->addText("Crédits",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(1000)->addText("Grade",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(2000)->addText("Date obtention",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);


$table->addRow();
$table->addCell(4000, $cellColSpan)->addText("Premier Semestre",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(4000, $cellColSpan)->addText("Deuxième Semestre",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
// premiere année 
 $tsql="select OCODE from ANNEXE2 where MAT='$mat' and ANET=1";
        $stmt=sqlsrv_query($conn,$tsql);
        $result=sqlsrv_fetch_array($stmt);
        $ocodeL1=$result[0];

 $tsql1="select distinct UNITE from ANNEXE2 
where ocode='$ocodeL1' and (SESSION='JANV' or SESSION='RJANV');";
$stmt1=sqlsrv_query($conn,$tsql1);

$tsql5="select distinct UNITE from ANNEXE2 
where ocode='$ocodeL1' and (SESSION='JUIN' or SESSION='RJUIN');";
$stmt5=sqlsrv_query($conn,$tsql5);
        $uniteS1=array();
        $uniteS2=array();
        while($result5=sqlsrv_fetch_array($stmt5))
          $uniteS2[]=$result5[0];

        while($result=sqlsrv_fetch_array($stmt1))
          $uniteS1[]=$result[0];


        $moduleS1= array();
        $moduleS2= array();
      
         foreach($uniteS1 as $valeur) 
            {  
                  $tsql2="select distinct INTITULE from ANNEXE2 where ocode='$ocodeL1' and UNITE='$valeur'";
                  $stmt2=sqlsrv_query($conn,$tsql2);

                  while($result2=sqlsrv_fetch_array($stmt2))
                  {
                    $moduleS1[$result2[0]]=$valeur;
                    


                  }
            }

            foreach($uniteS2 as $valeur) 
            {  
                  $tsqll="select distinct INTITULE from ANNEXE2 where ocode='$ocodeL1' and UNITE='$valeur'";
          $stmtt=sqlsrv_query($conn,$tsqll);
                  while($resultt=sqlsrv_fetch_array($stmtt))
                  {
                    $moduleS2[$resultt[0]]=$valeur;
                  }
            }


             $i=0; $j=1;

             $unite1=""; $unite2="";
             foreach($moduleS1 as $cle1 => $valeur1) 
                {
                  if($unite1!=$valeur1)
                      {
                        $unite1=$valeur1;
                        $table->addRow();
                        $table->addCell(2000, $cellRowSpan)->addText($unite1);
                        $table->addCell(9000)->addText($cle1);
                        $intitule=$cle1;
                    $intitule = str_replace("'", "''", $intitule);
                    $sql="select NOTE,CREDIT,SESSION,SAUV from ANNEXE2 where INTITULE='$intitule'";
                    $stnote=sqlsrv_query($conn,$sql);
                    $resultn=sqlsrv_fetch_array($stnote);
                    if($resultn[0]>=18 and $resultn[0]<=20){$grade='a';}
                    if($resultn[0]>=16 and $resultn[0]<18){$grade='b';}
                    if($resultn[0]>=14 and $resultn[0]<16){$grade='c';}
                    if($resultn[0]>=12 and $resultn[0]<14){$grade='d';}
                    if($resultn[0]>=10 and $resultn[0]<12){$grade='e';}
                    if( $resultn[0]<10){$grade='f';}
                    $annee=($resultn[3] % 100);
                    if(($resultn[2]=="JUIN") or ($resultn[2]=="RJUIN")) 
                      {$mois=6;}
                    if(($resultn[2]=="JANV") or ($resultn[2]=="RJANV")) 
                      {$mois=1;}
                        $table->addCell(1000)->addText($resultn[1]);
                        $table->addCell(1000)->addText($grade);
                        $table->addCell(2000)->addText($mois."/".$annee);
                      }
                  else
                  {
                    $table->addRow();
                    $table->addCell(null, $cellRowContinue);
                    $table->addCell(9000)->addText($cle1);
                    $intitule=$cle1;
                    $intitule = str_replace("'", "''", $intitule);
                    $sql="select NOTE,CREDIT,SESSION,SAUV from ANNEXE2 where INTITULE='$intitule'";
                    $stnote=sqlsrv_query($conn,$sql);
                    $resultn=sqlsrv_fetch_array($stnote);
                    if($resultn[0]>=18 and $resultn[0]<=20){$grade='a';}
                    if($resultn[0]>=16 and $resultn[0]<18){$grade='b';}
                    if($resultn[0]>=14 and $resultn[0]<16){$grade='c';}
                    if($resultn[0]>=12 and $resultn[0]<14){$grade='d';}
                    if($resultn[0]>=10 and $resultn[0]<12){$grade='e';}
                    if( $resultn[0]<10){$grade='f';}
                    $annee=($resultn[3] % 100);
                    if(($resultn[2]=="JUIN") or ($resultn[2]=="RJUIN")) 
                      {$mois=6;}
                    if(($resultn[2]=="JANV") or ($resultn[2]=="RJANV")) 
                      {$mois=1;}
                        $table->addCell(1000)->addText($resultn[1]);
                        $table->addCell(1000)->addText($grade);
                        $table->addCell(2000)->addText($mois."/".$annee);
                  }
                  $i=0;
                   foreach($moduleS2 as $cle2 => $valeur2) 
                    {
                      
                      if($i==$j) break;
                      else
                      { 

                        if($i==($j-1))
                        {

                            $i++;
                                if($unite2!=$valeur2)
                              {

                                $unite2=$valeur2;
                                $table->addCell(2000, $cellRowSpan)->addText($unite2);
                                $table->addCell(9000)->addText($cle2);
                                $intitule=$cle2;
                    $intitule = str_replace("'", "''", $intitule);
                    $sql="select NOTE,CREDIT,SESSION,SAUV from ANNEXE2 where INTITULE='$intitule'";
                    $stnote=sqlsrv_query($conn,$sql);
                    $resultn=sqlsrv_fetch_array($stnote);
                    if($resultn[0]>=18 and $resultn[0]<=20){$grade='a';}
                    if($resultn[0]>=16 and $resultn[0]<18){$grade='b';}
                    if($resultn[0]>=14 and $resultn[0]<16){$grade='c';}
                    if($resultn[0]>=12 and $resultn[0]<14){$grade='d';}
                    if($resultn[0]>=10 and $resultn[0]<12){$grade='e';}
                    if( $resultn[0]<10){$grade='f';}
                    $annee=($resultn[3] % 100);
                    if(($resultn[2]=="JUIN") or ($resultn[2]=="RJUIN")) 
                      {$mois=6;}
                    if(($resultn[2]=="JANV") or ($resultn[2]=="RJANV")) 
                      {$mois=1;}
                        $table->addCell(1000)->addText($resultn[1]);
                        $table->addCell(1000)->addText($grade);
                        $table->addCell(2000)->addText($mois."/".$annee);
                              }
                              else
                              {
                                $table->addCell(null, $cellRowContinue);
                          
                                $table->addCell(9000)->addText($cle2);
                                $intitule=$cle2;
                    $intitule = str_replace("'", "''", $intitule);
                    $sql="select NOTE,CREDIT,SESSION,SAUV from ANNEXE2 where INTITULE='$intitule'";
                    $stnote=sqlsrv_query($conn,$sql);
                    $resultn=sqlsrv_fetch_array($stnote);
                    if($resultn[0]>=18 and $resultn[0]<=20){$grade='a';}
                    if($resultn[0]>=16 and $resultn[0]<18){$grade='b';}
                    if($resultn[0]>=14 and $resultn[0]<16){$grade='c';}
                    if($resultn[0]>=12 and $resultn[0]<14){$grade='d';}
                    if($resultn[0]>=10 and $resultn[0]<12){$grade='e';}
                    if( $resultn[0]<10){$grade='f';}
                    $annee=($resultn[3] % 100);
                    if(($resultn[2]=="JUIN") or ($resultn[2]=="RJUIN")) 
                      {$mois=6;}
                    if(($resultn[2]=="JANV") or ($resultn[2]=="RJANV")) 
                      {$mois=1;}
                        $table->addCell(1000)->addText($resultn[1]);
                        $table->addCell(1000)->addText($grade);
                        $table->addCell(2000)->addText($mois."/".$annee);
                              }
                        }
                        else
                        {
                          $i++;
                          continue;
                        }
                        
                      
                      }
                      
                    }

                    $j++;
                }
            //Fin

// rajouter les lignes selon les modules 
$table->addRow();
$table->addCell(4000, $cellColSpan)->addText("Troisième Semestre",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(4000, $cellColSpan)->addText("Quatrième Semestre",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
// deuxieme année 
 $tsql="select OCODE from ANNEXE2 where MAT='$mat' and ANET=2";
        $stmt=sqlsrv_query($conn,$tsql);
        $result=sqlsrv_fetch_array($stmt);
        $ocodeL2=$result[0];

 $tsql1="select distinct UNITE from ANNEXE2 
where ocode='$ocodeL2' and (SESSION='JANV' or SESSION='RJANV');";
$stmt1=sqlsrv_query($conn,$tsql1);

$tsql5="select distinct UNITE from ANNEXE2 
where ocode='$ocodeL2' and (SESSION='JUIN' or SESSION='RJUIN');";
$stmt5=sqlsrv_query($conn,$tsql5);
        $uniteS3=array();
        $uniteS4=array();
        while($result5=sqlsrv_fetch_array($stmt5))
          $uniteS4[]=$result5[0];

        while($result=sqlsrv_fetch_array($stmt1))
          $uniteS3[]=$result[0];


        $moduleS3= array();
        $moduleS4= array();
         foreach($uniteS3 as $valeur) 
            {  
                  $tsql2="select distinct INTITULE from ANNEXE2 where ocode='$ocodeL2' and UNITE='$valeur'";
                  $stmt2=sqlsrv_query($conn,$tsql2);

                  while($result2=sqlsrv_fetch_array($stmt2))
                  {
                    $moduleS3[$result2[0]]=$valeur;
                  }
            }

            foreach($uniteS4 as $valeur) 
            {  
                  $tsqll="select distinct INTITULE from ANNEXE2 where ocode='$ocodeL2' and UNITE='$valeur'";
          $stmtt=sqlsrv_query($conn,$tsqll);
                  while($resultt=sqlsrv_fetch_array($stmtt))
                  {
                    $moduleS4[$resultt[0]]=$valeur;
                  }
            }


             $i=0; $j=1;

             $unite3=""; $unite4="";
             foreach($moduleS3 as $cle1 => $valeur1) 
                {
                  if($unite3!=$valeur1)
                      {
                        $unite3=$valeur1;
                        $table->addRow();
                        $table->addCell(2000, $cellRowSpan)->addText($unite3);
                        $table->addCell(2000)->addText($cle1);
                        $intitule=$cle1;
                    $intitule = str_replace("'", "''", $intitule);
                    $sql="select NOTE,CREDIT,SESSION,SAUV from ANNEXE2 where INTITULE='$intitule'";
                    $stnote=sqlsrv_query($conn,$sql);
                    $resultn=sqlsrv_fetch_array($stnote);
                    if($resultn[0]>=18 and $resultn[0]<=20){$grade='a';}
                    if($resultn[0]>=16 and $resultn[0]<18){$grade='b';}
                    if($resultn[0]>=14 and $resultn[0]<16){$grade='c';}
                    if($resultn[0]>=12 and $resultn[0]<14){$grade='d';}
                    if($resultn[0]>=10 and $resultn[0]<12){$grade='e';}
                    if( $resultn[0]<10){$grade='f';}
                    $annee=($resultn[3] % 100);
                    if(($resultn[2]=="JUIN") or ($resultn[2]=="RJUIN")) 
                      {$mois=6;}
                    if(($resultn[2]=="JANV") or ($resultn[2]=="RJANV")) 
                      {$mois=1;}
                        $table->addCell(2000)->addText($resultn[1]);
                        $table->addCell(2000)->addText($grade);
                        $table->addCell(2000)->addText($mois."/".$annee);
                      }
                  else
                  {
                    $table->addRow();
                    $table->addCell(null, $cellRowContinue);
                    $table->addCell(2000)->addText($cle1);
                    $intitule=$cle1;
                    $intitule = str_replace("'", "''", $intitule);
                    $sql="select NOTE,CREDIT,SESSION,SAUV from ANNEXE2 where INTITULE='$intitule'";
                    $stnote=sqlsrv_query($conn,$sql);
                    $resultn=sqlsrv_fetch_array($stnote);
                    if($resultn[0]>=18 and $resultn[0]<=20){$grade='a';}
                    if($resultn[0]>=16 and $resultn[0]<18){$grade='b';}
                    if($resultn[0]>=14 and $resultn[0]<16){$grade='c';}
                    if($resultn[0]>=12 and $resultn[0]<14){$grade='d';}
                    if($resultn[0]>=10 and $resultn[0]<12){$grade='e';}
                    if( $resultn[0]<10){$grade='f';}
                    $annee=($resultn[3] % 100);
                    if(($resultn[2]=="JUIN") or ($resultn[2]=="RJUIN")) 
                      {$mois=6;}
                    if(($resultn[2]=="JANV") or ($resultn[2]=="RJANV")) 
                      {$mois=1;}
                        $table->addCell(2000)->addText($resultn[1]);
                        $table->addCell(2000)->addText($grade);
                        $table->addCell(2000)->addText($mois."/".$annee);
                  }
                  $i=0;
                   foreach($moduleS4 as $cle2 => $valeur2) 
                    {
                      
                      if($i==$j) break;
                      else
                      { 

                        if($i==($j-1))
                        {

                            $i++;
                                if($unite4!=$valeur2)
                              {

                                $unite4=$valeur2;
                                $table->addCell(2000, $cellRowSpan)->addText($unite4);
                                $table->addCell(2000)->addText($cle2);
                                $intitule=$cle2;
                    $intitule = str_replace("'", "''", $intitule);
                    $sql="select NOTE,CREDIT,SESSION,SAUV from ANNEXE2 where INTITULE='$intitule'";
                    $stnote=sqlsrv_query($conn,$sql);
                    $resultn=sqlsrv_fetch_array($stnote);
                    if($resultn[0]>=18 and $resultn[0]<=20){$grade='a';}
                    if($resultn[0]>=16 and $resultn[0]<18){$grade='b';}
                    if($resultn[0]>=14 and $resultn[0]<16){$grade='c';}
                    if($resultn[0]>=12 and $resultn[0]<14){$grade='d';}
                    if($resultn[0]>=10 and $resultn[0]<12){$grade='e';}
                    if( $resultn[0]<10){$grade='f';}
                    $annee=($resultn[3] % 100);
                    if(($resultn[2]=="JUIN") or ($resultn[2]=="RJUIN")) 
                      {$mois=6;}
                    if(($resultn[2]=="JANV") or ($resultn[2]=="RJANV")) 
                      {$mois=1;}
                        $table->addCell(2000)->addText($resultn[1]);
                        $table->addCell(2000)->addText($grade);
                        $table->addCell(2000)->addText($mois."/".$annee);
                              }
                              else
                              {
                                $table->addCell(null, $cellRowContinue);
                                $table->addCell(2000)->addText($cle2);
                                $intitule=$cle2;
                    $intitule = str_replace("'", "''", $intitule);
                    $sql="select NOTE,CREDIT,SESSION,SAUV from ANNEXE2 where INTITULE='$intitule'";
                    $stnote=sqlsrv_query($conn,$sql);
                    $resultn=sqlsrv_fetch_array($stnote);
                    if($resultn[0]>=18 and $resultn[0]<=20){$grade='a';}
                    if($resultn[0]>=16 and $resultn[0]<18){$grade='b';}
                    if($resultn[0]>=14 and $resultn[0]<16){$grade='c';}
                    if($resultn[0]>=12 and $resultn[0]<14){$grade='d';}
                    if($resultn[0]>=10 and $resultn[0]<12){$grade='e';}
                    if( $resultn[0]<10){$grade='f';}
                    $annee=($resultn[3] % 100);
                    if(($resultn[2]=="JUIN") or ($resultn[2]=="RJUIN")) 
                      {$mois=6;}
                    if(($resultn[2]=="JANV") or ($resultn[2]=="RJANV")) 
                      {$mois=1;}
                        $table->addCell(2000)->addText($resultn[1]);
                        $table->addCell(2000)->addText($grade);
                        $table->addCell(2000)->addText($mois."/".$annee);
                              }
                        }
                        else
                        {
                          $i++;
                          continue;
                        }
                        
                      
                      }
                      
                    }

                    $j++;
                }
            //Fin

// rajouter les lignes selon les modules 
$table->addRow();
$table->addCell(4000, $cellColSpan)->addText("Cinquième Semestre",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(4000, $cellColSpan)->addText("Sixième Semestre",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
// troisieme année 
 $tsql="select OCODE from ANNEXE2 where MAT='$mat' and ANET=3";
        $stmt=sqlsrv_query($conn,$tsql);
        $result=sqlsrv_fetch_array($stmt);
        $ocodeL3=$result[0];

 $tsql1="select distinct UNITE from ANNEXE2 
where ocode='$ocodeL3' and (SESSION='JANV' or SESSION='RJANV');";
$stmt1=sqlsrv_query($conn,$tsql1);

$tsql5="select distinct UNITE from ANNEXE2 
where ocode='$ocodeL3' and (SESSION='JUIN' or SESSION='RJUIN');";
$stmt5=sqlsrv_query($conn,$tsql5);
        $uniteS5=array();
        $uniteS6=array();
        while($result5=sqlsrv_fetch_array($stmt5))
          $uniteS6[]=$result5[0];

        while($result=sqlsrv_fetch_array($stmt1))
          $uniteS5[]=$result[0];


        $moduleS5= array();
        $moduleS6= array();
         foreach($uniteS5 as $valeur) 
            {  
                  $tsql2="select distinct INTITULE from ANNEXE2 where ocode='$ocodeL3' and UNITE='$valeur'";
                  $stmt2=sqlsrv_query($conn,$tsql2);

                  while($result2=sqlsrv_fetch_array($stmt2))
                  {
                    $moduleS5[$result2[0]]=$valeur;
                  }
            }

            foreach($uniteS6 as $valeur) 
            {  
                  $tsqll="select distinct INTITULE from ANNEXE2 where ocode='$ocodeL3' and UNITE='$valeur'";
          $stmtt=sqlsrv_query($conn,$tsqll);
                  while($resultt=sqlsrv_fetch_array($stmtt))
                  {
                    $moduleS6[$resultt[0]]=$valeur;
                  }
            }


             $i=0; $j=1;

             $unite5=""; $unite6="";
             foreach($moduleS5 as $cle1 => $valeur1) 
                {
                  if($unite5!=$valeur1)
                      {
                        $unite5=$valeur1;
                        $table->addRow();
                        $table->addCell(2000, $cellRowSpan)->addText($unite5);
                        $table->addCell(2000)->addText($cle1);
                        $intitule=$cle1;
                    $intitule = str_replace("'", "''", $intitule);
                    $sql="select NOTE,CREDIT,SESSION,SAUV from ANNEXE2 where INTITULE='$intitule'";
                    $stnote=sqlsrv_query($conn,$sql);
                    $resultn=sqlsrv_fetch_array($stnote);
                    if($resultn[0]>=18 and $resultn[0]<=20){$grade='a';}
                    if($resultn[0]>=16 and $resultn[0]<18){$grade='b';}
                    if($resultn[0]>=14 and $resultn[0]<16){$grade='c';}
                    if($resultn[0]>=12 and $resultn[0]<14){$grade='d';}
                    if($resultn[0]>=10 and $resultn[0]<12){$grade='e';}
                    if( $resultn[0]<10){$grade='f';}
                    $annee=($resultn[3] % 100);
                    if(($resultn[2]=="JUIN") or ($resultn[2]=="RJUIN")) 
                      {$mois=6;}
                    if(($resultn[2]=="JANV") or ($resultn[2]=="RJANV")) 
                      {$mois=1;}
                        $table->addCell(2000)->addText($resultn[1]);
                        $table->addCell(2000)->addText($grade);
                        $table->addCell(2000)->addText($mois."/".$annee);
                      }
                  else
                  {
                    $table->addRow();
                    $table->addCell(null, $cellRowContinue);
                    $table->addCell(2000)->addText($cle1);
                    $intitule=$cle1;
                    $intitule = str_replace("'", "''", $intitule);
                    $sql="select NOTE,CREDIT,SESSION,SAUV from ANNEXE2 where INTITULE='$intitule'";
                    $stnote=sqlsrv_query($conn,$sql);
                    $resultn=sqlsrv_fetch_array($stnote);
                    if($resultn[0]>=18 and $resultn[0]<=20){$grade='a';}
                    if($resultn[0]>=16 and $resultn[0]<18){$grade='b';}
                    if($resultn[0]>=14 and $resultn[0]<16){$grade='c';}
                    if($resultn[0]>=12 and $resultn[0]<14){$grade='d';}
                    if($resultn[0]>=10 and $resultn[0]<12){$grade='e';}
                    if( $resultn[0]<10){$grade='f';}
                    $annee=($resultn[3] % 100);
                    if(($resultn[2]=="JUIN") or ($resultn[2]=="RJUIN")) 
                      {$mois=6;}
                    if(($resultn[2]=="JANV") or ($resultn[2]=="RJANV")) 
                      {$mois=1;}
                        $table->addCell(2000)->addText($resultn[1]);
                        $table->addCell(2000)->addText($grade);
                        $table->addCell(2000)->addText($mois."/".$annee);
                  }
                  $i=0;
                   foreach($moduleS6 as $cle2 => $valeur2) 
                    {
                      if($i==$j) break;
                      else
                      { 

                        if($i==($j-1))
                        {

                            $i++;
                                if($unite6!=$valeur2)
                              {

                                $unite6=$valeur2;
                                $table->addCell(2000, $cellRowSpan)->addText($unite6);
                                $table->addCell(2000)->addText($cle2);
                                $intitule=$cle2;
                    $intitule = str_replace("'", "''", $intitule);
                    $sql="select NOTE,CREDIT,SESSION,SAUV from ANNEXE2 where INTITULE='$intitule'";
                    $stnote=sqlsrv_query($conn,$sql);
                    $resultn=sqlsrv_fetch_array($stnote);
                    if($resultn[0]>=18 and $resultn[0]<=20){$grade='a';}
                    if($resultn[0]>=16 and $resultn[0]<18){$grade='b';}
                    if($resultn[0]>=14 and $resultn[0]<16){$grade='c';}
                    if($resultn[0]>=12 and $resultn[0]<14){$grade='d';}
                    if($resultn[0]>=10 and $resultn[0]<12){$grade='e';}
                    if( $resultn[0]<10){$grade='f';}
                    $annee=($resultn[3] % 100);
                    if(($resultn[2]=="JUIN") or ($resultn[2]=="RJUIN")) 
                      {$mois=6;}
                    if(($resultn[2]=="JANV") or ($resultn[2]=="RJANV")) 
                      {$mois=1;}
                        $table->addCell(2000)->addText($resultn[1]);
                        $table->addCell(2000)->addText($grade);
                        $table->addCell(2000)->addText($mois."/".$annee);
                              }
                              else
                              {
                                $table->addCell(null, $cellRowContinue);
                                $table->addCell(2000)->addText($cle2);
                                $intitule=$cle2;
                    $intitule = str_replace("'", "''", $intitule);
                    $sql="select NOTE,CREDIT,SESSION,SAUV from ANNEXE2 where INTITULE='$intitule'";
                    $stnote=sqlsrv_query($conn,$sql);
                    $resultn=sqlsrv_fetch_array($stnote);
                    if($resultn[0]>=18 and $resultn[0]<=20){$grade='a';}
                    if($resultn[0]>=16 and $resultn[0]<18){$grade='b';}
                    if($resultn[0]>=14 and $resultn[0]<16){$grade='c';}
                    if($resultn[0]>=12 and $resultn[0]<14){$grade='d';}
                    if($resultn[0]>=10 and $resultn[0]<12){$grade='e';}
                    if( $resultn[0]<10){$grade='f';}
                    $annee=($resultn[3] % 100);
                    if(($resultn[2]=="JUIN") or ($resultn[2]=="RJUIN")) 
                      {$mois=6;}
                    if(($resultn[2]=="JANV") or ($resultn[2]=="RJANV")) 
                      {$mois=1;}
                        $table->addCell(2000)->addText($resultn[1]);
                        $table->addCell(2000)->addText($grade);
                        $table->addCell(2000)->addText($mois."/".$annee);
                              }
                        }
                        else
                        {
                          $i++;
                          continue;
                        }
                        
                      
                      }
                      
                    }

                    $j++;
                    if($j>=count($moduleS6)+2)
                    {
                      
                                $table->addCell(2000)->addText("");
                                $table->addCell(2000)->addText("");
                                $table->addCell(2000)->addText("");
                                $table->addCell(2000)->addText("");
                                $table->addCell(2000)->addText("");
                    }
                }
            //Fin

$textrun = $section->addTextRun();
$textrun->addText('Date(1):', ['size' => 10,'bold' => true]);
$textrun->addText(' n° mois/ millésime de l’année (ex :2/10)-', ['size' => 10 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
$textrun->addText('Grade(*) :', ['size' => 10,'bold' => true]);
$textrun->addText(' n° mois/ millésime de l’année (ex :2/10)-', ['size' => 10 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
$textrun = $section->addTextRun();
$textrun->addText('Moyenne du cursus :', ['size' => 10,'bold' => true]);
$textrun->addText($mc, ['size' => 10,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
$textrun->addText('                                 Moyenne de classement au sien de la promotion :', ['size' => 10,'bold' => true]);
$textrun->addText($mse, ['size' => 10 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
$textrun = $section->addTextRun();
$textrun->addText('(*) : Conformément à l’arrêté n° 714 des 03/11/2011 portantes modalités de classement', ['size' => 10,'bold' => true]);
$textrun = $section->addTextRun();
$textrun->addText('3-3 Classification de la notation par grade :', ['size' => 11,'bold' => true]);
$textrun = $section->addTextRun();
$textrun->addText('- Décrire brièvement le système d’évaluation et de progression appliqués à la formation.
Chaque matière est appréciée semestriellement soit par un contrôle continu  et régulier, soit par un examen final, soit par les deux modes de contrôle combinés. Chaque matière a une moyenne comprise entre 0 à 20. La note 0 est la note la plus basse, et la note 20 est la plus haute. La note 10 est la note suffisante pour la validation d‘une matière ou d’une UE.
', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);

$table = $section->addTable([
    'borderSize' => 6, 
    'borderColor' => '000000', 
    'afterSpacing' => 0, 
    'Spacing'=> 0, 
    'cellMargin'=> 0
]);



$table->addRow();
$table->addCell(4000)->addText("Evaluation interne (1)",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(4000)->addText("Evaluation internationale correspondante",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(4000)->addText("Effectif absolu",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(4000)->addText("Effectif en pourcentage",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$req1="SELECT * FROM TCATEGORIE";
$stdom1=sqlsrv_query($conn,$req1);
while($rang=sqlsrv_fetch_array($stdom1))
{
  $table->addRow();
$table->addCell(4000)->addText("".$rang[0]."-".$rang[1]."",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(4000)->addText("$rang[2]",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(4000)->addText("$rang[3]",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);
$table->addCell(4000)->addText("$rang[4]",['size' => 11,'bold' => true],[ 'align' => \PhpOffice\PhpWord\SimpleType\TextAlignment::CENTER ]);


}

$textrun = $section->addTextRun();
$textrun->addText('(1) Cette colonne est calculée à partir de l’ensemble des notes des étudiants qui ont obtenu le diplôme au cours d’une même année universitaire. Après avoir classé les notes, la tranche de notes des 10% premiers de l’effectif constitue la 1ère classe à placer dans la 1ère ligne de la 1ère colonne (grade A). La tranche des 20% suivants constitue la 2ème classe qu’il faut placer en 2ème ligne de la même colonne (grade B) et ainsi de suite. A chaque fois, on déterminera l’effectif absolu correspondant à la classe calculée.  
', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
$textrun = $section->addTextRun();
$textrun->addText('Remarque : L’étudient est classé dans la catégorie : ', ['size' => 11,'bold' => true]);

$textrun->addText($cat, ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
$textrun = $section->addTextRun();
$textrun->addText('3-4 Principaux domaines de compétences couverts par le diplôme : ', ['size' => 11,'bold' => true]);
$req="select distinct DDC from DOMAINE_DE_COMP where ocode='$ocodeL3'";
                  $stdom=sqlsrv_query($conn,$req);

                  while($data=sqlsrv_fetch_array($stdom))
                  {
                    $textrun = $section->addTextRun();
                    $textrun->addText($data[0], ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
                  }
  $section->addText('5. PROJECTIONS ACADEMIQUE ET PROFESSIONNELLE :', ['size' => 11, 'bold' => true,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(10)] );
 $textrun = $section->addTextRun();
   $section->addText('5-1 Projection académique : ', ['size' => 11, 'bold' => true,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(10)] );
    $textrun->addText('Le titulaire de la licence peut être admis en Master ', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
    $textrun = $section->addTextRun();
   $section->addText('5-2 Projection professionnelle : ', ['size' => 11, 'bold' => true,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(10)] );
    $textrun->addText('L’insertion dans le monde du travail de tous les domaines  ', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
    $textrun->addText($filiere, ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
 

 $section->addText('6.SIGNATURE:', ['size' => 11, 'bold' => true,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(10)] );
 $textrun = $section->addTextRun();
 $textrun->addText('Nom et prénom(s) du signataire : ', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
 $textrun = $section->addTextRun();
 $textrun->addText('Qualité du signataire : ', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
 $textrun = $section->addTextRun();
 $textrun->addText('Date :', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
 $textrun = $section->addTextRun();
 $textrun->addText('Signature ', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
  $textrun = $section->addTextRun();
 $textrun->addText('', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);

 $textrun = $section->addTextRun();
 $textrun->addText('Tampon ou cachet officiel :', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
 $textrun = $section->addTextRun();
 $textrun->addText('', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
 $textrun = $section->addTextRun();
 $textrun->addText('', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);



 $section->addText('6. RENSEIGNEMENTS CONCERNANT LE SYSTÈME NATIONAL D’ENSEIGNEMENT SUPERIEUR :', ['size' => 11, 'bold' => true,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(10)] );


$section->addText('En Algérie, au côté du système classique,  est appliquée depuis septembre 2004 l’architecture LMD préparant à 3 diplômes : Licence (180 crédits), Master (120 crédits supplémentaires à ceux de la licence si le master est obtenu  dans un centre universitaire ou dans une université et 300 crédits si le master est obtenu  dans une école), Doctorat (3 années de recherche). Les diplômes du système classique continuent de cohabiter avec ceux du système LMD.  Les types d’établissements sont: l’Université, le Centre Universitaire, l’Ecole et les classes préparatoires.', ['size' => 11], [ 'align' => 'both' ]);



$section->addImage('img/schema.png',
    array(
        'width'         => 480,
        'height'        => 320,
        'marginTop'     => -1,
        'marginLeft'    => -1,
        'wrappingStyle' => 'behind',
        'align' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
    ));

$textrun = $section->addTextRun();
$textrun->addText('Remarque : ', ['size' => 11,'bold' => true]);
$textrun->addText(': Il y a d’ajouter des indications qui n’apparaissent pas dans le schéma : ', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
 $textrun = $section->addTextRun();
 $textrun->addText('1-  Les titulaires d’un diplôme su système classique peuvent poursuivre leurs études dans le système L.M.D sous réserve de satisfaire les conditions d’accès fixées par la circulaire ministérielle au titre de chaque année universitaire. A titre d’exemples :', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
 $textrun = $section->addTextRun();
 $textrun->addText('-    Les ingénieurs d’état, issus des centres universitaires et des universités, peuvent accéder à la deuxième année du master.', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
  $textrun = $section->addTextRun();
 $textrun->addText('-   Les titulaires d’une licence ou d’un diplôme d’études supérieures(D.E.S) peuvent accéder à la première année du master.', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
  $textrun = $section->addTextRun();
 $textrun->addText('2-  L’accès au master dans les écoles s’effectue sur concours pour les titulaires d’une licence du système L.M.D.', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);
  $textrun = $section->addTextRun();
 $textrun->addText('3-  Dans les écoles nationales supérieures, les formations scientifiques et technologiques sont sanctionnées par le diplôme d’ingénieur d’état ; les titulaires de ce diplôme peuvent postuler au diplôme de master, moyennant un complément de formation d’un volume horaire de 200 heures au minimum.  ', ['size' => 11 ,'spaceBefore' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(6)]);


$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save("Annexe_Licence/Annexe".$mat.".docx");






}


?>


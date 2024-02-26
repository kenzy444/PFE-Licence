<?php 

function getDatabaseConnexion() {
    try {
        $conn = new PDO("sqlsrv:Server=DESKTOP-3034QEN;Database=usthb90000L","","");
        //$conn = new PDO("sqlsrv:Server=DESKTOP-3034QEN\SQLEXPRESS;Database=usthb90000L","","");
        $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
      }
      catch(Exception $e){
        die(print_r($e->getMessage()));
      }
}

//recupere une faculté
function readFac($FACCODE) {
	$conn = getDatabaseConnexion();
	$requete = "SELECT FAC from FACULTE0000 where FACCODE = '$FACCODE' ";
	$stmt = $conn->query($requete);
	$row = $stmt->fetchAll();
	if (!empty($row)) {
		return $row[0];
	}
}

//recupere un admin
function readAdmin($ID) {
	$conn = getDatabaseConnexion();
	$requete = "SELECT * from UTILISATEURS where ID = '$ID' ";
	$stmt = $conn->query($requete);
	$row = $stmt->fetchAll();
	if (!empty($row)) {
		return $row[0];
	}
}

?>
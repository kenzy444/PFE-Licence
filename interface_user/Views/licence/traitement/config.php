<?php

try {
    $conn = new PDO("sqlsrv:Server=DESKTOP-O7N9N47;Database=usthb90000L","","");
    //$conn = new PDO("sqlsrv:Server=DESKTOP-3034QEN\SQLEXPRESS;Database=usthb90000L","","");
    $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(Exception $e){
    die(print_r($e->getMessage()));
  }
?>
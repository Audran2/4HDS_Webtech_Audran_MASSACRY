<?php

// Identifiants connection a la base de donnée 

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'gestion_stock_medicaments';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
         
if(!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
 }
 // echo 'Connected successfully<br />';
 $retval = mysqli_select_db( $conn, 'gestion_stock_medicaments' );

 if(! $retval ) {
    die('Could not select database: ' . mysqli_error($conn));
 }
 // echo "Database gestion_cours selected successfully\n";
// $mysqli->close();


?>
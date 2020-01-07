<?php 

header('Access-Control-Allow-Origin: *');

try {
    $hostname = "localhost";
    $dbname = "dfornez_adr3";
    $username = "dfornez_adr3";
    $pw = "Bridge2351$";
    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
  } catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
  }
      
?>


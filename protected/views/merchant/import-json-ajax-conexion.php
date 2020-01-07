<?php 
//$conn = mysqli_connect("localhost", "root", "", "dfornez_adr3");
/*$conn = mysqli_connect("45.79.48.131", "dfornez_adr3", "Bridge2351$", "dfornez_adr3", "2087");


// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
*/

$conn = new mysqli("localhost", "dfornez_adr3", "Bridge2351$", "dfornez_adr3");
$conn->set_charset("utf8");
// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
?> 
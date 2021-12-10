<?php
 
$servername = "localhost";
$username = "httpdh5";
$password = "";
$database = "db2";
$sqlport = "3342";
$socket = "/vols/sdb9/httpdh5_db/httpdh5_db.sock";    // change httpdhXX by your space
$db = new mysqli($servername, $username, $password, $database, $sqlport, $socket);
// Check connection

if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>

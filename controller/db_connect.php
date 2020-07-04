<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hrms";

// Create connection
global $connection;
$connection = mysqli_connect($servername, $username, $password, $dbname);

if(!$connection){
  die('Connection Error: ' . mysqli_connect_error());
}

?>

<?php

/* Gian settings
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "nature"; */

/* General settings */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nature";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
/* Test connection if works.
echo "Connected successfully<br><br>";
*/

?>

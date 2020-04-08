<?php
/** Credenciales de la conexion a la base de datos */
//$servername = 'orbitweb-ca-central-1b.cul183bjpepe.ca-central-1.rds.amazonaws.com';
$servername = 'localhost';
$username = 'zirok';
$password = '';
$dbname = 'urls';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

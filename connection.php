<?php
/** Credenciales de la conexion a la base de datos */
$servername = 'orbitweb-ca-central-1b.cul183bjpepe.ca-central-1.rds.amazonaws.com';
$username = 'orbit';
$password = '$plinter1932';
$dbname = 'monitoring';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

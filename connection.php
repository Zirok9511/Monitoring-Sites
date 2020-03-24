<?php
/** Credenciales de la conexion a la base de datos */
$servername = '127.0.0.1';
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
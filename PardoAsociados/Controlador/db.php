<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pardoasociados";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} 
?>
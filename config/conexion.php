<?php
// conexion.php
$host = "127.0.0.1";
$user = "root";
$pass = ""; // En XAMPP por defecto no hay contraseña
$db = "diabetes_app";

// Si al final MySQL esta en el puerto 3307, descomenta la siguiente línea y agrégala a la conexión
$puerto = 3307;
$conn = new mysqli($host, $user, $pass, $db, $puerto);


//Si no comenta lo anterior y descomenta la siguiente linea
//$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
// Establecer el set de caracteres a utf8mb4 (igual que tu base de datos)
$conn->set_charset("utf8mb4");
?>
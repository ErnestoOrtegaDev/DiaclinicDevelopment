<?php
// registro.php
require '../config/conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario (usando el atributo 'name' de los inputs)
    $nombres = $_POST['nombres'];
    $ap_paterno = $_POST['ap_paterno'];
    $ap_materno = $_POST['ap_materno'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = $_POST['password'];

    // Unir los nombres para que coincida con tu columna 'full_name'
    $full_name = trim($nombres . " " . $ap_paterno . " " . $ap_materno);
    
    // Encriptar la contraseña (¡NUNCA se guardan en texto plano!)
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
    // Definir el rol por defecto
    $role = 'patient';

    // Preparar la consulta SQL para la tabla 'users'
    $sql = "INSERT INTO users (full_name, email, password, phone, role) VALUES (?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        // Las "sssss" significan que estamos enviando 5 Strings
        $stmt->bind_param("sssss", $full_name, $email, $password_hash, $telefono, $role);
        
        if ($stmt->execute()) {
            // Registro exitoso, redirigir al login
            header("Location: ../views/pantalla_login.html?registro=exito");
            exit();
        } else {
            echo "Error al registrar: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
    $conn->close();
}
?>
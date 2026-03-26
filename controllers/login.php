<?php
// controllers/login.php
session_start();
require '../config/conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Buscar al usuario por correo
    $sql = "SELECT id_user, full_name, password, role FROM users WHERE email = ? AND status = 1";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows == 1) {
            $usuario = $resultado->fetch_assoc();
            
            // Verificar la contraseña encriptada
            if (password_verify($password, $usuario['password'])) {
                
                // Contraseña correcta
                $_SESSION['id_user'] = $usuario['id_user'];
                $_SESSION['full_name'] = $usuario['full_name'];
                $_SESSION['role'] = $usuario['role'];

                header("Location: ../views/Usuarios.php");
                exit();
                
            } else {
                // Contraseña incorrecta
                header("Location: ../views/pantalla_login.html?error=pass");
                exit();
            }
        } else {
            // Correo no existe o inactivo
            header("Location: ../views/pantalla_login.html?error=email");
            exit();
        }
        $stmt->close();
    }
    $conn->close();
}
?>
<?php
include_once '../config/conexion.php';

// --- ACCIÓN: ELIMINAR ---
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = intval($_GET['id']);
    $query = "DELETE FROM users WHERE id_user = $id";
    mysqli_query($conn, $query);
    header("Location: ../views/Usuarios.php");
    exit();
}

// --- ACCIÓN: CREAR ---
if (isset($_POST['btn_registrar'])) {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $pass   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol    = $_POST['role'];
    
    $query = "INSERT INTO users (full_name, email, password, role, status) VALUES ('$nombre', '$correo', '$pass', '$rol', 1)";
    mysqli_query($conn, $query);
    header("Location: ../views/Usuarios.php");
    exit();
}

// --- ACCIÓN: EDITAR ---
if (isset($_POST['btn_editar'])) {
    $id     = intval($_POST['id_user']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $rol    = $_POST['role'];
    
    $query = "UPDATE users SET full_name='$nombre', email='$correo', role='$rol' WHERE id_user=$id";
    mysqli_query($conn, $query);
    header("Location: ../views/Usuarios.php");
    exit();
}
?>
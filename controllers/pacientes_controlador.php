<?php
include_once '../config/conexion.php';

// --- REGISTRAR NUEVO PACIENTE ---
if (isset($_POST['btn_registrar_paciente'])) {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $estado = $_POST['estado'];
    $fecha_inicio = $_POST['fecha_inicio'];

    // 1. Crear el usuario primero (para el login)
    $sql_user = "INSERT INTO users (full_name, email, password, role, status) 
                 VALUES ('$nombre', '$correo', 'paciente123', 'patient', 1)";
    
    if ($conn->query($sql_user)) {
        $id_usuario = $conn->insert_id;
        // 2. Crear el registro en la tabla de pacientes
        $sql_paciente = "INSERT INTO patients (id_user, health_status, created_at) 
                         VALUES ($id_usuario, '$estado', '$fecha_inicio')";
        $conn->query($sql_paciente);
    }
    header("Location: ../views/pacientes_activos.php");
}

// --- ACTUALIZAR PACIENTE ---
if (isset($_POST['btn_editar_paciente'])) {
    $id_p = intval($_POST['id_patient']);
    $id_u = intval($_POST['id_user']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $estado = $_POST['estado'];
    $cita = $_POST['proxima_cita'];

    // Actualizar nombre en tabla usuarios
    $conn->query("UPDATE users SET full_name = '$nombre' WHERE id_user = $id_u");
    // Actualizar datos médicos en tabla pacientes
    $conn->query("UPDATE patients SET health_status = '$estado', next_appointment = '$cita' WHERE id_patient = $id_p");
    
    header("Location: ../views/pacientes_activos.php");
}

// --- ELIMINAR (ALTA MÉDICA / BORRADO LÓGICO) ---
if (isset($_GET['delete_id'])) {
    $id_u = intval($_GET['user_id']);
    // Desactivamos al usuario para que no entre al sistema
    $conn->query("UPDATE users SET status = 0 WHERE id_user = $id_u");
    header("Location: ../views/pacientes_activos.php");
}
?>
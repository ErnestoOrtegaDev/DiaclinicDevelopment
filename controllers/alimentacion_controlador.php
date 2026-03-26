<?php
include_once '../config/conexion.php';

// --- ACCIÓN: GUARDAR O ACTUALIZAR PLAN ---
if (isset($_POST['btn_guardar_plan'])) {
    // En un sistema real, estos IDs vendrían de la sesión o selección previa
    $id_patient = 1; // ID de ejemplo (Mario López)
    $id_doctor = 1;  // ID del doctor logueado
    
    // Unificamos las recomendaciones de las 4 áreas en un solo texto o JSON
    $recomendaciones = "RECOMENDADOS: " . $_POST['recomendados'] . " | " .
                       "EVITAR: " . $_POST['evitar'] . " | " .
                       "REGLAS: " . $_POST['reglas'] . " | " .
                       "ESPECIALES: " . $_POST['especiales'];
                       
    $calories = intval($_POST['calories']);
    $recomendaciones = mysqli_real_escape_string($conn, $recomendaciones);

    // Verificamos si ya existe un plan para actualizarlo o crear uno nuevo
    $check = $conn->query("SELECT id_plan FROM food_plans WHERE id_patient = $id_patient LIMIT 1");
    
    if ($check->num_rows > 0) {
        $sql = "UPDATE food_plans SET recommendations = '$recomendaciones', calories = $calories WHERE id_patient = $id_patient";
    } else {
        $sql = "INSERT INTO food_plans (id_patient, id_doctor, recommendations, calories, status) 
                VALUES ($id_patient, $id_doctor, '$recomendaciones', $calories, 1)";
    }

    if ($conn->query($sql)) {
        header("Location: ../views/PerfilAlimenticio.php?status=success");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: pantalla_login.html");
    exit();
}
include_once '../config/conexion.php';

$userName = $_SESSION['full_name'];
$userRole = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | DiaClinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/dashboard_style.css"> 
</head>
<body>

<div class="d-flex">
    <aside class="sidebar d-flex flex-column">
        <div class="logo text-center">
            <img src="../assets/logo.png" alt="Logo">
            <h3>DiaClinic</h3>
            <p class="text-muted small"><?php echo ucfirst($userRole); ?></p>
        </div>
        
        <nav class="menu mt-4 flex-grow-1">
            <a class="nav-link active" href="dashboard.php">Dashboard</a>
            <a class="nav-link" href="servicios.html">Servicios</a>
            <a class="nav-link" href="pacientes_activos.php">Todos los pacientes</a>
            <a class="nav-link" href="Usuarios.php">Usuarios</a>
        </nav>

        <div class="user_profile_box shadow-sm mt-4">
            <p class="mb-1 fw-bold text-truncate"><?php echo $userName; ?></p>
            <a href="../controllers/logout.php" class="text-danger small text-decoration-none">Cerrar Sesión</a>
        </div>
    </aside>

    <main class="flex-grow-1">
        <div class="content shadow-sm">
            <h2 class="page_title">Panel de Control</h2>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 rounded-4 shadow-sm border-0" style="background: #f0f7ff;">
                        <h6 class="text-muted text-uppercase small fw-bold">Pacientes Totales</h6>
                        <h2 class="fw-bold text-primary">
                            <?php 
                            $res = $conn->query("SELECT COUNT(*) as t FROM patients");
                            echo $res->fetch_assoc()['t']; 
                            ?>
                        </h2>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 rounded-4 shadow-sm border-0" style="background: #f0fff4;">
                        <h6 class="text-muted text-uppercase small fw-bold">Citas Pendientes</h6>
                        <h2 class="fw-bold text-success">0</h2>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 rounded-4 shadow-sm border-0" style="background: #fffcf0;">
                        <h6 class="text-muted text-uppercase small fw-bold">Sistema Activo</h6>
                        <h2 class="fw-bold text-warning">100%</h2>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="fw-bold mb-4">Acciones Rápidas</h4>
                <div class="d-flex gap-3">
                    <a href="pacientes_activos.php" class="btn btn-primary px-4 py-2" style="border-radius: 12px;">Gestionar Pacientes</a>
                    <a href="Usuarios.php" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 12px;">Ver Usuarios</a>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>
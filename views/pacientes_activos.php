<?php 
include_once '../config/conexion.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes Activos | DiaClinic Doctor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/pacientes activis.css">
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">
        
        <header class="col-12 d-lg-none bg-white p-3 d-flex justify-content-between align-items-center border-bottom sticky-top">
            <div class="d-flex align-items-center gap-2">
                <img src="../assets/logo.png" width="40" alt="Logo">
                <span class="fw-bold">DiaClinic Doctor</span>
            </div>
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarDoctor">
                ☰
            </button>
        </header>

        <aside class="col-lg-auto d-none d-lg-flex flex-column sidebar">
            <div class="logo_section">
                <img src="../assets/logo.png" width="80" alt="Logo">
                <h2>DiaClinic<br>Doctor</h2>
            </div>
            <nav class="nav flex-column mt-4">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
                <a class="nav-link" href="servicios.php">Servicios</a>
                <a class="nav-link active" href="pacientes_activos.php">Todos los pacientes</a>
            </nav>
            <div class="mt-auto pt-4 border-top">
                <p class="small text-muted mb-1">Settings</p>
                <p class="fw-bold mb-0">Dr. Emilio Ríos</p>
            </div>
        </aside>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarDoctor">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title fw-bold">DiaClinic Doctor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <nav class="nav flex-column">
                    <a class="nav-link" href="#">Dashboard</a>
                    <a class="nav-link" href="servicios.html">Servicios</a>
                    <a class="nav-link active">Todos los pacientes</a>
                </nav>
            </div>
        </div>

        <main class="col main_content">
            <div class="content_card shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="section_header_title m-0">Pacientes Activos</h1>
                    <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#modalNuevoPaciente" style="border-radius: 20px;">
                        + Nuevo Paciente
                    </button>
                </div>
                
                <div class="search_container mb-4">
                    <input class="search_bar_full_width" placeholder="Buscar Paciente por nombre o ID...">
                    <button class="btn_info_circle" title="Información de estados">i</button>
                </div>

                <div class="patients_table_container">
                    <div class="table_column_header d-none d-md-grid">
                        <div>Nombre del Paciente</div>
                        <div>Inicio Tratamiento</div>
                        <div>Estado Actual</div>
                        <div>Próxima Consulta</div>
                        <div>Acciones</div>
                    </div>

                    <?php
                    // Consulta uniendo pacientes con usuarios para obtener el nombre
                    $sql = "SELECT p.*, u.full_name, u.id_user 
                            FROM patients p 
                            INNER JOIN users u ON p.id_user = u.id_user 
                            WHERE u.status = 1";
                    $res = $conn->query($sql);

                    if ($res && $res->num_rows > 0):
                        while ($row = $res->fetch_assoc()):
                            // Determinar clase de estado
                            $estado = $row['health_status'];
                            $clase_estado = ($estado == 'Crítico') ? 'status_badge_critical' : 
                                           (($estado == 'Observación') ? 'status_badge_observation' : 'status_badge_stable');
                    ?>
                        <div class="patient_row_item">
                            <div class="text_link_blue"><?= htmlspecialchars($row['full_name']) ?></div>
                            <div class="date_text_highlight">
                                <span class="d-md-none text-muted fw-normal">Inicio: </span>
                                <?= date("d/m/Y", strtotime($row['created_at'])) ?>
                            </div>
                            <div><span class="<?= $clase_estado ?>"><?= $estado ?></span></div>
                            <div>
                                <span class="d-md-none text-muted fw-normal">Cita: </span>
                                <?= $row['next_appointment'] ? date("d/m/Y", strtotime($row['next_appointment'])) : 'Pendiente' ?>
                            </div>
                            <div class="d-flex gap-2 justify-content-md-start justify-content-center">
                                <button class="btn btn-sm btn-light border" data-bs-toggle="modal" data-bs-target="#edit<?= $row['id_patient'] ?>">
                                    Modificar
                                </button>
                                <a href="perfil_alimenticio.php?id=<?= $row['id_patient'] ?>" class="btn_history_solid text-decoration-none">
                                    Plan
                                </a>
                            </div>
                        </div>

                        <div class="modal fade" id="edit<?= $row['id_patient'] ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <form class="modal-content" action="../controllers/pacientes_controlador.php" method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Actualizar Estado de <?= $row['full_name'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id_patient" value="<?= $row['id_patient'] ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Estado Actual</label>
                                            <select name="health_status" class="form-select">
                                                <option value="Estable" <?= $estado == 'Estable' ? 'selected' : '' ?>>Estable</option>
                                                <option value="Observación" <?= $estado == 'Observación' ? 'selected' : '' ?>>Observación</option>
                                                <option value="Crítico" <?= $estado == 'Crítico' ? 'selected' : '' ?>>Crítico</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Próxima Consulta</label>
                                            <input type="date" name="next_appointment" class="form-control" value="<?= $row['next_appointment'] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="btn_actualizar" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    <?php endwhile; else: ?>
                        <div class="text-center p-5 text-muted">No se encontraron pacientes activos.</div>
                    <?php endif; ?>

                </div> 
            </div> 
        </main>
    </div>
</div>

<div class="modal fade" id="modalNuevoPaciente" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="../controllers/pacientes_controlador.php" method="POST">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Nuevo Paciente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3"><label>Nombre Completo</label><input type="text" name="nombre" class="form-control" required></div>
                <div class="mb-3"><label>Correo</label><input type="email" name="correo" class="form-control" required></div>
                <div class="mb-3">
                    <label>Estado Inicial</label>
                    <select name="health_status" class="form-select">
                        <option value="Estable">Estable</option>
                        <option value="Observación">Observación</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="btn_registrar" class="btn btn-success w-100">Crear Paciente</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
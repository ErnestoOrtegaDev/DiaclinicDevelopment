<?php 
include_once '../config/conexion.php'; 
// No incluimos el controlador aquí para evitar conflictos de header, 
// el controlador solo procesa las peticiones POST/GET.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiaClinic | Usuarios del Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/usuarios.css">
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">

        <header class="col-12 d-lg-none bg-white p-3 d-flex justify-content-between align-items-center border-bottom sticky-top">
            <div class="d-flex align-items-center gap-2">
                <img src="../assets/logo.png" width="35" alt="Logo">
                <span class="fw-bold">DiaClinic Admin</span>
            </div>
            <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarAdmin">☰</button>
        </header>

        <aside class="col-lg-auto d-none d-lg-flex flex-column sidebar shadow-sm">
            <div class="logo text-center">
                <img src="../assets/logo.png" alt="Logo">
                <h3>DiaClinic</h3>
                <span class="badge bg-secondary">Administración</span>
            </div>
            <nav class="menu nav flex-column">
                <a class="nav-link" href="#">Dashboard</a>
                <a class="nav-link active" href="#">Todos los usuarios</a>
            </nav>
            <div class="sidebar_footer mt-auto">
                <div class="user_profile_box">
                    <span class="fw-bold">Administrador</span>
                </div>
            </div>
        </aside>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarAdmin">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title fw-bold">DiaClinic Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <nav class="menu nav flex-column">
                    <a class="nav-link mb-2" href="#">Dashboard</a>
                    <a class="nav-link active" href="#">Todos los usuarios</a>
                </nav>
            </div>
        </div>

        <main class="col content shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="page_title m-0">Usuarios del Sistema</h1>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear" style="background-color: #f36f8d; border:none;">
                    + Nuevo Usuario
                </button>
            </div>

            <div class="search_container d-flex gap-2 mb-4">
                <input type="text" class="form-control border-0" placeholder="Buscar usuario por nombre o correo...">
                <button class="info_btn">i</button>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Nombre de Usuario</th>
                            <th>Correo de Contacto</th>
                            <th>Rol</th>
                            <th>Estatus</th>
                            <th>Fecha de Ingreso</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $resultado = $conn->query("SELECT * FROM users ORDER BY created_at DESC");
                        while ($row = $resultado->fetch_assoc()): 
                        ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($row['full_name']) ?></strong></td>
                            <td class="email"><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= ucfirst($row['role']) ?></td>
                            <td><span class="<?= ($row['status'] == 1) ? 'status_active' : 'status_deleted' ?>">
                                <?= ($row['status'] == 1) ? 'Activo' : 'Inactivo' ?></span>
                            </td>
                            <td><?= date("d/m/Y", strtotime($row['created_at'])) ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-warning me-1" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $row['id_user'] ?>">Modificar</button>
                                <a href="../controllers/usuarios_controlador.php?action=delete&id=<?= $row['id_user'] ?>" 
                                   class="delete_btn text-decoration-none" onclick="return confirm('¿Eliminar usuario?')">Eliminar</a>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalEditar<?= $row['id_user'] ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <form class="modal-content" action="../controllers/usuarios_controlador.php" method="POST">
                                    <div class="modal-header"><h5>Modificar Usuario</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
                                        <div class="mb-3"><label>Nombre</label><input type="text" name="nombre" class="form-control" value="<?= $row['full_name'] ?>" required></div>
                                        <div class="mb-3"><label>Correo</label><input type="email" name="correo" class="form-control" value="<?= $row['email'] ?>" required></div>
                                        <div class="mb-3">
                                            <label>Rol</label>
                                            <select name="role" class="form-select">
                                                <option value="patient" <?= $row['role']=='patient'?'selected':'' ?>>Paciente</option>
                                                <option value="doctor" <?= $row['role']=='doctor'?'selected':'' ?>>Doctor</option>
                                                <option value="admin" <?= $row['role']=='admin'?'selected':'' ?>>Administrador</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer"><button type="submit" name="btn_editar" class="btn btn-warning">Actualizar</button></div>
                                </form>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<div class="modal fade" id="modalCrear" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="../controllers/usuarios_controlador.php" method="POST">
            <div class="modal-header"><h5>Nuevo Usuario</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label>Nombre Completo</label><input type="text" name="nombre" class="form-control" required></div>
                <div class="mb-3"><label>Correo</label><input type="email" name="correo" class="form-control" required></div>
                <div class="mb-3"><label>Contraseña</label><input type="password" name="password" class="form-control" required></div>
                <div class="mb-3"><label>Rol</label>
                    <select name="role" class="form-select">
                        <option value="patient">Paciente</option>
                        <option value="doctor">Doctor</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer"><button type="submit" name="btn_registrar" class="btn btn-primary" style="background-color: #f36f8d; border:none;">Guardar</button></div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
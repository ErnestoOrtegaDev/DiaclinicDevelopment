<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiaClinic | Perfil Alimenticio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/perfil_alimenticio.css">
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">
        
        <div class="col-12 d-lg-none bg-white p-3 d-flex justify-content-between align-items-center border-bottom">
            <div class="d-flex align-items-center gap-2">
                <img src="../assets/logo.png" style="width: 35px;" alt="Logo">
                <span class="fw-bold">DiaClinic</span>
            </div>
            <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile">
                Menú ☰
            </button>
        </div>

        <aside class="col-lg-auto d-none d-lg-flex flex-column sidebar_container">
            <div class="sidebar_top">
                <div class="sidebar_logo_top">
                    <img src="../assets/logo.png" alt="Logo DiaClinic">
                    <p>DiaClinic</p>
                </div>
                <nav class="sidebar_nav_list nav flex-column">
                    <a href="#" class="sidebar_nav_item">Pacientes</a>
                    <a href="#" class="sidebar_nav_item">Consultas</a>
                    <a href="#" class="sidebar_nav_item">Servicios</a>
                    <a href="#" class="sidebar_nav_item sidebar_item_active">Asignación Alimenticia</a>
                </nav>
            </div>
            <div class="sidebar_bottom_settings mt-auto">
                <p class="m-0 text-muted">Settings</p>
                <p class="m-0 fw-bold">Dr. Emilio Ríos</p>
            </div>
        </aside>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMobile">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title fw-bold">DiaClinic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body sidebar_container w-100 border-0">
                <nav class="sidebar_nav_list nav flex-column">
                    <a href="#" class="sidebar_nav_item">Pacientes</a>
                    <a href="#" class="sidebar_nav_item">Consultas</a>
                    <a href="#" class="sidebar_nav_item">Servicios</a>
                    <a href="#" class="sidebar_nav_item sidebar_item_active">Asignación Alimenticia</a>
                </nav>
            </div>
        </div>

        <main class="col main_content_wrapper shadow-sm">
            <header class="page_header">
                <h1 class="page_header_title">Asignación Alimenticia</h1>
                <p class="page_subtitle_text">Plan diabético para el paciente</p>
                <span class="patient_name_badge">Mario López</span>
            </header>

            <section class="row g-4 cards_grid_layout">
                
                <div class="col-12 col-md-6">
                    <div class="card_success_green h-100">
                        <h3 class="card_header_text">Alimentos recomendados</h3>
                        <ul class="card_list_items">
                            <li>Quinoa</li><li>Avena</li><li>Arroz integral</li>
                            <li>Espinaca</li><li>Brócoli</li><li>Pescado</li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card_danger_red h-100">
                        <h3 class="card_header_text">Alimentos a evitar</h3>
                        <ul class="card_list_items">
                            <li>Refrescos</li><li>Pan blanco</li><li>Azúcar refinada</li>
                            <li>Comida rápida</li><li>Frituras</li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card_warning_yellow h-100">
                        <h3 class="card_header_text">Reglas prácticas</h3>
                        <ul class="card_list_items">
                            <li>5 a 6 comidas al día</li><li>No saltarse comidas</li>
                            <li>Monitorear glucosa</li><li>Hidratarse bien</li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card_info_orange h-100">
                        <h3 class="card_header_text">Recomendaciones especiales</h3>
                        <ul class="card_list_items">
                            <li>Ejercicio moderado</li><li>Consulta nutricional</li>
                            <li>Ajustar dieta regularmente</li>
                        </ul>
                    </div>
                </div>

            </section>

            <div class="mt-4">
                <button class="btn_save_large w-100 w-sm-auto">
                    Guardar Asignación
                </button>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

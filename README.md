# 🏥 DiaClinic - Sistema de Gestión de Salud

DiaClinic es una aplicación web enfocada en la detección y control de la diabetes, permitiendo la gestión de pacientes, doctores, citas, laboratorios y planes alimenticios.

## 📁 Estructura del Proyecto

El proyecto está construido con una arquitectura estructurada para separar la lógica, la base de datos y la interfaz gráfica:

    DIACLINIC/
    ├── assets/                 # Imágenes, iconos y recursos gráficos
    ├── config/                 # Archivos de configuración global
    │   └── conexion.php        # Conexión a la base de datos MySQL
    ├── controllers/            # Lógica del lado del servidor (PHP)
    │   ├── login.php           # Autenticación y manejo de sesiones
    │   └── registro.php        # Procesamiento y encriptación de nuevos usuarios
    ├── models/                 # Modelos de base de datos (Clases/Consultas SQL)
    ├── routes/                 # Enrutadores para la navegación del sistema
    ├── styles/                 # Hojas de estilo CSS personalizadas
    │   ├── index.css
    │   ├── pantalla_login.css
    │   └── pantalla_registro.css
    ├── views/                  # Vistas HTML/PHP de la interfaz de usuario
    │   ├── asignacion alimenticia.html
    │   ├── doctores.html
    │   ├── pacientes activos.html
    │   ├── pantalla_home.html
    │   ├── pantalla_laboratorios.html
    │   ├── pantalla_login.html
    │   ├── pantalla_registro.html
    │   ├── perfil_alimenticio.html
    │   ├── servicios.html
    │   └── Usuarios.html
    └── index.html              # Landing page principal

## 🚀 Guía de Instalación para el Equipo de Desarrollo

Sigue estos pasos para clonar el proyecto y configurarlo en tu entorno local usando **XAMPP**.

### 1. Clonar el repositorio
Abre tu terminal (Git Bash o CMD) y navega hasta la carpeta `htdocs` de tu instalación de XAMPP (por lo general, `C:\xampp\htdocs\` o `D:\xampp\htdocs\`). Ejecuta el siguiente comando:

    git clone https://github.com/ErnestoOrtegaDev/DiaclinicDevelopment

*Asegúrate de cambiar el nombre de la carpeta a `diaclinic` si se clona con un nombre distinto.*

### 2. Iniciar Servicios
Abre el panel de control de **XAMPP** como Administrador e inicia los siguientes módulos:
* **Apache**
* **MySQL** (Asegúrate de que esté corriendo en el puerto `3306`. Si usas otro puerto como `3307`, deberás modificar el archivo `config/conexion.php`).

### 3. Configurar la Base de Datos
1. Abre tu navegador y ve a `http://localhost/phpmyadmin/`.
2. Crea una nueva base de datos llamada **`diabetes_app`** con el cotejamiento `utf8mb4_general_ci`.
3. Ve a la pestaña **Importar**.
4. Selecciona el archivo SQL del proyecto (pídeselo al administrador o búscalo en la carpeta raíz si está versionado) y haz clic en "Continuar".

### 4. Ejecutar el Proyecto
Abre tu navegador web y escribe la siguiente ruta:

    http://localhost/diaclinic/

*(Si tu carpeta en htdocs se llama diferente, ajusta la URL).*

## 🛠️ Tecnologías Utilizadas
* **Frontend:** HTML5, CSS3, Bootstrap 5.3.0
* **Backend:** PHP 8+
* **Base de Datos:** MySQL / MariaDB
* **Servidor Local:** XAMPP (Apache)

## ⚠️ Notas Importantes para Desarrolladores
* **Contraseñas:** El sistema utiliza `password_hash()` de PHP. Nunca insertes usuarios manualmente en la base de datos con contraseñas en texto plano, o el login fallará.
* **Sesiones:** Para trabajar en las vistas internas (como `Usuarios.html`), eventualmente migraremos los archivos a `.php` para proteger las rutas mediante variables de `$_SESSION`.

## 🔄 Flujo de Trabajo con Git (Subir Cambios a Main)

En este proyecto trabajaremos directamente sobre la rama `main`. Para evitar conflictos de código y pérdida de trabajo, **es obligatorio** seguir este orden exacto al momento de subir tus cambios:

### 1. Actualiza tu entorno local (¡Haz esto ANTES de empezar a programar y ANTES de subir!)
Siempre descarga los últimos cambios que hayan subido tus compañeros para asegurarte de que tienes la versión más reciente del proyecto.

    git pull origin main

### 2. Revisa qué archivos modificaste
Verifica qué archivos has cambiado, agregado o eliminado.

    git status

### 3. Prepara tus cambios
Agrega todos los archivos modificados al área de preparación (staging).

    git add .

*(Si solo quieres subir un archivo específico, usa `git add nombre_del_archivo.ext`).*

### 4. Crea tu Commit
Guarda tus cambios con un mensaje claro y descriptivo de lo que hiciste.

    git commit -m "Descripción breve pero clara de los cambios realizados"

*Ejemplo:* `git commit -m "Se agregó el backend del login y registro"`

### 5. Sube tus cambios al repositorio
Envía tu código a la rama principal en la nube para que el resto del equipo pueda verlo.

    git push origin main

> **⚠️ IMPORTANTE:** Si al hacer `git push` la terminal te arroja un error diciendo que tu rama está "detrás" (behind) de la remota, significa que alguien más subió cambios mientras tú programabas. Solo ejecuta `git pull origin main` nuevamente, resuelve los conflictos si los hay, y vuelve a intentar el push.

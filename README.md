# 🏥 DiaClinic - Sistema de Gestión de Salud

DiaClinic es una aplicación web enfocada en la detección y control de la diabetes, permitiendo la gestión de pacientes, doctores, citas, laboratorios y planes alimenticios.

---

## 📁 Estructura del Proyecto

El proyecto está construido con una arquitectura estructurada para separar la lógica, la base de datos y la interfaz gráfica:

```text
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
```
---

## 🚀 Guia de Instalacion para Equipo de Desarrollo
Sigue estos pasos para clonar el proyecto y configurarlo en tu entorno local usando XAMPP.

### 1. Clonar el repositorio
Abre tu terminal (Git Bash o CMD) y navega hasta la carpeta htdocs de tu instalación de XAMPP (por lo general, C:\xampp\htdocs\ o D:\xampp\htdocs\). Ejecuta el siguiente comando:
```
git clone https://github.com/ErnestoOrtegaDev/DiaclinicDevelopment.git
```
Asegúrate de cambiar el nombre de la carpeta a diaclinic si se clona con un nombre distinto.

### 2. Iniciar Servicios
Abre el panel de control de XAMPP como Administrador e inicia los siguientes módulos:

Apache

MySQL (Asegúrate de que esté corriendo en el puerto 3306. Si usas otro puerto como 3307, deberás modificar el archivo config/conexion.php).

### 3. Configurar la Base de Datos
Abre tu navegador y ve a http://localhost/phpmyadmin/.

Crea una nueva base de datos llamada diabetes_app con el cotejamiento utf8mb4_general_ci.

Ve a la pestaña Importar.

Selecciona el archivo SQL del proyecto (pídeselo al administrador o búscalo en la carpeta raíz si está versionado) y haz clic en "Continuar".

### 4. Ejecutar el Proyecto
Abre tu navegador web y escribe la siguiente ruta:

http://localhost/diaclinic/

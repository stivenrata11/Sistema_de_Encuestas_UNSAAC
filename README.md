# Sistema de Gestión de Encuestas Universitarias

## Tabla de Contenidos
- [Descripción del Proyecto](#-descripción-del-proyecto)
- [Tecnologías Utilizadas](#-tecnologías-utilizadas)
- [Estructura de la Base de Datos](#-estructura-de-la-base-de-datos)
- [Roles y Permisos](#-roles-y-permisos)
- [Módulos Principales](#-módulos-principales)
- [Instalación](#-instalación)
- [Características Destacadas](#-características-destacadas)
- [Contribución](#-contribución)
- [Licencia](#-licencia)
- [Contacto](#-contacto)

## 📌 Descripción del Proyecto
Sistema integral para la gestión de encuestas universitarias con:
- Administración de usuarios con roles diferenciados
- Gestión jerárquica de facultades → escuelas → encuestas
- Soporte para múltiples formatos de encuestas (PDF, DOCX, XLSX, Google Forms)
- Panel de visualización de métricas avanzadas

## 🛠 Tecnologías Utilizadas
| Área          | Tecnologías                                                                 |
|---------------|-----------------------------------------------------------------------------|
| **Backend**   | PHP 8+, MySQL, PDO                                                          |
| **Frontend**  | HTML5, CSS3, JavaScript, Bootstrap 5, Chart.js                              |
| **Herramientas** | Composer, Git, Visual Studio Code                                        |

## 🗃 Estructura de la Base de Datos
mermaid
erDiagram
    ROLES ||--o{ USUARIOS : "1:N"
    FACULTADES ||--o{ ESCUELAS : "1:N"
    ESCUELAS ||--o{ ENCUESTAS : "1:N"
    
    ROLES {
        int id_rol PK
        varchar(255) nombre_rol
        datetime fyh_creacion
        varchar(11) estado
    }
    
    USUARIOS {
        int id_usuario PK
        varchar(255) nombres
        int rol_id FK
        varchar(255) email
        text password
    }
    
    FACULTADES {
        int id_facultad PK
        varchar(255) nombre_facultad
        varchar(50) codigo_facultad
    }
    
    ESCUELAS {
        int id_escuela PK
        varchar(255) nombre_escuela
        int facultad_id FK
    }
    
    ENCUESTAS {
        int id_encuestas PK
        int escuela_id FK
        varchar(255) nombre
        varchar(50) tipo
        text url
    }

## 🔐 Roles y Permisos

|---------------|-----------------------------------------------------------------------------|
    Rol             Permisos
|---------------|-----------------------------------------------------------------------------|
    Administrador      Acceso completo al sistema, CRUD de todas las entidades
|---------------|-----------------------------------------------------------------------------|
    Director        Gestión de encuestas para sus facultades/escuelas, visualización de datos
|---------------|-----------------------------------------------------------------------------|
    Usuario         Consulta de encuestas asignadas, operaciones limitadas
|---------------|-----------------------------------------------------------------------------|

## 📊 Módulos Principales
1. Gestión de Usuarios y Roles
    Creación y asignación de roles

    Perfiles de usuario personalizables

    Control de acceso basado en roles

2. Administración Académica
    Facultades:

    Registro con código único

    Histórico de modificaciones

    Escuelas Profesionales:

    Vinculación automática con facultades

    Dashboard específico por escuela

3. Sistema de Encuestas
    Tipos soportados:

    Documentos (PDF, DOCX, XLSX)

    Google Forms (integrado via URL)

    Características:

    Asignación por escuela profesional

    Seguimiento de estado (Activo/Inactivo)

    Sistema de observaciones

4. Panel Estadístico
    Gráficos interactivos por:

    Facultad y tipo de encuesta

    Distribución temporal

    Estado de completitud

    Exportación de reportes en múltiples formatos

## 🚀 Instalación

1. Requisitos previos:
    - Servidor web (Apache/Nginx)
    - PHP 8.0+
    - MySQL 5.7+
    - Composer (para dependencias)

2. Configuración inicial:
    git clone https://github.com/tu-usuario/sistema-encuestas.git
    cd sistema-encuestas
    composer install

3. Configurar archivo de entorno:
    # app/config.php
    define('APP_URL', 'http://tudominio.com');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'nombre_bd');
    define('DB_USER', 'usuario_bd');
    define('DB_PASS', 'contraseña_bd');

4. Importar estructura de base de datos:
    mysql -u usuario -p nombre_bd < db/database.sql

## 🌟 Características Destacadas

++++++++++++
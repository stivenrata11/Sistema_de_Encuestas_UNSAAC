<?php

define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('PASSWORD', '');
define('BD', 'sistema');

define('NAME', 'Sistema de Gestión de Encuestas');
define('APP_URL', 'http://localhost/sistema');
define('KEY_API_MAPS', '');

$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR;

try {
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    // echo "Conexión exitosa a la base de datos";
} catch (PDOException $e) {
    echo "Error, no se pudo conectar a la base de datos: " . $e->getMessage();
    exit(); // Detener la ejecución si hay un error
}

// Configurar zona horaria correctamente
date_default_timezone_set("America/Lima");

// Obtener la fecha y hora actual en distintos formatos
$fechaHora = date('Y-m-d H:i:s');
$fecha_actual = date('Y-m-d');
$dia_actual = date('d');
$mes_actual = date('m');
$anio_actual = date('Y');
$estado_de_registro = '1';

// Mostrar los valores obtenidos
/*echo "Fecha y hora actual: $fechaHora<br>";
echo "Fecha actual: $fecha_actual<br>";
echo "Día actual: $dia_actual<br>";
echo "Mes actual: $mes_actual<br>";
echo "Año actual: $anio_actual<br>";*/

<?php
include("../../../app/config.php");

$nombre_escuela = $_POST['nombre_escuela'];
$codigo_escuela = $_POST['codigo_escuela'];
$facultad_id = $_POST['facultad_id'];

// Definir las variables de fecha y estado aquí
$fechaHora = date('Y-m-d H:i:s');
$estado_de_registro = '1';

    $sentencia = $pdo->prepare("INSERT INTO escuelas (nombre_escuela, codigo_escuela, facultad_id, fyh_creacion, estado)
    VALUES (:nombre_escuela, :codigo_escuela, :facultad_id, :fyh_creacion, :estado)");

    $sentencia->bindParam(':nombre_escuela', $nombre_escuela);
    $sentencia->bindParam(':codigo_escuela', $codigo_escuela);
    $sentencia->bindParam(':facultad_id', $facultad_id);
    $sentencia->bindParam(':fyh_creacion', $fechaHora);
    $sentencia->bindParam(':estado', $estado_de_registro);

    try {
        if($sentencia->execute()){
            session_start();
            $_SESSION['mensaje'] = "Se agrego la escuela profesional";
            $_SESSION['icono'] = "success";
            header('Location: ' . APP_URL . "/admin/escuelas");
        }else{
            session_start();
            $_SESSION['mensaje'] = "No se pudo agregar la escuela profesional";
            $_SESSION['icono'] = "error";
            ?><script>window.history.back();</script><?php
        }
    } catch (Exception $exception) {
        session_start();
        $_SESSION['mensaje'] = "La escuela profesional ya existe";
        $_SESSION['icono'] = "error";
        ?><script>window.history.back();</script><?php
    }

?>
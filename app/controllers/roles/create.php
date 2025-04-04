<?php
include ('../../../app/config.php');

$nombre_rol = $_POST['nombre_rol'];
$nombre_rol = mb_strtoupper($nombre_rol,'UTF-8');

if($nombre_rol==''){
    session_start();
        $_SESSION['mensaje'] = "Rellena el campo: Nombre de rol";
        $_SESSION['icono'] = "error";
        header('Location: ' . APP_URL . "/admin/roles/create.php");
}else{
    $sentencia = $pdo->prepare("INSERT INTO roles (nombre_rol, fyh_creacion, estado) 
    VALUES (:nombre_rol, :fyh_creacio, :estado);");

    $sentencia->bindParam('nombre_rol', $nombre_rol);
    $sentencia->bindParam('fyh_creacio', $fechaHora);
    $sentencia->bindParam('estado', $estado_de_registro);

    try{
        if($sentencia->execute()){
            session_start();
                $_SESSION['mensaje'] = "Rol creado con exito";
                $_SESSION['icono'] = "success";
                header('Location: ' . APP_URL . "/admin/roles");
        }else{
            session_start();
                $_SESSION['mensaje'] = "Error al crear el rol";
                $_SESSION['icono'] = "error";
                header('Location: ' . APP_URL . "/admin/roles/create.php");
        }
    }catch (Exception $exception) {
        session_start();
                $_SESSION['mensaje'] = "Este rol ya existe";
                $_SESSION['icono'] = "error";
                header('Location: ' . APP_URL . "/admin/roles/create.php");
    }
}
?>
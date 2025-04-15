<?php
include("../../../app/config.php");

$nombre_facultad = $_POST['nombre_facultad'];
$codigo_facultad = $_POST['codigo_facultad'];
$codigo_facultad = mb_strtoupper($codigo_facultad, 'UTF-8');

if($nombre_facultad=="" and $codigo_facultad==""){
    session_start();
                $_SESSION['mensaje'] = "Complete los campos";
                $_SESSION['icono'] = "error";
                header('Location: ' . APP_URL . "/admin/facultades/create.php");
}else{
    $sentencia = $pdo->prepare("INSERT INTO facultades (nombre_facultad, codigo_facultad, fyh_creacion, estado) 
    VALUES (:nombre_facultad, :codigo_facultad, :fyh_creacion, :estado)");

    $sentencia->bindParam('nombre_facultad', $nombre_facultad);
    $sentencia->bindParam('codigo_facultad', $codigo_facultad);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    $sentencia->bindParam('estado', $estado_de_registro);

    try{
        if($sentencia->execute()){
            session_start();
                        $_SESSION['mensaje'] = "Facultad agregada con exito";
                        $_SESSION['icono'] = "success";
                        header('Location: ' . APP_URL . "/admin/facultades");
        }else{
            session_start();
                        $_SESSION['mensaje'] = "Error al agregar la facultad";
                        $_SESSION['icono'] = "error";
                        header('Location: ' . APP_URL . "/admin/facultades/create.php");
        }
    }catch(Exception $exception){
        session_start();
                        $_SESSION['mensaje'] = "La facultad ya existe";
                        $_SESSION['icono'] = "error";
                        header('Location: ' . APP_URL . "/admin/facultades/create.php");
    }

}
?>
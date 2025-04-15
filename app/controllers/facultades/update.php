<?php
include ('../../../app/config.php');

$id_facultad = $_POST['id_facultad'];
$nombre_facultad = $_POST['nombre_facultad'];
$codigo_facultad = $_POST['codigo_facultad'];
$codigo_facultad = mb_strtoupper($codigo_facultad,'UTF-8');



if($nombre_facultad==''){
    session_start();
        $_SESSION['mensaje'] = "Rellena el campo: Nombre de la facultad";
        $_SESSION['icono'] = "error";
        header('Location: ' . APP_URL . "/admin/facultades/edit.php?id=".$id_facultad);
}else{
    $sentencia = $pdo->prepare("UPDATE facultades SET nombre_facultad=:nombre_facultad, codigo_facultad=:codigo_facultad, fyh_actualizacion=:fyh_actualizacion WHERE id_facultad=:id_facultad ");

    $sentencia->bindParam('nombre_facultad', $nombre_facultad);
    $sentencia->bindParam('codigo_facultad', $codigo_facultad);
    $sentencia->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia->bindParam('id_facultad', $id_facultad);

    try{
        if($sentencia->execute()){
            session_start();
                $_SESSION['mensaje'] = "Facultad actualizada con exito";
                $_SESSION['icono'] = "success";
                header('Location: ' . APP_URL . "/admin/facultades");
        }else{
            session_start();
                $_SESSION['mensaje'] = "Error al actualizar la facultad";
                $_SESSION['icono'] = "error";
                header('Location: ' . APP_URL . "/admin/facultades/edit.php?id=". $id_facultad);
        }
    }catch (Exception $exception) {
        session_start();
                $_SESSION['mensaje'] = "Esta facultad ya existe";
                $_SESSION['icono'] = "error";
                header('Location: ' . APP_URL . "/admin/facultades/edit.php?id=". $id_facultad);
    }
}
?>
<?php
include("../../../app/config.php");

$id_escuela = $_POST['id_escuela'];
$nombre_escuela = $_POST['nombre_escuela'];
$codigo_escuela = $_POST['codigo_escuela'];
$facultad_id = $_POST['facultad_id'];

if($nombre_escuela=='' and $codigo_escuela==''){
    session_start();
        $_SESSION['mensaje'] = "Rellena el campo: Nombre de la facultad";
        $_SESSION['icono'] = "error";
        header('Location: ' . APP_URL . "/admin/escuelas/edit.php?id=".$id_facultad);
}else{
    $sentencia = $pdo->prepare("UPDATE escuelas SET nombre_escuela=:nombre_escuela, codigo_escuela=:codigo_escuela, facultad_id=:facultad_id, fyh_actualizacion=:fyh_actualizacion WHERE id_escuela=:id_escuela ");

    $sentencia->bindParam('nombre_escuela', $nombre_escuela);
    $sentencia->bindParam('codigo_escuela', $codigo_escuela);
    $sentencia->bindParam(':facultad_id', $facultad_id);
    $sentencia->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia->bindParam('id_escuela', $id_escuela);

    try{
        if($sentencia->execute()){
            session_start();
                $_SESSION['mensaje'] = "Escuela profesional actualizada con exito";
                $_SESSION['icono'] = "success";
                header('Location: ' . APP_URL . "/admin/escuelas");
        }else{
            session_start();
                $_SESSION['mensaje'] = "Error al actualizar la escuela profesional";
                $_SESSION['icono'] = "error";
                header('Location: ' . APP_URL . "/admin/escuelas/edit.php?id=". $id_escuela);
        }
    }catch (Exception $exception) {
        session_start();
                $_SESSION['mensaje'] = "Esta escuela profesional ya existe";
                $_SESSION['icono'] = "error";
                header('Location: ' . APP_URL . "/admin/escuelas/edit.php?id=". $id_escuela);
    }
}

       /* // Definir las variables de fecha y estado aquí
        $fechaHora = date('Y-m-d H:i:s');
        $estado_de_registro = '1';
    
        $sentencia = $pdo->prepare("UPDATE escuelas SET nombre_escuela=:nombre_escuela,
        codigo_escuela=:codigo_escuela,
        facultad_id=:facultad_id,
        fyh_actualizacion=:fyh_actualizacion,
        WHERE id_escuela=:id_escuela");
    
        $sentencia->bindParam(':nombre_escuela', $nombre_escuela);
        $sentencia->bindParam(':codigo_escuela', $codigo_escuela);
        $sentencia->bindParam(':facultad_id', $facultad_id);
        $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
        $sentencia->bindParam(':id_escuela', $id_escuela);
    
        try {
            if($sentencia->execute()){
                session_start();
                $_SESSION['mensaje'] = "Se actualizo la escuela profesional";
                $_SESSION['icono'] = "success";
                header('Location: ' . APP_URL . "/admin/escuelas");
            }else{
                session_start();
                $_SESSION['mensaje'] = "No se pudo actualizar la escuela profesional";
                $_SESSION['icono'] = "error";
                ?><script>window.history.back();</script><?php
            }
        } catch (Exception $exception) {
            session_start();
            $_SESSION['mensaje'] = "La escuela profesional ya existe";
            $_SESSION['icono'] = "error";
            ?><script>window.history.back();</script><?php
        }*/

?>
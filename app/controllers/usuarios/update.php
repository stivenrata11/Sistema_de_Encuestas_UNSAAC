<?php
include("../../../app/config.php");

$id_usuario = $_POST['id_usuario'];
$nombres = $_POST['nombres'];
$rol_id = $_POST['rol_id'];
$email = $_POST['email'];

$password = $_POST['password'];
$password_repet = $_POST['password_repet'];

if($password==""){
        // Definir las variables de fecha y estado aquí
        $fechaHora = date('Y-m-d H:i:s');
        $estado_de_registro = '1';
    
        $sentencia = $pdo->prepare("UPDATE usuarios SET nombres=:nombres,
        rol_id=:rol_id,
        email=:email,
        fyh_actualizacion=:fyh_actualizacion
        WHERE id_usuario=:id_usuario");
    
        $sentencia->bindParam(':nombres', $nombres);
        $sentencia->bindParam(':rol_id', $rol_id);
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
        $sentencia->bindParam(':id_usuario', $id_usuario);
    
        try {
            if($sentencia->execute()){
                session_start();
                $_SESSION['mensaje'] = "Se actualizo el usuario";
                $_SESSION['icono'] = "success";
                header('Location: ' . APP_URL . "/admin/usuarios");
            }else{
                session_start();
                $_SESSION['mensaje'] = "No se pudo actualizar al usuario";
                $_SESSION['icono'] = "error";
                ?><script>window.history.back();</script><?php
            }
        } catch (Exception $exception) {
            session_start();
            $_SESSION['mensaje'] = "El email ya existe";
            $_SESSION['icono'] = "error";
            ?><script>window.history.back();</script><?php
        }
}else{
    if($password == $password_repet){
        $password =password_hash($password, PASSWORD_DEFAULT);
    
        // Definir las variables de fecha y estado aquí
        $fechaHora = date('Y-m-d H:i:s');
        $estado_de_registro = '1';
    
        $sentencia = $pdo->prepare("UPDATE usuarios SET nombres=:nombres,
        rol_id=:rol_id,
        email=:email,
        password=:password,
        fyh_actualizacion=:fyh_actualizacion
        WHERE id_usuario=:id_usuario");
    
        $sentencia->bindParam(':nombres', $nombres);
        $sentencia->bindParam(':rol_id', $rol_id);
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':password', $password);
        $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
        $sentencia->bindParam(':id_usuario', $id_usuario);
    
        try {
            if($sentencia->execute()){
                session_start();
                $_SESSION['mensaje'] = "Se registro el usuario";
                $_SESSION['icono'] = "success";
                header('Location: ' . APP_URL . "/admin/usuarios");
            }else{
                session_start();
                $_SESSION['mensaje'] = "No se pudo registar al usuario";
                $_SESSION['icono'] = "error";
                ?><script>window.history.back();</script><?php
            }
        } catch (Exception $exception) {
            session_start();
            $_SESSION['mensaje'] = "El email ya existe";
            $_SESSION['icono'] = "error";
            ?><script>window.history.back();</script><?php
        }
    
    }else{
        echo "las contraseñas no son iguales";
        session_start();
        $_SESSION['mensaje'] = "Las contraseñas introducidas no son iguales";
        $_SESSION['icono'] = "error";
        ?><script>window.history.back();</script><?php
    }
}

?>
<?php
include ('../../../app/config.php');

$id_rol = $_POST["id_rol"];

// Verificar si el rol está siendo usado por algún usuario
$sql_usuarios = "SELECT * FROM usuarios WHERE estado = '1' AND rol_id = :id_rol";
$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->bindParam(':id_rol', $id_rol);
$query_usuarios->execute();
$usuarios = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

if(count($usuarios) > 0) {
    session_start();
    $_SESSION['mensaje'] = "No se puede eliminar el rol porque está siendo utilizado por uno o más usuarios";
    $_SESSION['icono'] = "error";
    header('Location: ' . APP_URL . "/admin/roles");
    exit();
}

try {
    // Intentar eliminar el rol
    $sentencia = $pdo->prepare("UPDATE roles SET estado = '0' WHERE id_rol = :id_rol");
    $sentencia->bindParam(':id_rol', $id_rol);
    
    if($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Rol eliminado con éxito";
        $_SESSION['icono'] = "success";
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al eliminar el rol";
        $_SESSION['icono'] = "error";
    }
} catch (PDOException $e) {
    session_start();
    $_SESSION['mensaje'] = "Error al eliminar el rol: " . $e->getMessage();
    $_SESSION['icono'] = "error";
}

header('Location: ' . APP_URL . "/admin/roles");
exit();
?>
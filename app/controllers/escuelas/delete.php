<?php
include ('../../../app/config.php');

$id_escuela = $_POST["id_escuela"];

try {
    // Primero verificar si hay encuestas asociadas
    $sql_check = "SELECT COUNT(*) as total FROM encuestas WHERE escuela_id = :id_escuela";
    $query_check = $pdo->prepare($sql_check);
    $query_check->bindParam('id_escuela', $id_escuela);
    $query_check->execute();
    $result = $query_check->fetch(PDO::FETCH_ASSOC);
    
    if ($result['total'] > 0) {
        // Hay encuestas asociadas, no se puede eliminar
        session_start();
        $_SESSION['mensaje'] = "No se puede eliminar la escuela profesional porque tiene encuestas asociadas";
        $_SESSION['icono'] = "error";
        header('Location: ' . APP_URL . "/admin/escuelas");
        exit();
    }
    
    // Si no hay encuestas asociadas, proceder con la eliminación
    $sentencia = $pdo->prepare("DELETE FROM escuelas WHERE id_escuela=:id_escuela");
    $sentencia->bindParam('id_escuela', $id_escuela);
    
    if($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Escuela profesional eliminada con éxito";
        $_SESSION['icono'] = "success";
        header('Location: ' . APP_URL . "/admin/escuelas");
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al eliminar la escuela profesional";
        $_SESSION['icono'] = "error";
        header('Location: ' . APP_URL . "/admin/escuelas");
    }
} catch (PDOException $e) {
    session_start();
    $_SESSION['mensaje'] = "Error al procesar la solicitud: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    header('Location: ' . APP_URL . "/admin/escuelas");
}
?>
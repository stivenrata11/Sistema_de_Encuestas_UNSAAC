<?php
include('../../../app/config.php');

$id_encuesta = $_POST["id_encuesta"];

// Primero obtener la URL del archivo para eliminarlo físicamente
$sentencia_select = $pdo->prepare("SELECT url FROM encuestas WHERE id_encuestas = :id_encuesta");
$sentencia_select->bindParam(':id_encuesta', $id_encuesta);
$sentencia_select->execute();
$encuesta = $sentencia_select->fetch(PDO::FETCH_ASSOC);

// Eliminar el archivo físico si no es un Google Form
if ($encuesta && strpos($encuesta['url'], 'http') === false) {
    $filePath = '../../../' . ltrim($encuesta['url'], '/');
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

// Luego eliminar el registro de la base de datos
$sentencia = $pdo->prepare("DELETE FROM encuestas WHERE id_encuestas = :id_encuesta");
$sentencia->bindParam(':id_encuesta', $id_encuesta);

try {
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Encuesta eliminada con éxito";
        $_SESSION['icono'] = "success";
        header('Location: ' . APP_URL . "/admin/encuestas");
        exit;
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al eliminar la encuesta";
        $_SESSION['icono'] = "error";
        header('Location: ' . APP_URL . "/admin/encuestas");
        exit;
    }
} catch (Exception $exception) {
    session_start();
    $_SESSION['mensaje'] = "Ocurrió un error al eliminar la encuesta";
    $_SESSION['icono'] = "error";
    header('Location: ' . APP_URL . "/admin/encuestas");
    exit;
}
?>
<?php
include("../../../app/config.php");

// Datos recibidos desde el formulario
$escuela_id     = $_POST['escuela_id'];
$anio_academico = $_POST['anio_academico'];
$semestre_academico = $_POST['semestre_academico'];
$nombre         = $_POST['nombre'];
$tipo           = $_POST['tipo'];
$observaciones  = $_POST['observaciones'];

// Manejo del archivo o URL
$url = '';
if ($tipo === 'GOOGLE_FORM') {
    $url = $_POST['url'];
} else {
    // Procesar archivo subido
    if (isset($_FILES['archivo'])) {
        $file = $_FILES['archivo'];
        
        // Validar que se haya subido un archivo
        if ($file['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../../../uploads/encuestas/';
            
            // Crear directorio si no existe
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            // Generar nombre único para el archivo
            $fileName = uniqid() . '_' . basename($file['name']);
            $targetPath = $uploadDir . $fileName;
            
            // Mover el archivo subido al directorio de destino
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                $url = '/uploads/encuestas/' . $fileName;
            } else {
                session_start();
                $_SESSION['mensaje'] = "❌ Error al subir el archivo.";
                $_SESSION['icono'] = "error";
                ?><script>window.history.back();</script><?php
                exit;
            }
        } else {
            session_start();
            $_SESSION['mensaje'] = "❌ Debes subir un archivo para este tipo de encuesta.";
            $_SESSION['icono'] = "error";
            ?><script>window.history.back();</script><?php
            exit;
        }
    }
}

// Fecha y estado
$fechaHora = date('Y-m-d H:i:s');
$estado = '1';

try {
    $sentencia = $pdo->prepare("
        INSERT INTO encuestas (
            escuela_id, 
            anio_academico,
            semestre_academico,
            nombre, 
            tipo, 
            url, 
            observaciones, 
            fyh_creacion, 
            estado
        ) VALUES (
            :escuela_id, 
            :anio_academico,
            :semestre_academico,
            :nombre, 
            :tipo, 
            :url, 
            :observaciones, 
            :fyh_creacion, 
            :estado
        )
    ");

    $sentencia->bindParam(':escuela_id', $escuela_id);
    $sentencia->bindParam(':anio_academico', $anio_academico);
    $sentencia->bindParam(':semestre_academico', $semestre_academico);
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':tipo', $tipo);
    $sentencia->bindParam(':url', $url);
    $sentencia->bindParam(':observaciones', $observaciones);
    $sentencia->bindParam(':fyh_creacion', $fechaHora);
    $sentencia->bindParam(':estado', $estado);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "✅ Encuesta registrada correctamente.";
        $_SESSION['icono'] = "success";
        header('Location: ' . APP_URL . "/admin/encuestas");
        exit;
    } else {
        throw new Exception("No se pudo ejecutar la sentencia.");
    }

} catch (PDOException $e) {
    session_start();
    $_SESSION['mensaje'] = "❌ La encuesta ya existe o ocurrió un error.";
    $_SESSION['icono'] = "error";
    ?><script>window.history.back();</script><?php
}
?>
<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');

// Obtener el ID de la encuesta desde la URL
$id_encuesta = $_GET['id'];

// Consulta para obtener los detalles de la encuesta
$sql_encuesta = "
    SELECT 
        e.id_encuestas,
        e.nombre AS nombre_encuesta,
        e.tipo,
        e.url,
        e.observaciones,
        e.fyh_creacion,
        e.estado,
        esc.nombre_escuela,
        fac.nombre_facultad
    FROM encuestas AS e
    INNER JOIN escuelas AS esc ON esc.id_escuela = e.escuela_id
    INNER JOIN facultades AS fac ON fac.id_facultad = esc.facultad_id
    WHERE e.id_encuestas = :id_encuesta
";

$query_encuesta = $pdo->prepare($sql_encuesta);
$query_encuesta->bindParam(':id_encuesta', $id_encuesta, PDO::PARAM_INT);
$query_encuesta->execute();
$encuesta = $query_encuesta->fetch(PDO::FETCH_ASSOC);

if (!$encuesta) {
    // Si no se encuentra la encuesta, redirigir
    header('Location: ' . APP_URL . "/admin/encuestas");
    exit;
}

// Determinar el tipo de visualización
$fileExtension = '';
$filePath = '';
$isGoogleForm = ($encuesta['tipo'] === 'GOOGLE_FORM');

if (!$isGoogleForm) {
    $fileExtension = strtolower(pathinfo($encuesta['url'], PATHINFO_EXTENSION));
    $filePath = APP_URL . $encuesta['url'];
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detalles de la Encuesta</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Información de la Encuesta</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Título:</strong>
                                    <p class="text-muted"><?= $encuesta['nombre_encuesta']; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Tipo:</strong>
                                    <p class="text-muted"><?= $encuesta['tipo']; ?></p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Escuela:</strong>
                                    <p class="text-muted"><?= $encuesta['nombre_escuela']; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Facultad:</strong>
                                    <p class="text-muted"><?= $encuesta['nombre_facultad']; ?></p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <strong>Observaciones:</strong>
                                    <p class="text-muted"><?= $encuesta['observaciones'] ?: 'Sin observaciones'; ?></p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Fecha de creación:</strong>
                                    <p class="text-muted"><?= $encuesta['fyh_creacion']; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Estado:</strong>
                                    <p class="text-muted">
                                        <span class="badge <?= $encuesta['estado'] == '1' ? 'bg-success' : 'bg-danger'; ?>">
                                            <?= $encuesta['estado'] == '1' ? 'Activo' : 'Inactivo'; ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Visualización</h3>
                        </div>
                        <div class="card-body text-center">
                            <?php if ($isGoogleForm): ?>
                                <a href="<?= $encuesta['url']; ?>" target="_blank" class="btn btn-primary btn-lg">
                                    <i class="fas fa-external-link-alt mr-2"></i> Abrir Google Form
                                </a>
                                <hr>
                                <small class="text-muted">Esta encuesta es un formulario externo de Google.</small>
                            <?php else: ?>
                                <?php if ($fileExtension === 'pdf'): ?>
                                    <embed src="<?= $filePath; ?>" type="application/pdf" width="100%" height="400px">
                                    <hr>
                                    <a href="<?= $filePath; ?>" download class="btn btn-primary">
                                        <i class="fas fa-download mr-2"></i> Descargar
                                    </a>
                                <?php elseif (in_array($fileExtension, ['docx', 'doc'])): ?>
                                    <div class="alert alert-info">
                                        <i class="fas fa-file-word fa-3x mb-3"></i>
                                        <p>Documento de Word</p>
                                        <a href="<?= $filePath; ?>" download class="btn btn-primary">
                                            <i class="fas fa-download mr-2"></i> Descargar Documento
                                        </a>
                                    </div>
                                <?php elseif (in_array($fileExtension, ['xlsx', 'xls'])): ?>
                                    <div class="alert alert-success">
                                        <i class="fas fa-file-excel fa-3x mb-3"></i>
                                        <p>Documento de Excel</p>
                                        <a href="<?= $filePath; ?>" download class="btn btn-primary">
                                            <i class="fas fa-download mr-2"></i> Descargar Excel
                                        </a>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning">
                                        <i class="fas fa-file fa-3x mb-3"></i>
                                        <p>Archivo no reconocido</p>
                                        <a href="<?= $filePath; ?>" download class="btn btn-primary">
                                            <i class="fas fa-download mr-2"></i> Descargar Archivo
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <a href="<?= APP_URL; ?>/admin/encuestas" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i> Volver al listado
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include('../../admin/layout/parte2.php');
include('../../layout/mensajes.php');
?>
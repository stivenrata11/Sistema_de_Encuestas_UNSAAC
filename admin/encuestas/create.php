<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/escuelas/listado_de_escuelas.php');
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Crear Encuesta</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Complete los Campos</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/encuestas/create.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombre de la escuela profesional</label>
                                            <div class="form-inline">
                                                <select name="escuela_id" class="form-control" required>
                                                    <?php foreach($escuelas as $escuela) { ?>
                                                        <option value="<?= $escuela['id_escuela']; ?>"><?= $escuela['nombre_escuela']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <a href="<?= APP_URL; ?>/admin/escuelas/create.php" style="margin-left: 5px" class="btn btn-primary">
                                                    <i class="bi bi-file-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Título de la encuesta</label>
                                            <input type="text" name="nombre" class="form-control" placeholder="Ingrese título" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tipo de encuesta</label>
                                            <select name="tipo" class="form-control" required>
                                                <option value="PDF">PDF</option>
                                                <option value="DOCX">Word (DOCX)</option>
                                                <option value="XLSX">Excel (XLSX)</option>
                                                <option value="GOOGLE_FORM">Google Forms</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Archivo de la encuesta</label>
                                            <input type="file" name="archivo" class="form-control" id="archivoInput">
                                            <small class="text-muted">Formatos permitidos: PDF, DOCX, XLSX</small>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">URL (si es Google Forms)</label>
                                            <input type="text" name="url" class="form-control" placeholder="Ingrese URL si aplica" id="urlInput">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Observaciones</label>
                                            <textarea name="observaciones" class="form-control" rows="2" placeholder="Ingrese observaciones"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                            <a href="<?= APP_URL; ?>/admin/encuestas" class="btn btn-secondary">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipoSelect = document.querySelector('select[name="tipo"]');
    const archivoInput = document.getElementById('archivoInput');
    const urlInput = document.getElementById('urlInput');
    
    tipoSelect.addEventListener('change', function() {
        if (this.value === 'GOOGLE_FORM') {
            archivoInput.disabled = true;
            archivoInput.required = false;
            urlInput.required = true;
        } else {
            archivoInput.disabled = false;
            archivoInput.required = true;
            urlInput.required = false;
        }
    });
});
</script>

<?php
include('../../admin/layout/parte2.php');
include('../../layout/mensajes.php');
?>
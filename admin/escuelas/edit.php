<?php

$id_escuela = $_GET['id'];

include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/escuelas/datos_de_las_escuelas.php');
include('../../app/controllers/facultades/listado_de_facultades.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Escuela Profesional: <?=$nombre_escuela;?></h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Complete los Campos</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/escuelas/update.php" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombre de la Facultad</label>
                                            <input type="text" name="id_escuela" value="<?=$id_escuela;?>" hidden>
                                            <div class="form-inline">
                                                <select name="facultad_id" id="" class="form-control">
                                                    <?php foreach($facultades as $facultad) { 
                                                        $nombre_facultad_tabla = $facultad['nombre_facultad'];?>
                                                        <option value="<?= $facultad['id_facultad']; ?>" <?php if($nombre_facultad==$nombre_facultad_tabla) { ?> selected="selected" <?php } ?>>
                                                            <?= $facultad['nombre_facultad']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <a href="<?= APP_URL; ?>/admin/facultades/create.php" style="margin-left: 5px" class="btn btn-primary">
                                                    <i class="bi bi-file-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombre de la escuela profesional</label>
                                            <input type="text" name="nombre_escuela" value="<?=$nombre_escuela;?>" class="form-control" placeholder="Ingrese nombre" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Código de la escuela profesional</label>
                                            <input type="text" name="codigo_escuela" value="<?=$codigo_escuela;?>" class="form-control" placeholder="Ingrese nombre" required>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                            <a href="<?= APP_URL; ?>/admin/escuelas" class="btn btn-secondary">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include('../../admin/layout/parte2.php');
include('../../layout/mensajes.php');
?>
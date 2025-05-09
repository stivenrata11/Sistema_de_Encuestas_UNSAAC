<?php
$id_usuario = $_GET['id'];

include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/usuarios/datos_del_usuario.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Usuario: <?=$nombres?></h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Información del usuario</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombre del rol</label>
                                            <div class="form-inline">
                                                <p><?=$nombre_rol;?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombre del usuario</label>
                                            <p><?=$nombres;?></p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <p><?=$email;?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="">Fecha y hora de creación</label>
                                                <p><?=$fyh_creacion;?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Estado</label>
                                                <p><?php
                                                if($estado='1'){
                                                    echo 'ACTIVO';
                                                }else{
                                                    echo 'INACTIVO';
                                                }?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <a href="<?= APP_URL; ?>/admin/usuarios" class="btn btn-secondary">Volver</a>
                                        </div>
                                    </div>
                                </div>
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
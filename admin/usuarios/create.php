<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/roles/listado_de_roles.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Nuevo usuario</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Complete los Campos</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/usuarios/create.php" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombre del rol</label>
                                            <div class="form-inline">
                                                <select name="rol_id" id="" class="form-control">
                                                    <?php foreach($roles as $role) { ?>
                                                        <option value="<?= $role['nombre_rol']; ?>"><?= $role['nombre_rol']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <a href="<?= APP_URL; ?>/admin/roles/create.php" style="margin-left: 5px" class="btn btn-primary">
                                                    <i class="bi bi-file-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombre del usuario</label>
                                            <input type="text" name="nombres" class="form-control" placeholder="Ingrese nombres" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Ingrese email" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Contraseña</label>
                                                <input type="password" name="password" class="form-control" placeholder="Ingrese contraseña" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Confirmar contraseña</label>
                                                <input type="password" name="password_repet" class="form-control" placeholder="Confirme contraseña" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Registrar</button>
                                            <a href="<?= APP_URL; ?>/admin/usuarios" class="btn btn-secondary">Cancelar</a>
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
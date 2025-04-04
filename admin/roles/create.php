<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');


?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <h1>Nuevo Rol</h1>
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
              <form action="<?=APP_URL;?>/app/controllers/roles/create.php" method="post">
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nombre del rol</label>
                        <input type="text" name="nombre_rol" class="form-control" required>
                    </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="<?=APP_URL;?>/admin/roles" class="btn btn-secondary">Cancelar</a>
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
include ('../../admin/layout/parte2.php');
include ('../../layout/mensajes.php');
?>
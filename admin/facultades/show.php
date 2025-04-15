<?php
$id_facultad = $_GET['id'];

include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/facultades/datos_de_las_facultades.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <h1>Facultad: <?=$nombre_facultad;?></h1>
        </div>
        <div class="row">
          <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">Datos registrados</h3>
              <div class="card-tools">
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nombre de la facultad</label>
                        <p><?=$nombre_facultad;?></p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Código de la facultad</label>
                        <p><?=$codigo_facultad;?></p>
                    </div>
                </div>

              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <a href="<?=APP_URL;?>/admin/facultades" class="btn btn-secondary">Volver</a>
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
include ('../../admin/layout/parte2.php');
include ('../../layout/mensajes.php');
?>
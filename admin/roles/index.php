<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/roles/listado_de_roles.php');


?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <h1>Listado de Roles</h1>
        </div>
        <div class="row">
          <div class="col-md-12">
          <div class="card card-outline card-primary">
            <div class="card-header">
              <h3 class="card-title">Roles Registrados</h3>
              <div class="card-tools">
              <a href="create.php" class="btn btn-outline-primary bg-hover-primary text-hover-white d-inline-flex align-items-center py-2 px-3">
                <span class="me-2">Crear nuevo rol</span>
                <i class="bi bi-plus-circle-fill fs-6"></i>
              </a>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-striped table-bordered table-hover table-sm">
                <thead>
                  <th><center>Nro</center></th>
                  <th><center>Nombre del Rol</center></th>
                  <th><center>Acciones</center></th>
                </thead>
                <tbody>
                  <?php
                  $contador_rol = 0;
                  foreach ($roles as $role){
                    $id_rol = $role['id_rol'];
                    $contador_rol = $contador_rol + 1;
                    ?>
                    <tr>
                      <td style="text-align: center;"><?=$contador_rol;?></td>
                      <td><?=$role['nombre_rol'];?></td>
                      <td class="text-center">
                        <div class="action-buttons d-flex gap-2 justify-content-center">
                          <!-- Botón Ver - Azul al hover -->
                          <button type="button" 
                                  class="btn btn-outline-primary bg-hover-primary text-hover-white" 
                                  data-bs-toggle="tooltip" 
                                  data-bs-placement="top" 
                                  title="Ver detalles">
                            <i class="bi bi-eye-fill"></i>
                          </button>
                          
                          <!-- Botón Editar - Verde al hover -->
                          <button type="button" 
                                  class="btn btn-outline-success bg-hover-success text-hover-white" 
                                  data-bs-toggle="tooltip" 
                                  data-bs-placement="top" 
                                  title="Editar">
                            <i class="bi bi-pencil-square"></i>
                          </button>
                          
                          <!-- Botón Eliminar - Rojo al hover -->
                          <button type="button" 
                                  class="btn btn-outline-danger bg-hover-danger text-hover-white" 
                                  data-bs-toggle="tooltip" 
                                  data-bs-placement="top" 
                                  title="Eliminar" 
                                  onclick="return confirm('¿Estás seguro?')">
                            <i class="bi bi-trash3-fill"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                  
                </tbody>
              </table>
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
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
              <table id="example1" class="table table-striped table-bordered table-hover table-sm">
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
                          <a href= "show.php?id=<?=$id_rol;?>" type="button" 
                                  class="btn btn-outline-primary bg-hover-primary text-hover-white" 
                                  data-bs-toggle="tooltip" 
                                  data-bs-placement="top" 
                                  title="Ver detalles">
                            <i class="bi bi-eye-fill"></i>
                          </a>
                          
                          <!-- Botón Editar - Verde al hover -->
                          <a href= "edit.php?id=<?=$id_rol;?>" type="button" 
                                  class="btn btn-outline-success bg-hover-success text-hover-white" 
                                  data-bs-toggle="tooltip" 
                                  data-bs-placement="top" 
                                  title="Editar">
                            <i class="bi bi-pencil-square"></i>
                          </a>
                          
                          <!-- Botón Eliminar - Rojo al hover -->
                          <form action="<?=APP_URL;?>/app/controllers/roles/delete.php" onclick="preguntar(event)" method="post" id="miFormulario<?=$id_rol;?>">
                            <input type="text" name= "id_rol" value="<?=$id_rol;?>" hidden>
                            <button type="submit" 
                                    class="btn btn-outline-danger bg-hover-danger text-hover-white" 
                                    style="border-radius: 0px 5px 5px 0px"
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Eliminar" 
                                    onclick="return confirm('¿Estás seguro?')">
                              <i class="bi bi-trash3-fill"></i>
                            </button>
                          </form>
                            <script>
                              function preguntar(event){
                                event.preventDeafault();
                                Swal.fire({
                                  title: 'Eliminar registro',
                                  text: '¿Estás seguro?',
                                  icon: 'question',
                                  showCancelButton: true,
                                  confirmButtonText: 'Eliminar',
                                  confirmButtonColor: '#a5161d',
                                  denyButtonColor: '#270a0a',
                                  denyButtonText: 'Cancelar',
                                }).then((result)=>{
                                  if (result.isConfirmed){
                                    var form = $('#miFormulario<?=$id_rol;?>');
                                    form.submit();
                                    //Swal.fire('Eliminado', 'Se elimino el registro', 'success');
                                  }
                                });
                              }
                            </script>
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

<script>
  $(function () {
    $("#example1").DataTable({
      "pageLength": 5,
      "languaje":{
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Roles",
        "infoEmpty": "Mostrando 0 a 0 de 0 Roles",
        "infoFiltered": "(Filtrado de _MAX_ total Roles)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Roles",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "No se encontraron resultados",
        "paginate": {
          "first": "Primero",
          "last": "Último",
          "next": "Siguiente",
          "previous": "Anterior",
        }
      },
      "responsive": true, "lengthChange": true, "autoWidth": false,
      buttons: [{
        extend: 'collection',
        text: 'Reportes',
        orientation: 'landscape',
        buttons: [{
          text: 'Copiar',
          extend: 'copy',
        },{
          extend: 'pdf'
        },{
          extend: 'csv'
        },{
          extend: 'excel'
        },{
          text: 'Imprimir',
          extend: 'print',
        }]
      },{
        extend: 'colvis',
        text: 'Visor de columnas',
        collectionLayout: 'fixed three-column'
      }]
    }) .buttons ().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
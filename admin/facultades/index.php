<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/facultades/listado_de_facultades.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content py-4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom-0">
              <div class="d-flex justify-content-between align-items-center">
                <h1 class="card-title mb-0 text-primary">
                  <i class="bi bi-building mr-2"></i>Listado de Facultades
                </h1>
                <a href="create.php" class="btn btn-primary btn-sm rounded-pill shadow-sm">
                  <i class="bi bi-plus-circle mr-1"></i> Agregar Facultad
                </a>
              </div>
            </div>
            
            <div class="card-body px-4">
              <div class="table-responsive">
                <table id="facultades-table" class="table table-hover table-striped">
                  <thead class="bg-light">
                    <tr>
                      <th class="text-center" style="width: 5%">#</th>
                      <th class="text-left">Nombre</th>
                      <th class="text-center">Código</th>
                      <th class="text-center">Creación</th>
                      <th class="text-center">Estado</th>
                      <th class="text-center" style="width: 15%">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $contador_facultades = 0;
                    foreach ($facultades as $facultad) {
                      $id_facultad = $facultad['id_facultad'];
                      $contador_facultades++;
                      $estado = $facultad['estado'];
                      $badge_class = ($estado == 'ACTIVO') ? 'bg-success-light text-success' : 'bg-danger-light text-danger';
                    ?>
                    <tr>
                      <td class="text-center align-middle"><?= $contador_facultades; ?></td>
                      <td class="align-middle">
                        <div class="fw-medium">
                          <i class="bi bi-building text-primary me-2"></i>
                          <?= $facultad['nombre_facultad']; ?>
                        </div>
                      </td>
                      <td class="text-center align-middle">
                        <span class="badge bg-secondary-light text-secondary rounded-pill px-3 py-1">
                          <?= $facultad['codigo_facultad']; ?>
                        </span>
                      </td>
                      <td class="text-center align-middle">
                        <small><?= $facultad['fyh_creacion']; ?></small>
                      </td>
                      <td class="text-center align-middle">
                        <span class="badge <?= $badge_class; ?> rounded-pill px-3 py-1">
                          <?= $estado; ?>
                        </span>
                      </td>
                      <td class="text-center align-middle">
                        <div class="d-flex justify-content-center gap-2">
                          <!-- Ver Detalles -->
                          <a href="show.php?id=<?= $id_facultad; ?>" 
                             class="btn btn-sm btn-outline-info rounded-circle action-btn"
                             data-bs-toggle="tooltip"
                             data-bs-placement="top"
                             title="Ver detalles">
                            <i class="bi bi-eye"></i>
                          </a>
                          
                          <!-- Editar -->
                          <a href="edit.php?id=<?= $id_facultad; ?>" 
                             class="btn btn-sm btn-outline-warning rounded-circle action-btn"
                             data-bs-toggle="tooltip"
                             data-bs-placement="top"
                             title="Editar">
                            <i class="bi bi-pencil"></i>
                          </a>
                          
                          <!-- Eliminar -->
                          <form action="<?= APP_URL; ?>/app/controllers/facultades/delete.php" 
                                method="post" 
                                class="delete-form"
                                onsubmit="return confirmDelete(event, <?= $id_facultad; ?>)">
                            <input type="hidden" name="id_facultad" value="<?= $id_facultad; ?>">
                            <button type="submit" 
                                    class="btn btn-sm btn-outline-danger rounded-circle action-btn"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Eliminar">
                              <i class="bi bi-trash"></i>
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            
            <div class="card-footer bg-white text-muted small">
              Mostrando <?= count($facultades); ?> registros
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
include ('../../admin/layout/parte2.php');
include ('../../layout/mensajes.php');
?>

<!-- DataTables Configuration -->
<script>
$(document).ready(function() {
  $('#facultades-table').DataTable({
    "dom": '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
    "language": {
      "emptyTable": "No hay facultades registradas",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ facultades",
      "infoEmpty": "Mostrando 0 registros",
      "infoFiltered": "(filtrado de _MAX_ facultades totales)",
      "lengthMenu": "Mostrar _MENU_ facultades",
      "search": "Buscar:",
      "zeroRecords": "No se encontraron coincidencias",
      "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
      }
    },
    "responsive": true,
    "autoWidth": false,
    "columnDefs": [
      { "orderable": false, "targets": [5] }
    ],
    "pageLength": 10,
    "drawCallback": function(settings) {
      $('[data-bs-toggle="tooltip"]').tooltip();
    }
  });
  
  // Custom delete confirmation
  window.confirmDelete = function(e, id) {
    e.preventDefault();
    var form = e.target;
    
    Swal.fire({
      title: '¿Eliminar facultad?',
      text: "Esta acción no se puede deshacer",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
  };
});
</script>

<style>
  .card {
    border-radius: 0.75rem;
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
  }
  
  .card-header {
    border-radius: 0.75rem 0.75rem 0 0 !important;
    padding: 1.25rem 1.5rem;
  }
  
  .action-btn {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
  }
  
  .action-btn:hover {
    transform: translateY(-2px);
  }
  
  .badge {
    font-weight: 500;
  }
  
  .bg-primary-light {
    background-color: #e3f2fd;
  }
  
  .bg-secondary-light {
    background-color: #f3f5f7;
  }
  
  .bg-success-light {
    background-color: #e8f5e9;
  }
  
  .bg-danger-light {
    background-color: #ffebee;
  }
  
  .table th {
    border-top: none;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    color: #6c757d;
  }
  
  .table td {
    vertical-align: middle;
  }
  
  .delete-form {
    display: inline;
  }
</style>
<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/escuelas/listado_de_escuelas.php');
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
                  <i class="bi bi-book mr-2"></i>Listado de Escuelas Profesionales
                </h1>
                <a href="create.php" class="btn btn-primary btn-sm rounded-pill shadow-sm">
                  <i class="bi bi-plus-circle mr-1"></i> Nueva Escuela
                </a>
              </div>
            </div>
            
            <div class="card-body px-4">
              <div class="table-responsive">
                <table id="escuelas-table" class="table table-hover table-striped">
                  <thead class="bg-light">
                    <tr>
                      <th class="text-center" style="width: 5%">#</th>
                      <th class="text-left">Escuela Profesional</th>
                      <th class="text-center">Código</th>
                      <th class="text-left">Facultad</th>
                      <th class="text-center">Creación</th>
                      <th class="text-center">Estado</th>
                      <th class="text-center" style="width: 12%">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $contador_escuelas = 0;
                    foreach ($escuelas as $escuela) {
                      $id_escuela = $escuela['id_escuela'];
                      $contador_escuelas++;
                      $estado = $escuela['estado'];
                      $badge_class = ($estado == 'ACTIVO') ? 'bg-success-light text-success' : 'bg-danger-light text-danger';
                    ?>
                    <tr>
                      <td class="text-center align-middle"><?= $contador_escuelas; ?></td>
                      <td class="align-middle">
                        <div class="fw-medium">
                          <i class="bi bi-mortarboard text-primary me-2"></i>
                          <?= $escuela['nombre_escuela']; ?>
                        </div>
                      </td>
                      <td class="text-center align-middle">
                        <span class="badge bg-secondary-light text-secondary rounded-pill px-3 py-1">
                          <?= $escuela['codigo_escuela']; ?>
                        </span>
                      </td>
                      <td class="align-middle">
                        <span class="badge bg-info-light text-info rounded-pill px-3 py-1">
                          <i class="bi bi-building me-1"></i>
                          <?= $escuela['nombre_facultad']; ?>
                        </span>
                      </td>
                      <td class="text-center align-middle">
                        <small><?= $escuela['fyh_creacion']; ?></small>
                      </td>
                      <td class="text-center align-middle">
                        <span class="badge <?= $badge_class; ?> rounded-pill px-3 py-1">
                          <?= $estado; ?>
                        </span>
                      </td>
                      <td class="text-center align-middle">
                        <div class="d-flex justify-content-center gap-2">
                          <!-- Ver Detalles -->
                          <a href="show.php?id=<?= $id_escuela; ?>" 
                             class="btn btn-sm btn-outline-info rounded-circle action-btn"
                             data-bs-toggle="tooltip"
                             data-bs-placement="top"
                             title="Ver detalles">
                            <i class="bi bi-eye"></i>
                          </a>
                          
                          <!-- Editar -->
                          <a href="edit.php?id=<?= $id_escuela; ?>" 
                             class="btn btn-sm btn-outline-warning rounded-circle action-btn"
                             data-bs-toggle="tooltip"
                             data-bs-placement="top"
                             title="Editar">
                            <i class="bi bi-pencil"></i>
                          </a>
                          
                          <!-- Eliminar -->
                          <form action="<?= APP_URL; ?>/app/controllers/escuelas/delete.php" 
                                method="post" 
                                class="delete-form"
                                onsubmit="return confirmDelete(event, <?= $id_escuela; ?>)">
                            <input type="hidden" name="id_escuela" value="<?= $id_escuela; ?>">
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
              Mostrando <?= count($escuelas); ?> registros
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
  $('#escuelas-table').DataTable({
    "dom": '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
    "language": {
      "emptyTable": "No hay escuelas profesionales registradas",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ escuelas",
      "infoEmpty": "Mostrando 0 registros",
      "infoFiltered": "(filtrado de _MAX_ escuelas totales)",
      "lengthMenu": "Mostrar _MENU_ escuelas",
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
      { "orderable": false, "targets": [6] }
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
      title: '¿Eliminar escuela?',
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
  
  .bg-info-light {
    background-color: #e1f5fe;
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
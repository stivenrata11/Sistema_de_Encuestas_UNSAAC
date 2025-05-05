<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/encuestas/listado_de_encuestas.php');
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
                  <i class="bi bi-book mr-2"></i>Listado de Encuestas
                </h1>
                <div>
                  <a href="create.php" class="btn btn-primary btn-sm rounded-pill shadow-sm">
                    <i class="bi bi-file-earmark-plus mr-1"></i> Subir Encuesta
                  </a>
                  <a href="https://docs.google.com/forms" target="_blank" class="btn btn-success btn-sm rounded-pill shadow-sm ml-2">
                    <i class="bi bi-google mr-1"></i> Crear Google Form
                  </a>
                </div>
              </div>
              
              <!-- Formulario de filtros -->
              <form method="get" action="" class="mt-3">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="anio">Año Académico</label>
                      <select name="anio" id="anio" class="form-control">
                        <option value="">Todos los años</option>
                        <?php 
                        $currentYear = date('Y');
                        for ($i = $currentYear; $i >= $currentYear - 5; $i--) { 
                          $selected = (isset($_GET['anio']) && $_GET['anio'] == $i) ? 'selected' : '';
                          echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="semestre">Semestre</label>
                      <select name="semestre" id="semestre" class="form-control">
                        <option value="">Todos los semestres</option>
                        <option value="I" <?= (isset($_GET['semestre']) && $_GET['semestre'] == 'I') ? 'selected' : '' ?>>I Semestre</option>
                        <option value="II" <?= (isset($_GET['semestre']) && $_GET['semestre'] == 'II') ? 'selected' : '' ?>>II Semestre</option>
                        <option value="Verano" <?= (isset($_GET['semestre']) && $_GET['semestre'] == 'Verano') ? 'selected' : '' ?>>Vacacional</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <?php if (isset($_GET['anio'])) : ?>
                      <a href="<?= APP_URL ?>/admin/encuestas" class="btn btn-secondary ml-2">Limpiar</a>
                    <?php endif; ?>
                  </div>
                </div>
              </form>
            </div>
            
            <div class="card-body px-4">
              <div class="table-responsive">
                <table id="encuestas-table" class="table table-hover table-striped">
                  <thead class="bg-light">
                    <tr>
                      <th class="text-center" style="width: 5%">N°</th>
                      <th class="text-left">Título</th>
                      <th class="text-center">Año</th>
                      <th class="text-center">Semestre</th>
                      <th class="text-center">Tipo</th>
                      <th class="text-left">Escuela</th>
                      <th class="text-center">Creación</th>
                      <th class="text-center">Estado</th>
                      <th class="text-center" style="width: 10%">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $contador_encuestas = 0;
                    foreach ($encuestas as $encuesta) {
                      $id_encuesta = $encuesta['id_encuestas'];
                      $contador_encuestas++;
                      $estado = $encuesta['estado'] == '1' ? 'ACTIVO' : 'INACTIVO';
                      $badge_class = ($estado == 'ACTIVO') ? 'bg-success-light text-success' : 'bg-danger-light text-danger';
                    ?>
                    <tr>
                      <td class="text-center align-middle"><?= $contador_encuestas; ?></td>
                      <td class="align-middle">
                        <div class="fw-medium">
                          <i class="bi bi-file-earmark-text text-primary me-2"></i>
                          <?= $encuesta['nombre_encuesta']; ?>
                        </div>
                      </td>
                      <td class="text-center align-middle">
                        <?= $encuesta['anio_academico']; ?>
                      </td>
                      <td class="text-center align-middle">
                        <?= $encuesta['semestre_academico']; ?>
                      </td>
                      <td class="text-center align-middle">
                        <span class="badge bg-secondary-light text-secondary rounded-pill px-3 py-1">
                          <?= $encuesta['tipo']; ?>
                        </span>
                      </td>
                      <td class="align-middle">
                        <span class="badge bg-info-light text-info rounded-pill px-3 py-1">
                          <i class="bi bi-building me-1"></i>
                          <?= $encuesta['nombre_escuela']; ?>
                        </span>
                      </td>
                      <td class="text-center align-middle">
                        <small><?= $encuesta['fyh_creacion']; ?></small>
                      </td>
                      <td class="text-center align-middle">
                        <span class="badge <?= $badge_class; ?> rounded-pill px-3 py-1">
                          <?= $estado; ?>
                        </span>
                      </td>
                      <td class="text-center align-middle">
                        <div class="d-flex justify-content-center gap-2">
                          <!-- Ver Detalles -->
                          <a href="show.php?id=<?= $id_encuesta; ?>" 
                             class="btn btn-sm btn-outline-info rounded-circle action-btn"
                             data-bs-toggle="tooltip"
                             data-bs-placement="top"
                             title="Ver detalles">
                            <i class="bi bi-eye"></i>
                          </a>
                          
                          <!-- Eliminar -->
                          <form action="<?= APP_URL; ?>/app/controllers/encuestas/delete.php" 
                                method="post" 
                                class="delete-form"
                                onsubmit="return confirmDelete(event, <?= $id_encuesta; ?>)">
                            <input type="hidden" name="id_encuesta" value="<?= $id_encuesta; ?>">
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
              Mostrando <?= count($encuestas); ?> registros
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
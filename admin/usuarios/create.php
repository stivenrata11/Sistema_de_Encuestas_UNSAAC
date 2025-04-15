<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/roles/listado_de_roles.php');
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
                  <i class="bi bi-person-plus-fill mr-2"></i>Nuevo Usuario
                </h1>
              </div>
            </div>
            
            <div class="card-body px-4">
              <form action="<?= APP_URL; ?>/app/controllers/usuarios/create.php" method="post">
                <div class="row g-3 mb-4">
                  <!-- Rol del usuario -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="rol_id" class="form-label fw-medium">
                        <i class="bi bi-person-badge me-2"></i>Rol del usuario
                      </label>
                      <div class="input-group">
                        <select name="rol_id" id="rol_id" class="form-select form-select-lg" required>
                          <?php foreach($roles as $role) { ?>
                            <option value="<?= $role['id_rol']; ?>"><?= $role['nombre_rol']; ?></option>
                          <?php } ?>
                        </select>
                        <a href="<?= APP_URL; ?>/admin/roles/create.php" class="btn btn-outline-primary" type="button">
                          <i class="bi bi-plus-lg"></i> Nuevo
                        </a>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Email -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email" class="form-label fw-medium">
                        <i class="bi bi-envelope me-2"></i>Correo electrónico
                      </label>
                      <input type="email" name="email" id="email" class="form-control form-control-lg" 
                             placeholder="usuario@dominio.com" required>
                    </div>
                  </div>
                  
                  <!-- Nombre completo -->
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nombres" class="form-label fw-medium">
                        <i class="bi bi-person-fill me-2"></i>Nombre completo
                      </label>
                      <input type="text" name="nombres" id="nombres" class="form-control form-control-lg" 
                             placeholder="Ingrese nombres y apellidos" required>
                    </div>
                  </div>
                  
                  <!-- Contraseña -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="password" class="form-label fw-medium">
                        <i class="bi bi-lock me-2"></i>Contraseña
                      </label>
                      <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control form-control-lg" 
                               placeholder="Mínimo 8 caracteres" required minlength="8">
                        <button class="btn btn-outline-secondary toggle-password" type="button">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Confirmar contraseña -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="password_repet" class="form-label fw-medium">
                        <i class="bi bi-lock-fill me-2"></i>Confirmar contraseña
                      </label>
                      <div class="input-group">
                        <input type="password" name="password_repet" id="password_repet" class="form-control form-control-lg" 
                               placeholder="Repita la contraseña" required minlength="8">
                        <button class="btn btn-outline-secondary toggle-password" type="button">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <hr class="my-4">
                
                <div class="row">
                  <div class="col-md-12">
                    <div class="d-flex justify-content-end gap-3">
                      <a href="<?= APP_URL; ?>/admin/usuarios" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-x-circle me-2"></i>Cancelar
                      </a>
                      <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-person-check me-2"></i>Registrar Usuario
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
include('../../admin/layout/parte2.php');
include('../../layout/mensajes.php');
?>

<!-- Script para mostrar/ocultar contraseña -->
<script>
  // Mostrar/ocultar contraseña
  document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function() {
      const input = this.parentNode.querySelector('input')
      const icon = this.querySelector('i')
      if (input.type === 'password') {
        input.type = 'text'
        icon.classList.remove('bi-eye')
        icon.classList.add('bi-eye-slash')
      } else {
        input.type = 'password'
        icon.classList.remove('bi-eye-slash')
        icon.classList.add('bi-eye')
      }
    })
  })
</script>

<style>
  .card {
    border-radius: 1rem;
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
  }
  
  .card-header {
    border-radius: 1rem 1rem 0 0 !important;
    padding: 1.25rem 1.5rem;
  }
  
  .form-control-lg, .form-select-lg {
    padding: 0.75rem 1.25rem;
    font-size: 1rem;
  }
  
  .btn {
    transition: all 0.2s ease;
  }
  
  .btn:hover {
    transform: translateY(-2px);
  }
  
  hr {
    opacity: 0.15;
  }
  
  .input-group-text {
    cursor: pointer;
  }
</style>
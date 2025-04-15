<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
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
                  <i class="bi bi-person-badge mr-2"></i>Nuevo Rol
                </h1>
              </div>
            </div>
            
            <div class="card-body px-4">
              <form action="<?=APP_URL;?>/app/controllers/roles/create.php" method="post" class="needs-validation" novalidate>
                <div class="row mb-4">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nombre_rol" class="form-label fw-medium">
                        <i class="bi bi-card-heading me-2"></i>Nombre del Rol
                      </label>
                      <input type="text" 
                             name="nombre_rol" 
                             id="nombre_rol" 
                             class="form-control form-control-lg rounded-pill"
                             placeholder="Ingrese el nombre del rol"
                             required>
                      <div class="invalid-feedback">
                        Por favor ingrese un nombre para el rol
                      </div>
                    </div>
                  </div>
                </div>
                
                <hr class="my-4">
                
                <div class="row">
                  <div class="col-md-12">
                    <div class="d-flex justify-content-end gap-3">
                      <a href="<?=APP_URL;?>/admin/roles" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-x-circle me-2"></i>Cancelar
                      </a>
                      <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-2"></i>Guardar Rol
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
include ('../../admin/layout/parte2.php');
include ('../../layout/mensajes.php');
?>

<!-- Validación del formulario -->
<script>
// Ejemplo de JavaScript para deshabilitar el envío de formularios si hay campos no válidos
(() => {
  'use strict'

  // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap
  const forms = document.querySelectorAll('.needs-validation')

  // Bucle sobre ellos y evitar el envío
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
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
  
  .form-control-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
  }
  
  .rounded-pill {
    border-radius: 50rem !important;
  }
  
  .btn {
    transition: all 0.2s ease;
  }
  
  .btn:hover {
    transform: translateY(-2px);
  }
  
  .invalid-feedback {
    padding-left: 1.5rem;
  }
  
  hr {
    opacity: 0.15;
  }
</style>
<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
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
                  <i class="bi bi-building me-2"></i>Nueva Facultad
                </h1>
              </div>
            </div>
            
            <div class="card-body px-4">
              <form action="<?= APP_URL; ?>/app/controllers/facultades/create.php" method="post" class="needs-validation" novalidate>
                <div class="row g-3 mb-4">
                  <!-- Nombre de la facultad -->
                  <div class="col-md-9">
                    <div class="form-group">
                      <label for="nombre_facultad" class="form-label fw-medium">
                        <i class="bi bi-building me-2"></i>Nombre de la Facultad
                      </label>
                      <input type="text" name="nombre_facultad" id="nombre_facultad" 
                             class="form-control form-control-lg" 
                             placeholder="Ingrese el nombre completo de la facultad" 
                             required>
                      <div class="invalid-feedback">
                        Por favor ingrese el nombre de la facultad
                      </div>
                    </div>
                  </div>
                  
                  <!-- Código de la facultad -->
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="codigo_facultad" class="form-label fw-medium">
                        <i class="bi bi-code-square me-2"></i>Código
                      </label>
                      <input type="text" name="codigo_facultad" id="codigo_facultad" 
                             class="form-control form-control-lg text-uppercase" 
                             placeholder="Ej: FING" 
                             required
                             maxlength="10"
                             pattern="[A-Z0-9]+"
                             title="Solo letras mayúsculas y números">
                      <div class="invalid-feedback">
                        Ingrese un código válido (solo mayúsculas y números)
                      </div>
                    </div>
                  </div>
                </div>
                
                <hr class="my-4">
                
                <div class="row">
                  <div class="col-md-12">
                    <div class="d-flex justify-content-end gap-3">
                      <a href="<?= APP_URL; ?>/admin/facultades" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-x-circle me-2"></i>Cancelar
                      </a>
                      <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-2"></i>Guardar Facultad
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

<!-- Validación del formulario -->
<script>
(() => {
  'use strict'

  // Obtener todos los formularios a los que queremos aplicar estilos de validación
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
  
  // Convertir automáticamente a mayúsculas el código
  document.getElementById('codigo_facultad').addEventListener('input', function() {
    this.value = this.value.toUpperCase();
  });
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
    padding: 0.75rem 1.25rem;
    font-size: 1rem;
  }
  
  .btn {
    transition: all 0.2s ease;
  }
  
  .btn:hover {
    transform: translateY(-2px);
  }
  
  .invalid-feedback {
    padding-left: 1rem;
  }
  
  hr {
    opacity: 0.15;
  }
  
  .text-uppercase {
    text-transform: uppercase;
  }
</style>
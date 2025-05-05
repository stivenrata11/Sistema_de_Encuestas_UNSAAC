<?php
session_start();

if(isset($_SESSION['sesion_email'])){
  //echo "el usuario paso por el login";
  $email_sesion = $_SESSION['sesion_email'];

  $query_sesion = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
  $query_sesion->execute([':email' => $email_sesion]);

  $datos_sesion_usuarios = $query_sesion->fetchAll(PDO::FETCH_ASSOC);

  foreach($datos_sesion_usuarios as $datos_sesion_usuario){
    $datos_sesion_usuario['nombres'];
  }
}else{
  echo "el usuario no paso por el login";
  header('Location: ' . APP_URL . "/login");
  exit();
}

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=NAME;?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=APP_URL;?>/public/dist/css/adminlte.min.css">
  <!-- Sweetalert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- iconos -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?=APP_URL;?>/admin" class="nav-link"><?=NAME;?></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="public/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="public/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="public/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=APP_URL;?>/admin" class="brand-link">
      <img src="https://www.unsaac.edu.pe/wp-content/uploads/2023/01/escudo-oficial-02-2-2-e1675183581418.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SGE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://img.favpng.com/14/16/25/web-development-php-software-developer-programmer-web-design-png-favpng-kPtxyC1d3pBDUYj6BthX4AFpp_t.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block"><?= isset($datos_sesion_usuarios[0]['nombres']) ? $datos_sesion_usuarios[0]['nombres'] : 'Usuario'; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->



               <li class="nav-item menu-item">
                  <a href="#" class="nav-link menu-link d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                      <i class="nav-icon bi bi-shield-lock me-3 text-primary" style="font-size: 1.1rem;"></i>
                      <span class="menu-title fw-medium">Roles</span>
                    </div>
                    <i class="bi bi-chevron-down toggle-icon transition-all"></i>
                  </a>
                  <ul class="nav nav-treeview menu-items">
                    <li class="nav-item">
                      <a href="<?=APP_URL;?>/admin/roles" class="nav-link d-flex align-items-center py-2 ps-4">
                        <i class="nav-icon bi bi-person-lock me-2 text-primary"></i>
                        <span class="menu-text">Administrar roles</span>
                      </a>
                    </li>
                  </ul>
                </li>





                <li class="nav-item menu-item">
                  <a href="#" class="nav-link menu-link d-flex align-items-center justify-content-between bg-hover-light">
                    <div class="d-flex align-items-center">
                      <i class="nav-icon bi bi-people-fill me-3 text-primary" style="font-size: 1.1rem;"></i>
                      <span class="menu-title fw-medium">Usuarios</span>
                    </div>
                    <i class="bi bi-chevron-down toggle-icon transition-all"></i>
                  </a>
                  <ul class="nav nav-treeview menu-items">
                    <li class="nav-item">
                      <a href="<?=APP_URL;?>/admin/usuarios" class="nav-link d-flex align-items-center py-2 ps-4 bg-hover-light">
                        <i class="nav-icon bi bi-person-gear me-2 text-primary"></i>
                        <span class="menu-text">Administrar Usuarios</span>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item menu-item">
                  <a href="#" class="nav-link menu-link d-flex align-items-center justify-content-between bg-hover-light">
                    <div class="d-flex align-items-center">
                      <i class="nav-icon bi bi-building me-3 text-primary" style="font-size: 1.1rem;"></i>
                      <span class="menu-title fw-medium">Facultades</span>
                    </div>
                    <i class="bi bi-chevron-down toggle-icon transition-all"></i>
                  </a>
                  <ul class="nav nav-treeview menu-items">
                    <li class="nav-item">
                      <a href="<?=APP_URL;?>/admin/facultades" class="nav-link d-flex align-items-center py-2 ps-4 bg-hover-light">
                        <i class="nav-icon bi bi-list-columns-reverse me-2 text-primary"></i>
                        <span class="menu-text">Listado de Facultades</span>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item menu-item">
                  <a href="#" class="nav-link menu-link d-flex align-items-center justify-content-between bg-hover-light">
                    <div class="d-flex align-items-center">
                      <i class="nav-icon bi bi-mortarboard-fill me-3 text-primary" style="font-size: 1.1rem;"></i>
                      <span class="menu-title fw-medium">Escuelas Profesionales</span>
                    </div>
                    <i class="bi bi-chevron-down toggle-icon transition-all"></i>
                  </a>
                  <ul class="nav nav-treeview menu-items">
                    <li class="nav-item">
                      <a href="<?=APP_URL;?>/admin/escuelas" class="nav-link d-flex align-items-center py-2 ps-4 bg-hover-light">
                        <i class="nav-icon bi bi-list-check me-2 text-primary"></i>
                        <span class="menu-text">Listado de Escuelas</span>
                      </a>
                    </li>
                  </ul>
                </li>


                <!-- ENCUESTAS -->
                <li class="nav-item menu-item">
                  <a href="#" class="nav-link menu-link d-flex align-items-center justify-content-between bg-hover-light">
                    <div class="d-flex align-items-center">
                      <i class="nav-icon bi bi-clipboard-data me-3 text-primary" style="font-size: 1.1rem;"></i>
                      <span class="menu-title fw-medium">Encuestas</span>
                    </div>
                    <i class="bi bi-chevron-down toggle-icon transition-all"></i>
                  </a>
                  <ul class="nav nav-treeview menu-items">
                    <li class="nav-item">
                      <a href="<?=APP_URL;?>/admin/encuestas" class="nav-link d-flex align-items-center py-2 ps-4 bg-hover-light">
                        <i class="nav-icon bi bi-card-checklist me-2 text-primary"></i>
                        <span class="menu-text">Listado de Encuestas</span>
                      </a>
                    </li>
                  </ul>
                </li>















          <li class="nav-item logout-item">
            <a href="<?=APP_URL;?>/login" class="nav-link d-flex align-items-center">
              <i class="nav-icon bi bi-box-arrow-right me-2"></i>
              <span class="logout-text">Cerrar sesión</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
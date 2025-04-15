<?php
include ('../app/config.php');
include ('../admin/layout/parte1.php');
include ('../app/controllers/roles/listado_de_roles.php');
include ('../app/controllers/usuarios/listado_de_usuarios.php');
include ('../app/controllers/facultades/listado_de_facultades.php');
include ('../app/controllers/escuelas/listado_de_escuelas.php');
include ('../app/controllers/encuestas/listado_de_encuestas.php');

// Datos adicionales para gráficos
$encuestas_por_tipo = [];
$usuarios_por_rol = [];
$escuelas_por_facultad = [];

// Procesar datos para gráficos
foreach ($encuestas as $encuesta) {
    $tipo = $encuesta['tipo'];
    if (!isset($encuestas_por_tipo[$tipo])) {
        $encuestas_por_tipo[$tipo] = 0;
    }
    $encuestas_por_tipo[$tipo]++;
}

foreach ($usuarios as $usuario) {
    $rol_id = $usuario['rol_id'];
    if (!isset($usuarios_por_rol[$rol_id])) {
        $usuarios_por_rol[$rol_id] = 0;
    }
    $usuarios_por_rol[$rol_id]++;
}

foreach ($escuelas as $escuela) {
    $facultad_id = $escuela['facultad_id'];
    if (!isset($escuelas_por_facultad[$facultad_id])) {
        $escuelas_por_facultad[$facultad_id] = 0;
    }
    $escuelas_por_facultad[$facultad_id]++;
}
?>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f7fa;
    }

    .dashboard-wrapper {
        padding: 30px 20px;
    }

    .dashboard-box {
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        margin-bottom: 30px;
    }

    .dashboard-box.bg-success {
        background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
    }

    .dashboard-box.bg-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .dashboard-box.bg-info {
        background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
    }

    .dashboard-box.bg-warning {
        background: linear-gradient(135deg, #f46b45 0%, #eea849 100%);
    }

    .dashboard-box:hover {
        transform: scale(1.03);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    }

    .dashboard-icon {
        font-size: 3rem;
        background-color: rgba(255, 255, 255, 0.2);
        padding: 15px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dashboard-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dashboard-box h3 {
        font-weight: 700;
        font-size: 2rem;
        margin: 0;
    }

    .dashboard-box p {
        margin: 0;
        font-size: 1rem;
        opacity: 0.9;
    }

    .small-box-footer {
        display: block;
        background-color: rgba(255, 255, 255, 0.1);
        padding: 12px;
        text-align: center;
        color: white;
        font-weight: 500;
        border-radius: 0 0 16px 16px;
        transition: background-color 0.2s ease;
        text-decoration: none;
    }

    .small-box-footer:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .dashboard-title {
        font-size: 2.2rem;
        font-weight: 600;
    }

    .dashboard-subtitle {
        color: #6c757d;
        font-size: 1.1rem;
        margin-top: -10px;
    }

    .card-spacing {
        padding-left: 15px;
        padding-right: 15px;
    }

    .chart-container {
        position: relative;
        height: 300px;
        margin-bottom: 30px;
    }

    .stats-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        padding: 20px;
        margin-bottom: 30px;
    }

    .stats-card h4 {
        font-weight: 600;
        color: #495057;
        margin-bottom: 20px;
    }

    .stats-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .stats-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .stats-label {
        font-weight: 500;
        color: #6c757d;
    }

    .stats-value {
        font-weight: 600;
        color: #495057;
    }

    .pending-tasks {
        background: #fff8e1;
        padding: 15px;
        border-radius: 10px;
        margin-top: 15px;
    }

    .pending-tasks h5 {
        color: #ff8f00;
        font-weight: 600;
    }

    .task-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .task-item i {
        margin-right: 10px;
        color: #ff8f00;
    }

    @media (max-width: 768px) {
        .dashboard-box {
            margin-bottom: 20px;
        }
        
        .chart-container {
            height: 250px;
        }
    }
</style>

<div class="content-wrapper">
    <div class="container dashboard-wrapper">
        <div class="text-center mb-5">
            <h1 class="dashboard-title"><?= NAME; ?></h1>
            <p class="dashboard-subtitle">Panel de administración - Estadísticas y Resumen</p>
        </div>

        <div class="row g-4 justify-content-center">
            <?php
                $boxes = [
                    ['label' => 'Roles Registrados', 'count' => count($roles), 'color' => 'primary', 'icon' => 'bi-shield-lock', 'url' => 'roles'],
                    ['label' => 'Usuarios Registrados', 'count' => count($usuarios), 'color' => 'success', 'icon' => 'bi-people-fill', 'url' => 'usuarios'],
                    ['label' => 'Facultades Registradas', 'count' => count($facultades), 'color' => 'info', 'icon' => 'bi-building', 'url' => 'facultades'],
                    ['label' => 'Escuelas Registradas', 'count' => count($escuelas), 'color' => 'warning', 'icon' => 'bi-mortarboard-fill', 'url' => 'escuelas'],
                    ['label' => 'Encuestas Realizadas', 'count' => count($encuestas), 'color' => 'info', 'icon' => 'bi-clipboard-data', 'url' => 'encuestas']
                ];
                foreach ($boxes as $box):
            ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 card-spacing">
                <div class="dashboard-box bg-<?= $box['color']; ?> text-white p-4">
                    <div class="dashboard-content mb-3">
                        <div>
                            <h3><?= $box['count']; ?></h3>
                            <p><?= $box['label']; ?></p>
                        </div>
                        <div class="dashboard-icon">
                            <i class="bi <?= $box['icon']; ?>"></i>
                        </div>
                    </div>
                    <a href="<?= APP_URL; ?>/admin/<?= $box['url']; ?>" class="small-box-footer">
                        Más información <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Sección de Gráficos Estadísticos -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="stats-card">
                    <h4><i class="bi bi-pie-chart-fill mr-2"></i>Distribución de Encuestas por Tipo</h4>
                    <div class="chart-container">
                        <canvas id="encuestasChart"></canvas>
                    </div>
                    <div class="stats-item">
                        <span class="stats-label">Total Encuestas:</span>
                        <span class="stats-value"><?= count($encuestas); ?></span>
                    </div>
                    <?php foreach($encuestas_por_tipo as $tipo => $cantidad): ?>
                    <div class="stats-item">
                        <span class="stats-label"><?= $tipo; ?>:</span>
                        <span class="stats-value"><?= $cantidad; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="stats-card">
                    <h4><i class="bi bi-people-fill mr-2"></i>Distribución de Usuarios por Rol</h4>
                    <div class="chart-container">
                        <canvas id="usuariosChart"></canvas>
                    </div>
                    <div class="stats-item">
                        <span class="stats-label">Total Usuarios:</span>
                        <span class="stats-value"><?= count($usuarios); ?></span>
                    </div>
                    <?php foreach($usuarios_por_rol as $rol_id => $cantidad): 
                        $rol_nombre = '';
                        foreach($roles as $rol) {
                            if($rol['id_rol'] == $rol_id) {
                                $rol_nombre = $rol['nombre_rol'];
                                break;
                            }
                        }
                    ?>
                    <div class="stats-item">
                        <span class="stats-label"><?= $rol_nombre; ?>:</span>
                        <span class="stats-value"><?= $cantidad; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Segunda fila de gráficos -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="stats-card">
                    <h4><i class="bi bi-building mr-2"></i>Escuelas por Facultad</h4>
                    <div class="chart-container">
                        <canvas id="escuelasChart"></canvas>
                    </div>
                    <div class="stats-item">
                        <span class="stats-label">Total Escuelas:</span>
                        <span class="stats-value"><?= count($escuelas); ?></span>
                    </div>
                    <?php foreach($escuelas_por_facultad as $facultad_id => $cantidad): 
                        $facultad_nombre = '';
                        foreach($facultades as $facultad) {
                            if($facultad['id_facultad'] == $facultad_id) {
                                $facultad_nombre = $facultad['nombre_facultad'];
                                break;
                            }
                        }
                    ?>
                    <div class="stats-item">
                        <span class="stats-label"><?= $facultad_nombre; ?>:</span>
                        <span class="stats-value"><?= $cantidad; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="stats-card">
                    <h4><i class="bi bi-list-check mr-2"></i>Tareas Pendientes</h4>
                    <div class="chart-container">
                        <canvas id="pendientesChart"></canvas>
                    </div>
                    
                    <div class="pending-tasks">
                        <h5><i class="bi bi-exclamation-triangle-fill"></i> Acciones Requeridas</h5>
                        <div class="task-item">
                            <i class="bi bi-check-circle"></i>
                            <span>Verificar encuestas sin asignar</span>
                        </div>
                        <div class="task-item">
                            <i class="bi bi-check-circle"></i>
                            <span>Revisar usuarios inactivos</span>
                        </div>
                        <div class="task-item">
                            <i class="bi bi-check-circle"></i>
                            <span>Actualizar información de facultades</span>
                        </div>
                        <div class="task-item">
                            <i class="bi bi-check-circle"></i>
                            <span>Generar reporte mensual</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Colores para los gráficos
    const colors = [
        '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', 
        '#e74a3b', '#6610f2', '#fd7e14', '#20c997',
        '#6f42c1', '#d63384', '#0dcaf0', '#ffc107'
    ];

    // Gráfico de Encuestas por Tipo
    const encuestasCtx = document.getElementById('encuestasChart').getContext('2d');
    const encuestasChart = new Chart(encuestasCtx, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode(array_keys($encuestas_por_tipo)); ?>,
            datasets: [{
                data: <?= json_encode(array_values($encuestas_por_tipo)); ?>,
                backgroundColor: colors.slice(0, <?= count($encuestas_por_tipo); ?>),
                hoverBackgroundColor: colors.slice(0, <?= count($encuestas_por_tipo); ?>),
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    padding: 15,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Gráfico de Usuarios por Rol
    const usuariosCtx = document.getElementById('usuariosChart').getContext('2d');
    const usuariosChart = new Chart(usuariosCtx, {
        type: 'bar',
        data: {
            labels: <?= 
                json_encode(array_map(function($rol_id) use ($roles) {
                    foreach($roles as $rol) {
                        if($rol['id_rol'] == $rol_id) {
                            return $rol['nombre_rol'];
                        }
                    }
                    return 'Rol '.$rol_id;
                }, array_keys($usuarios_por_rol))); 
            ?>,
            datasets: [{
                label: "Usuarios",
                data: <?= json_encode(array_values($usuarios_por_rol)); ?>,
                backgroundColor: colors.slice(0, <?= count($usuarios_por_rol); ?>),
                hoverBackgroundColor: colors.slice(0, <?= count($usuarios_por_rol); ?>),
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Gráfico de Escuelas por Facultad
    const escuelasCtx = document.getElementById('escuelasChart').getContext('2d');
    const escuelasChart = new Chart(escuelasCtx, {
        type: 'polarArea',
        data: {
            labels: <?= 
                json_encode(array_map(function($facultad_id) use ($facultades) {
                    foreach($facultades as $facultad) {
                        if($facultad['id_facultad'] == $facultad_id) {
                            return $facultad['nombre_facultad'];
                        }
                    }
                    return 'Facultad '.$facultad_id;
                }, array_keys($escuelas_por_facultad))); 
            ?>,
            datasets: [{
                data: <?= json_encode(array_values($escuelas_por_facultad)); ?>,
                backgroundColor: colors.slice(0, <?= count($escuelas_por_facultad); ?>),
                hoverBackgroundColor: colors.slice(0, <?= count($escuelas_por_facultad); ?>),
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                }
            }
        }
    });

    // Gráfico de Tareas Pendientes (ejemplo con datos estáticos)
    const pendientesCtx = document.getElementById('pendientesChart').getContext('2d');
    const pendientesChart = new Chart(pendientesCtx, {
        type: 'line',
        data: {
            labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            datasets: [{
                label: 'Tareas Completadas',
                data: [12, 19, 15, 20, 18, 25, 22, 30, 28, 32, 35, 40],
                fill: false,
                borderColor: '#4e73df',
                tension: 0.1
            }, {
                label: 'Tareas Pendientes',
                data: [8, 10, 12, 15, 14, 10, 12, 8, 10, 7, 5, 3],
                fill: false,
                borderColor: '#e74a3b',
                tension: 0.1
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
});
</script>

<?php
include ('../admin/layout/parte2.php');
include ('../layout/mensajes.php');
?>
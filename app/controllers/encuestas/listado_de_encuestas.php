<?php
// Consulta para obtener todas las encuestas activas junto con su información de escuela y facultad
$sql_encuestas = "
    SELECT 
        e.id_encuestas,
        e.nombre AS nombre_encuesta,
        e.anio_academico,
        e.semestre_academico,
        e.tipo,
        e.url,
        e.observaciones,
        e.fyh_creacion,
        e.estado,
        esc.id_escuela,
        esc.nombre_escuela,
        esc.codigo_escuela,
        f.id_facultad,
        f.nombre_facultad,
        f.codigo_facultad
    FROM encuestas AS e
    INNER JOIN escuelas AS esc ON e.escuela_id = esc.id_escuela
    INNER JOIN facultades AS f ON esc.facultad_id = f.id_facultad
    WHERE e.estado = '1'
";

// Filtros
$filtros = [];
if (isset($_GET['anio']) && !empty($_GET['anio'])) {
    $filtros['anio'] = $_GET['anio'];
    $sql_encuestas .= " AND e.anio_academico = :anio";
}

if (isset($_GET['semestre']) && !empty($_GET['semestre'])) {
    $filtros['semestre'] = $_GET['semestre'];
    $sql_encuestas .= " AND e.semestre_academico = :semestre";
}

$query_encuestas = $pdo->prepare($sql_encuestas);

// Bind parameters
if (isset($filtros['anio'])) {
    $query_encuestas->bindParam(':anio', $filtros['anio'], PDO::PARAM_INT);
}

if (isset($filtros['semestre'])) {
    $query_encuestas->bindParam(':semestre', $filtros['semestre'], PDO::PARAM_STR);
}

$query_encuestas->execute();
$encuestas = $query_encuestas->fetchAll(PDO::FETCH_ASSOC);
?>
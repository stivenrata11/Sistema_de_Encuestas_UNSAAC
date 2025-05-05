<?php
// Consulta detallada de una sola encuesta, con escuela relacionada
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
        esc.nombre_escuela
    FROM encuestas AS e
    INNER JOIN escuelas AS esc ON esc.id_escuela = e.escuela_id
    WHERE e.estado = '1' AND e.id_encuestas = :id_encuesta
";

$query_encuestas = $pdo->prepare($sql_encuestas);
$query_encuestas->bindParam(':id_encuesta', $id_encuesta, PDO::PARAM_INT);
$query_encuestas->execute();
$encuestas = $query_encuestas->fetchAll(PDO::FETCH_ASSOC);

foreach($encuestas as $encuesta){
    $nombre_encuesta = $encuesta['nombre_encuesta'];
    $anio_academico = $encuesta['anio_academico'];
    $semestre_academico = $encuesta['semestres_academico'];
    $tipo = $encuesta['tipo'];
    $url = $encuesta['url'];
    $observaciones = $encuesta['observaciones'];
    $nombre_escuela = $encuesta['nombre_escuela'];
    $fyh_creacion = $encuesta['fyh_creacion'];
    $estado = $encuesta['estado'];
}
?>

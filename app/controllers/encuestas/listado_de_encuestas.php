<?php
// Consulta para obtener todas las encuestas activas junto con su información de escuela y facultad
$sql_encuestas = "
    SELECT 
        e.id_encuestas,
        e.nombre AS nombre_encuesta,
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

$query_encuestas = $pdo->prepare($sql_encuestas);
$query_encuestas->execute();
$encuestas = $query_encuestas->fetchAll(PDO::FETCH_ASSOC);
?>

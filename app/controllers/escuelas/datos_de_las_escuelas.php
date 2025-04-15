<?php
$sql_escuelas= "SELECT * FROM escuelas as usu INNER JOIN facultades as facultad ON facultad.id_facultad = usu.facultad_id WHERE usu.estado = '1' and usu.id_escuela = '$id_escuela' ";
$query_escuelas= $pdo->prepare($sql_escuelas);
$query_escuelas->execute();
$escuelas = $query_escuelas->fetchAll(PDO::FETCH_ASSOC);

foreach($escuelas as $escuela){
    $nombre_escuela = $escuela['nombre_escuela'];
    $codigo_escuela = $escuela['codigo_escuela'];
    $nombre_facultad = $escuela['nombre_facultad'];
    $fyh_creacion = $escuela['fyh_creacion'];
    $estado = $escuela['estado'];
}
?>
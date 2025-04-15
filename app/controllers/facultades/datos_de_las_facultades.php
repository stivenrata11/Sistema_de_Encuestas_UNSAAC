<?php
$sql_facultades= "SELECT * FROM facultades WHERE estado = '1' and id_facultad = '$id_facultad'";
$query_facultades= $pdo->prepare($sql_facultades);
$query_facultades->execute();
$datos_facultades = $query_facultades->fetchAll(PDO::FETCH_ASSOC);

foreach($datos_facultades as $datos_facultades){
    $nombre_facultad =$datos_facultades["nombre_facultad"];
    $codigo_facultad =$datos_facultades["codigo_facultad"];
    $fyh_creacion = $datos_facultades['fyh_creacion'];
    $estado = $datos_facultades['estado'];
}
?>
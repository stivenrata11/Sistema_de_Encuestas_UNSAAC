<?php
$sql_escuelas= "SELECT * FROM escuelas as usu INNER JOIN facultades as facultad ON facultad.id_facultad = usu.facultad_id WHERE usu.estado = '1' ";
$query_escuelas= $pdo->prepare($sql_escuelas);
$query_escuelas->execute();
$escuelas = $query_escuelas->fetchAll(PDO::FETCH_ASSOC);
?>
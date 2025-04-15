<?php
$sql_facultades= "SELECT * FROM facultades WHERE estado = '1' ";
$query_facultades= $pdo->prepare($sql_facultades);
$query_facultades->execute();
$facultades = $query_facultades->fetchAll(PDO::FETCH_ASSOC);
?>
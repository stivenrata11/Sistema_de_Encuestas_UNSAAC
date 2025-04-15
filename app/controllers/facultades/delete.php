<?php
include ('../../../app/config.php');

$id_facultad = $_POST["id_facultad"];

$sql_facultades= "SELECT * FROM facultades WHERE estado = '1' and id_facultad = '$id_facultad' ";
$query_facultades= $pdo->prepare($sql_facultades);
$query_facultades->execute();
$facultades = $query_facultades->fetchAll(PDO::FETCH_ASSOC);
$contador = 0;
foreach ($facultades as $facultad) {
    $contador++;
}
if($contador>0){
    session_start();
                $_SESSION['mensaje'] = "La Facultad esta ocupada, no se puede eliminar";
                $_SESSION['icono'] = "error";
                header('Location: ' . APP_URL . "/admin/facultades");
}else{
    $sentencia = $pdo->prepare("DELETE FROM facultades WHERE id_facultad=:id_facultad");

    $sentencia->bindParam('id_facultad', $id_facultad);

   
        if($sentencia->execute()){
            session_start();
                $_SESSION['mensaje'] = "Facultad eliminada con exito";
                $_SESSION['icono'] = "success";
                header('Location: ' . APP_URL . "/admin/facultades");
        }else{
            session_start();
                $_SESSION['mensaje'] = "Error al eliminar la facultad";
                $_SESSION['icono'] = "error";
                header('Location: ' . APP_URL . "/admin/facultades");
        }
}
?>
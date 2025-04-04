<?php
if((isset($_SESSION['mensaje']) && (isset($_SESSION['icono'])))){
    $mensaje = $_SESSION['mensaje'];
    $icono = $_SESSION['icono'];
    ?>
    <script>
        Swal.fire({
            position: "top_end",
            icon: "<?=$icono;?>",
            title: "<?=$mensaje;?>",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php
    unset($_SESSION['mensaje']);
    unset($_SESSION['icono']);
}
?>
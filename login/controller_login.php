<?php
include ('../app/config.php');

$email = $_POST['email'];
$password = $_POST['password'];

$sql = 'SELECT * FROM usuarios WHERE email = :email AND estado = "1" LIMIT 1';
$query = $pdo->prepare($sql);
$query->execute([':email' => $email]);

$usuario = $query->fetch(PDO::FETCH_ASSOC);

if ($usuario) {
    // Verificar la contraseña con hash (recomendado)
    if (password_verify($password, $usuario['password'])) {
        // Autenticación exitosa
        session_start();
        $_SESSION['mensaje'] = "Bienvenido al Sistema";
        $_SESSION['icono'] = "success";
        $_SESSION['sesion_email'] = $email;
        $_SESSION['sesion_nombres'] = $usuario['nombres'];
        $_SESSION['sesion_rol'] = $usuario['rol_id'];
        header('Location: ' . APP_URL . "/admin");
        exit();
    } else {
        // Contraseña incorrecta
        header('Location: ' . APP_URL . "/login?error=password");
        exit();
    }
} else {
    // Email incorrecto o usuario inactivo
    header('Location: ' . APP_URL . "/login?error=email");
    exit();
}
?>
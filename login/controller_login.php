<?php
include ('../app/config.php');

$email = $_POST['email'];
$contraseña = $_POST['password'];

$sql = 'SELECT * FROM usuarios WHERE email = :email';
$query = $pdo->prepare($sql);
$query->execute([':email' => $email]);

$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

$contador = 0;
$password_tabla = null;

foreach ($usuarios as $usuario) {
    $password_tabla = $usuario['contraseña'];
    $contador++;
}

// Verificar si el email existe y si la contraseña es correcta
if ($contador > 0) {
    if ($contraseña === $password_tabla) {
        echo "Los datos son correctos";
        session_start();
        $_SESSION['mensaje'] = "Bienvenido al Sistema";
        $_SESSION['icono'] = "success";
        $_SESSION['sesion_email'] = $email;
        header('Location: ' . APP_URL . "/admin");
        exit();
    } else {
        // Contraseña incorrecta
        header('Location: ' . APP_URL . "/login?error=password");
        exit();
    }
} else {
    // Email incorrecto
    header('Location: ' . APP_URL . "/login?error=email");
    exit();
}
?>

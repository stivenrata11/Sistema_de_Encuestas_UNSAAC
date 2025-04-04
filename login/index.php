<?php
include ('../app/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=NAME;?></title>

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- Custom CSS -->
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: linear-gradient(to bottom, #041428, #072142);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
    }
    
    .login-box {
      width: 100%;
      max-width: 360px;
      background-color: rgba(15, 66, 107, 0.5);
      border-radius: 28px;
      padding: 40px 30px;
      box-shadow: 0 0 30px rgba(0, 186, 255, 0.15);
      border: 1px solid rgba(0, 195, 255, 0.3);
      position: relative;
      overflow: hidden;
    }
    
    .login-box::after {
      content: '';
      position: absolute;
      bottom: -15px;
      right: -15px;
      width: 100px;
      height: 200px;
      background: radial-gradient(ellipse at center, rgba(15, 51, 61, 0.4) 0%, rgba(15, 66, 107, 0) 70%);
      z-index: 0;
      border-radius: 50%;
      filter: blur(10px);
    }
    
    .camera-icon-container {
      text-align: center;
      margin-bottom: 40px;
      position: relative;
    }
    
    .camera-icon-circle {
      width: 90px;
      height: 90px;
      border: 2px solid rgba(0, 195, 255, 0.7);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto;
    }
    
    .camera-icon {
      font-size: 35px;
      color: rgba(0, 195, 255, 0.9);
    }
    
    .input-container {
      position: relative;
      margin-bottom: 15px;
    }
    
    .icon-box {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #ffffff;
      font-size: 16px;
    }
    
    .form-control {
      background-color:rgb(6, 41, 59);
      border: none;
      height: 50px;
      border-radius: 5px;
      padding-left: 45px;
      width: 100%;
      box-sizing: border-box;
      color: white;
      font-size: 15px;
    }
    
    .form-control::placeholder {
      color: #a8b5c5;
    }
    
    .login-btn {
      background-color: #0d4d81;
      border: none;
      color: white;
      height: 50px;
      border-radius: 8px;
      font-weight: 500;
      letter-spacing: 1px;
      width: 100%;
      cursor: pointer;
      font-size: 16px;
      margin-top: 30px;
      margin-bottom: 20px;
      text-transform: uppercase;
    }
    
    .login-btn:hover {
      background-color:rgb(83, 173, 241);
    }
    
    .remember-forgot {
      display: flex;
      justify-content: space-between;
      color: rgba(255, 255, 255, 0.7);
      font-size: 14px;
      margin-bottom: 10px;
      margin-top: 20px;
    }
    
    .remember-me {
      display: flex;
      align-items: center;
    }
    
    .remember-me input {
      margin-right: 8px;
    }
    
    .forgot-password {
      color: rgba(255, 255, 255, 0.7);
      text-decoration: none;
    }
    
    .forgot-password:hover {
      text-decoration: underline;
      color: rgba(0, 195, 255, 0.9);
    }
    
    .form-content {
      position: relative;
      z-index: 2;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <div class="form-content">
      <div class="camera-icon-container">
        <div class="camera-icon-circle">
          <i class="fas fa-camera camera-icon"></i>
        </div>
      </div>
      
      <form action="controller_login.php" method="post">
        <div class="input-container">
          <span class="icon-box">
            <i class="fas fa-user"></i>
          </span>
          <input type="email" name="email" class="form-control" placeholder="Email">
        </div>
        
        <div class="input-container">
          <span class="icon-box">
            <i class="fas fa-lock"></i>
          </span>
          <input type="password" name="password" class="form-control" placeholder="Contraseña">
        </div>
        <button type="submit" class="login-btn">INGRESAR</button>
      </form>
    </div>
    <?php
      // Verificar el error en la URL y mostrar el mensaje correspondiente
      if (isset($_GET['error'])) {
          if ($_GET['error'] == 'email') {
              echo '<p style="color: red; text-align: center;">¡Error! El email ingresado no está registrado.</p>';
          } elseif ($_GET['error'] == 'password') {
              echo '<p style="color: red; text-align: center;">¡Error! La contraseña es incorrecta.</p>';
          }
      }
      ?>
  </div>

  <!-- jQuery -->
  <script src="<?=APP_URL;?>/public/plugins/jquery/jquery.min.js"></script>
</body>
</html>
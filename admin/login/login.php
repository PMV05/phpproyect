<?php

  $username = (isset($username)) ? $username : "";
  $email = (isset($email)) ? $email : "";
  $password = (isset($password)) ? $password : "";
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style_log.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>


  <div class="container" id="container">

    <!-- Formulario de Registrarse -->
    <div class="form-container sign-up-container">
      <form action="." method="POST">
        <input type="hidden" name="action" value="register">
        <h1>Crear una Cuenta</h1>

        <div class="social-container">
          <a href="#" class="social"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" class="social"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="social"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>

        <span>o usa tu email para registrarte</span>

        <div class="input-container">
          <i class="fa-solid fa-user"></i>
          <input type="text" name="username" placeholder="Nombre Completo"  value="<?= $username?>"/>
          <span class='error-message'><?php echo (isset($errorMessage['username'])) ? $errorMessage['username'] : "" ?></span>
        </div>

        <div class="input-container">
          <i class="fa-solid fa-envelope"></i>
          <input type="email" name="email" placeholder="Correo Electrónico" value="<?= $email?>"/>
          <span class='error-message'><?php echo (isset($errorMessage['email'])) ? $errorMessage['email'] : "" ?></span>
        </div>

        <div class="input-container">
          <i class="fa-solid fa-lock"></i>
          <input type="password" name="password" placeholder="Contraseña" value="<?= $password?>"/>
          <span class='error-message'><?php echo (isset($errorMessage['password'])) ? $errorMessage['password'] : "" ?></span>
        </div>

        <button type="submit">Registrarse</button>
      </form>
    </div>

    <!-- Formulario de Iniciar Sesion -->
    <div class="form-container sign-in-container">

      <form action="." method="POST">
        <input type="hidden" name="action" value="login">
        <h1>Iniciar Sesión</h1>

        <div class="social-container">
          <a href="#" class="social"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" class="social"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="social"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>

        <span>o usa tu cuenta</span>

        <div class="input-container">
          <i class="fa-solid fa-user"></i>
          <input type="text" name="username" placeholder="Nombre de usuario" value="<?= $username?>"/>
          <span class='error-message'><?php echo (isset($errorMessage['usernameLog'])) ? $errorMessage['usernameLog'] : "" ?></span>
        </div>

        <div class="input-container">
          <i class="fa-solid fa-lock"></i>
          <input type="password" name="password" placeholder="Contraseña" value="<?= $password?>"/>
          <span class='error-message'><?php echo (isset($errorMessage['passwordLog'])) ? $errorMessage['passwordLog'] : "" ?></span>
        </div>

        <button type="submit">Entrar</button>
      </form>
    </div>


    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Bienvenido</h1>
          <p>Para unirte a nuestra comunidad, por favor inicia sesión con tus datos personales</p>
          <button class="ghost" id="signIn">Iniciar Sesión</button>
        </div>

        <div class="overlay-panel overlay-right">
          <h1>¡Hola!</h1>
          <p>¿Aún no tienes cuenta? Regístrate y comienza a buscar oportunidades</p>
          <button class="ghost" id="signUp">Registrarse</button>
        </div>
      </div>
    </div>

  </div>

  <script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
      container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
      container.classList.remove("right-panel-active");
    });
  </script>

</body>
</html>

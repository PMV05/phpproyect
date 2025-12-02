<?php
include("../view/header.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style_log.css">
</head>

<body>

<section class="section">
    <h1 class="title">Iniciar Sesión</h1>
    <p class="text">Accede a tu cuenta</p>

    <form action="index.php" method="POST" class="form-box">

        <input type="hidden" name="action" value="procesar_login">

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" class="btn-main">Entrar</button>

    </form>
</section>

</body>
</html>

<?php
include("../view/footer.php");
?>

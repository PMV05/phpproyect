<?php
include("../util/main.php");
include("../view/header.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cancelar Suscripción</title>
    <link rel="stylesheet" href="style_sub.css">
</head>
<body>

<section class="section">
    <h1 class="title">Cancelar Suscripción</h1>
    <p class="text">Ingresa tu correo para darte de baja de la lista.</p>

    <form action="." method="POST" class="form-box">

        <input type="hidden" name="action" value="procesar_delete">

        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo" required>

        <button type="submit" class="btn-main">
            Cancelar Suscripción
        </button>

    </form>
</section>

</body>
</html>

<?php
include("../view/footer.php");
?>

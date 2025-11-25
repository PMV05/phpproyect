<?php
    include("../util/main.php");
    include("../view/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suscripción</title>
    <link rel="stylesheet" href="style_sub.css">
</head>
<body>

<section class="section">
    <h1 class="title">Suscríbete</h1>
    <p class="text">Recibe noticias directamente a tu correo</p>

    <form action="procesar_suscripcion.php" method="POST" class="form-box">
        
        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo" required>

        <button type="submit" class="btn-main">Suscribirme</button>

    </form>
</section>

</body>
</html>

<?php
    include("../view/footer.php");
?>

<?php 
include("../util/main.php");
include("../view/header.php"); 
?>

<section class="section">
    <h1 class="title">Suscríbete</h1>
    <p class="text">Recibe noticias directamente a tu correo</p>

    <form action="." method="post" class="form-box">

        <!-- IMPORTANTE: Envía la acción correcta al index -->
        <input type="hidden" name="action" value="suscripcion_exitosa">

        <label for="correo">Correo electrónico:</label>
        <div class='sub-form'>
            <input type="email" id="correo" name="correo">
            <span><?php echo isset($error_message) ? $error_message : '' ?></span>
        </div>

        <!-- BOTÓN CON DROPDOWN -->
        <div class="dropdown-wrapper">

            <!-- BOTÓN PRINCIPAL -->
            <button type="submit" class="btn-main">
                Suscribirme
            </button>

            <!-- BOTÓN CANCELAR -->
            <a href="?action=delete_email" class="btn-cancel">
                Cancelar suscripción
            </a>

        </div>

    </form>
</section>

<?php
include("../view/footer.php");
?>

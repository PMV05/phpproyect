<?php 
include("../util/main.php");
include("../view/header.php"); 
?>

<section class="section">
    <h1 class="title">Cancelar Suscripción</h1>
    <p class="text">Ingresa tu correo para darte de baja de la lista.</p>

    <form action="." method="post" class="form-box">

        <input type="hidden" name="action" value="procesar_delete">

        <div class='sub-form'>
            <input type="email" id="correo" name="correo">
            <span><?php echo isset($error_message) ? $error_message : '' ?></span>
        </div>

        <button type="submit" class="btn-main">
            Cancelar Suscripción
        </button>

    </form>
</section>

<?php include("../view/footer.php"); ?>

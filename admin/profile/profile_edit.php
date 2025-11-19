<?php
    include("../../util/main.php");
    include("../../view/header_admin.php");
?>

<main id="profile-edit-container">
    <h1>Editar Perfil</h1>

    <!-- Formulario para editar la informacion del perfil -->
    <form action="." method="post" id="edit-profile-form">
        <div class="profile-info">
            <div>
                <label for="username">Nombre de usuario:</label>
                <input type="text" id="username" name="username">
            </div> 
            <div>
                <label for="email">Correo electrónico:</label>
                <input type="text" id="email" name="email">
            </div>
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <label for="new-password">Nueva contraseña:</label>
                <input type="password" id="new-password" name="new-password">
            </div>
            <div>
                <label for="confirm-password">Confirmar contraseña:</label>
                <input type="password" id="confirm-password" name="confirm-password">
            </div>
        </div>

        <input type="submit" value="Guardar" class="button submit-button">
    </form>
</main>

<?php include("../../view/footer.php"); ?>
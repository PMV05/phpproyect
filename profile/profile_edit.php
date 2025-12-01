<?php
    include("../util/main.php");
    include("../view/header.php");


    $id = htmlspecialchars($user->getUserID());
    $email = htmlspecialchars($user->getEmail());
?>

<main id="profile-edit-container">
    <h1>Editar Perfil</h1>

    <!-- Formulario para editar la informacion del perfil -->
    <form action="." method="post" id="edit-profile-form">
        <input type="hidden" name="action" value="edit_profile">
        <div class="profile-info">
            <div>
                <label for="username">Nombre de usuario:<b class='input-required'>*</b></label>
                <input type="text" id="username" name="username" 
                 value="<?= $id; ?>">
                <?php if(isset($errorMessage['userID'])) { ?>
                    <span class="error-message">
                        <?php echo $errorMessage['userID']; ?>
                    </span> 
                <?php }?>
            </div> 
            <div>
                <label for="email">Correo electrónico:<b class='input-required'>*</b></label>
                <input type="text" id="email" name="email" 
                 value="<?= $email; ?>">
                <?php if(isset($errorMessage['email'])) { ?>
                    <span class="error-message">
                        <?php echo $errorMessage['email']; ?>
                    </span> 
                <?php }?>
            </div>
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password"
                value="<?php echo (isset($passwords['password'])) ? $passwords['password'] : ""; ?>">
                <?php if(isset($errorMessage['password'])) { ?>
                    <span class="error-message">
                        <?php echo $errorMessage['password']; ?>
                    </span> 
                <?php }?>
            </div>
            <div>
                <label for="new-password">Nueva contraseña:</label>
                <input type="password" id="new-password" name="new-password"
                value="<?php echo (isset($passwords['newPassword'])) ? $passwords['newPassword'] : ""; ?>">
                <?php if(isset($errorMessage['newPassword'])) { ?>
                    <span class="error-message">
                        <?php echo $errorMessage['newPassword']; ?>
                    </span> 
                <?php }?>
            </div>
            <div>
                <label for="confirm-password">Confirmar contraseña:</label>
                <input type="password" id="confirm-password" name="confirm-password"
                value="<?php echo (isset($passwords['confirmPassword'])) ? $passwords['confirmPassword'] : ""; ?>">
                <?php if(isset($errorMessage['confirmPassword'])) { ?>
                    <span class="error-message">
                        <?php echo $errorMessage['confirmPassword']; ?>
                    </span> 
                <?php }?>
            </div>
        </div>

        <input type="submit" value="Guardar" class="button submit-button">
    </form>
</main>

<?php include("../view/footer.php"); ?>
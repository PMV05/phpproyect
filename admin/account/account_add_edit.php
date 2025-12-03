<?php include("../../view/header.php"); 

    // Si hay un id de una cuenta la accion que se tomara es editar
    if ($action == "edit") 
        $heading = "Editar Cuenta";
    else 
        $heading = "Añadir Cuenta";

    $userID = $user->getUserID();
    $email = htmlspecialchars($user->getEmail());
    $role = $user->getUserRole();
    $password = (isset($password)) ? $password : "";
?>

<link rel="stylesheet" href="../../style.css">

<?php
    $uid      = isset($userID) ? $userID : "";
    $emailVal = isset($email)  ? $email  : "";
    $roleVal  = isset($role)   ? $role   : "";
?>

<main>
    <h1>
        <?php echo $heading; ?>
    </h1>

    <form action="." method="post" id="add-edit-opportunity">
        <input type="hidden" name="action" value="<?php echo htmlspecialchars($action); ?>">

        <div id="opportunity-info-form">
            <div>
                <label for="userID">
                    Usuario:<b class="input-required">*</b>
                </label>
                <input type="hidden" id="currentUserID" name="currentUserID" value="<?php echo htmlspecialchars($userID); ?>">
                <input type="text" id="userID" name="userID" value="<?php echo htmlspecialchars($userID); ?>">

                <?php if (isset($errors['userID'])): ?>
                    <span class="error-message">
                        <?php echo isset($errors["userID"]) ? htmlspecialchars($errors['userID']) : "" ?>
                    </span>
                <?php endif; ?>
            </div>

            <div>
                <label for="email"> Email: <b class="input-required">*</b></label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <?php if (isset($errors['email'])): ?>
                    <span class="error-message">
                        <?php echo (isset($errors['email'])) ? htmlspecialchars($errors['email']): "" ?>
                    </span>
                <?php endif; ?>
            </div>

            <div>
                <label for="password"> Contraseña:<?php if ($action === "add") echo '<b class="input-required">*</b>'; ?></label>
                <input type="password" id="password" name="password" value="<?= htmlspecialchars($password); ?>">
                <?php if (isset($errors['password'])): ?>
                    <span class="error-message">
                        <?php echo isset($errors['password']) ? htmlspecialchars($errors['password']) : "" ?>
                    </span>
                <?php endif; ?>
            </div>

            <div>
                <label for="role"> Rol:<b class="input-required">*</b></label>
                <select id="role" name="role">
                    <option value="">-- Rol --</option>
                    <option value="1" <?php echo ($role == 1) ? 'selected' : "" ?>> Contribuidor</option>
                    <option value="2" <?php echo ($role == 2) ? 'selected' : ""  ?>> Administrador</option>
                </select>
                <?php if (isset($errors['role'])): ?>
                    <span class="error-message">
                        <?php echo (isset($errors['role'])) ? htmlspecialchars($errors['role']) : "" ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <div style="text-align:center; margin-top:20px;">
            <button type="submit" class="button submit-button"> Guardar </button>
            <a href="index.php" class="button" style="margin-left:10px;"> Cancelar </a>
        </div>
    </form>
</main>

<?php include("../../view/footer.php"); ?>

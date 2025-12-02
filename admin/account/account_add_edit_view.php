<?php include("../../view/header_admin.php"); ?>

<link rel="stylesheet" href="../../style.css">

<?php
    $uid      = isset($userID) ? $userID : "";
    $emailVal = isset($email)  ? $email  : "";
    $roleVal  = isset($role)   ? $role   : "";
?>

<main>
    <h1>
        <?php echo ($mode === "edit") ? "Editar cuenta" : "Añadir cuenta"; ?>
    </h1>

    <form action="index.php" method="post" id="add-edit-opportunity">
        <input type="hidden" name="action" value="<?php echo htmlspecialchars($mode); ?>">

        <div id="opportunity-info-form">
            <div>
                <label for="userID">
                    Usuario:<b class="input-required">*</b>
                </label>
                <input type="text" id="userID" name="userID" required value="<?php echo htmlspecialchars($uid); ?>">

                <?php if (isset($errors['userID'])): ?>
                    <span class="error-message">
                        <?php echo htmlspecialchars($errors['userID']); ?>
                    </span>
                <?php endif; ?>
            </div>

            <div>
                <label for="email"> Email: <b class="input-required">*</b></label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($emailVal); ?>">
                <?php if (isset($errors['email'])): ?>
                    <span class="error-message">
                        <?php echo htmlspecialchars($errors['email']); ?>
                    </span>
                <?php endif; ?>
            </div>

            <div>
                <label for="password"> Contraseña:<?php if ($mode === "add") echo '<b class="input-required">*</b>'; ?></label>
                <input type="password" id="password" name="password">
                <?php if ($mode === "edit"): ?>
                    <small>(Vacio mantiene el mismo)</small>
                <?php endif; ?>
                <?php if (isset($errors['password'])): ?>
                    <span class="error-message">
                        <?php echo htmlspecialchars($errors['password']); ?>
                    </span>
                <?php endif; ?>
            </div>

            <div>
                <label for="role"> Rol:<b class="input-required">*</b></label>
                <select id="role" name="role" required>
                    <option value="">-- Rol --</option>
                    <option value="1" <?php echo ($roleVal == 1 ? "selected" : ""); ?>> Contribuidor</option>
                    <option value="2" <?php echo ($roleVal == 2 ? "selected" : ""); ?>> Administrador </option>
                </select>
                <?php if (isset($errors['role'])): ?>
                    <span class="error-message">
                        <?php echo htmlspecialchars($errors['role']); ?>
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

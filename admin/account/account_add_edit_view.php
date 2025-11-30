<?php include("../../view/header_admin.php"); ?>

<link rel="stylesheet" href="../admin.css">
<link rel="stylesheet" href="../../opportunity/style_op.css">

<div class="container">

    <h1 class="titulo">
        <?php echo ($mode === "edit") ? "Editar cuenta" : "Añadir cuenta"; ?>
    </h1>

    <div class="contenido">

        <?php if (!empty($errors)): ?>
            <div style="color:red;">
                <ul>
                    <?php foreach ($errors as $e): ?>
                        <li><?php echo htmlspecialchars($e); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php
        $uid = $user ? $user->getUserID() : "";
        $email = $user ? $user->getEmail() : "";
        $role = $user ? $user->getUserRole() : "";
        ?>

        <form action="account_add_edit.php" method="post">
            <input type="hidden" name="mode" value="<?php echo $mode; ?>">

            <label>Usuario:</label><br>
            <input type="text" name="userID" required
                   value="<?php echo htmlspecialchars($uid); ?>"
                   <?php echo ($mode === "edit") ? "readonly" : ""; ?>>
            <br><br>

            <label>Email:</label><br>
            <input type="email" name="email" required
                   value="<?php echo htmlspecialchars($email); ?>">
            <br><br>

            <label>Contraseña:</label><br>
            <input type="password" name="password">
            <?php if ($mode === "edit"): ?>
                <small>(Dejar vacío para mantener la actual)</small>
            <?php endif; ?>
            <br><br>

            <label>Rol:</label><br>
            <select name="role" required>
                <option value="">-- Selecciona un rol --</option>
                <option value="1" <?php echo ($role == 1 ? "selected" : ""); ?>>
                    Contribuidor
                </option>
                <option value="2" <?php echo ($role == 2 ? "selected" : ""); ?>>
                    Administrador
                </option>
            </select>

            <br><br>

            <button class="button">Guardar</button>
            <a href="index.php" class="button button-secondary">Cancelar</a>
        </form>

    </div>
</div>

<?php include("../../view/footer.php"); ?>

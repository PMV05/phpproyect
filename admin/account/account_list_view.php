<?php include("../../view/header.php"); ?>

<link rel="stylesheet" href="../admin.css">
<link rel="stylesheet" href="../../opportunity/style_op.css">

<div class="container">

    <h1 class="titulo">Cuentas</h1>

    <div class="contenido">
        <div style="text-align:center; margin-bottom: 20px;">
           <a href="index.php?action=add_edit_account_form"><img src="<?php echo $app_path . "images/add.png"?>" class="icon_image"></a>
        </div>

        <section class="tarjetas">
            <div class="grid">

                <?php if (empty($users)): ?>
                    <p>No hay usuarios registrados.</p>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <div class="card admin-card">

                            <h2><?php echo htmlspecialchars($user->getUserID()); ?></h2>

                            <p>Email:<br> <?php echo htmlspecialchars($user->getEmail()); ?></p>

                            <p>Rol:<br> <?php echo htmlspecialchars($user->getRoleName()); ?></p>

                            <div class="card-actions">

                               <a href="index.php?action=add_edit_account_form&userID=<?php echo $user->getUserID(); ?>">
                                <img src="<?php echo $app_path . "images/edit.png"?>"  class="icon_image">
                               </a>

                                <a href="index.php?action=delete&userID=<?php echo $user->getUserID(); ?>">
                                <img src="<?php echo $app_path . "images/trash.png"?>"  class="icon_image">
                               </a>

                            </div>

                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </section>
    </div>
</div>

<?php include("../../view/footer.php"); ?>

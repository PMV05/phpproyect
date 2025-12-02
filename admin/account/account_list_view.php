<?php include("../../view/header_admin.php"); ?>

<link rel="stylesheet" href="../admin.css">
<link rel="stylesheet" href="../../opportunity/style_op.css">

<div class="container">

    <h1 class="titulo">Cuentas</h1>

    <div class="contenido">
        <div style="text-align:right; margin-bottom: 20px;">
           <a href="index.php?action=add" class="button">Añadir cuenta</a>
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

                            <p>Rol:<br> <?php echo htmlspecialchars(getRoleLabel($user)); ?></p>

                            <div class="card-actions">

                               <a href="index.php?action=edit&id=<?php echo $user->getUserID(); ?>" class="button button-small">Editar</a>

                                <form action="index.php" method="post" onsubmit="return confirm('¿Seguro que deseas eliminar esta cuenta?');">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="userID"
                                           value="<?php echo $user->getUserID(); ?>">
                                    <button type="submit"
                                            class="button button-small button-danger">Eliminar</button>
                                </form>

                            </div>

                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </section>
    </div>
</div>

<?php include("../../view/footer.php"); ?>

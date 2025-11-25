<?php
include("../../util/main.php");
include("../../view/header_admin.php");
?>

<link rel="stylesheet" href="../admin.css">
<link rel="stylesheet" href="../../opportunity/style_op.css">

<div class="container">

    <h1 class="titulo">Cuentas</h1>

    <div class="contenido">

        <section class="tarjetas">
            <div class="grid">
                <div class="card admin-card">
                    <h2>Pedro Vazquez</h2>

                    <p> Email: <br>pedro@gmail.com</p>

                    <p> Rol: <br>Contribuidor</p>

                    <div class="card-actions">
                        <a href="account_add_edit.php?action=edit&id=1" class="button button-small">Editar</a>

                        <form action="index.php" method="post" class="delete-form">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="userID" value="1">
                            <button type="submit" class="button button-small button-danger"> Eliminar</button> </form>
                    </div>
                </div>

                <div class="card admin-card">
                    <h2>Joseph Perez</h2>

                    <p> Email: <br>josepeh@gmail.com</p>

                    <p> Rol: <br>Administrador</p>

                    <div class="card-actions">
                        <a href="account_add_edit.php?action=edit&id=2" class="button button-small">
                            Editar
                        </a>

                        <form action="index.php" method="post" class="delete-form">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="userID" value="2">
                            <button type="submit" class="button button-small button-danger"> Eliminar </button>
                        </form>
                    </div>
                </div>

            </div>
        </section>

    </div>

</div>

<?php include("../../view/footer.php"); ?>

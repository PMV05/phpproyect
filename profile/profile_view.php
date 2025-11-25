<?php include("../util/main.php") ?>
<?php include("../view/header.php") ?>

<?php 

    // $opportunities = [['id'=> "1", 'title' => "Software Engineering", 'date' => "11/3/2025"],
    //                   ['id'=> "2", 'title' => "Web Developer", 'date' => "11/5/2025"],
    //                   ['id'=> "3", 'title' => "App Developer", 'date' => "11/15/2025"]];

    $account = ['username' => "jonathan.vega", 'email' => 'jonathan.vega14@upr.edu', 'password' => 'pass123', 'role' => 1];

?>

<main>
    <h1>Perfil</h1>

    <!-- Informacion del perfil -->
    <div id="profile">
        <div class="profile-info">
            <div>
                <label for="username">Nombre de usuario:</label>
                <input type="text" id="username" value=<?= $account['username']; ?> disabled>
            </div>
            <div>
                <label for="email">Correo electrónico:</label>
                <input type="text" id="email" value=<?= $account['email']; ?> disabled>
            </div>
        </div>

        <a class="button" href="./profile_edit.php">Editar</a>
    </div>

    <!-- Oportunidades añadidas por el usuario -->
    <div id="profile-opportunities">
        <h2>Mis oportunidades:</h2>

        <div id="profile-opportunities-info">
            <a href=".?action=add_edit_opportunity_form"><img src="<?php echo $app_path . "images/add.png"?>"></a>
            <!-- Iterara cada oportunidad relacionada a la cuenta del usuario -->
            <?php foreach($opportunities as $opportunity) : ?>
            <div class="profile-opportunity-card">
                <div>
                    <h3><?php echo $opportunity->getTitle(); ?></h3>
                    <span><?php echo $opportunity->getDatePosted() ?></span>
                </div>
                <!-- Botones para editar o eliminar una oportunidad -->
                <div class="opportunity-options">
                    <form action='.' method="post">
                        <input type="hidden" name="action" value="add_edit_opportunity_form">
                        <input type="hidden" name="opportunityId" value="<?= $opportunity->getId(); ?>">
                        <button type="submit" class="submit-button-img"><img src="<?php echo $app_path . "images/edit.png"?>"></button>
                    </form>
                    <form action='.' method="post">
                        <input type="hidden" name="action" value="delete_opportunity">
                        <input type="hidden" name="opportunityId" value="<?= $opportunity->getId(); ?>">
                        <button type="submit" class="submit-button-img"><img src="<?php echo $app_path . "images/trash.png"?>"></button>
                    </form>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>

</main>


<?php include("../view/footer.php") ?>

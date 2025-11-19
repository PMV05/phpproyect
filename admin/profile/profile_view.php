<?php include("../../util/main.php") ?>
<?php include("../../view/header_admin.php") ?>

<?php 

    $opportunities = [['id'=> "123", 'title' => "Software Engineering", 'date' => "11/3/2025"],
                      ['id'=> "124", 'title' => "Web Developer", 'date' => "11/5/2025"],
                      ['id'=> "126", 'title' => "App Developer", 'date' => "11/15/2025"]];

?>

<main>
    <h1>Perfil</h1>

    <!-- Informacion del perfil -->
    <div id="profile">
        <div class="profile-info">
            <div>
                <label for="username">Nombre de usuario:</label>
                <input type="text" id="username" disabled>
            </div>
            <div>
                <label for="email">Correo electrónico:</label>
                <input type="text" id="email" disabled>
            </div>
        </div>

        <a class="button" href="./profile_edit.php">Editar</a>
    </div>

    <!-- Oportunidades añadidas por el usuario -->
    <div id="profile-opportunities">
        <h2>Mis oportunidades:</h2>

        <div id="profile-opportunities-info">
            <a href="../opportunity/opportunity_add_edit.php"><img src="<?php echo $app_path . "images/add.png"?>"></a>
            <!-- Iterara cada oportunidad relacionada a la cuenta del usuario -->
            <?php foreach($opportunities as $opportunity) : ?>
            <div class="profile-opportunity-card">
                <div>
                    <h3><?php echo $opportunity['title'] ?></h3>
                    <span><?php echo $opportunity['date'] ?></span>
                </div>
                <div class="opportunity-options">
                    <a href="/"><img src="<?php echo $app_path . "images/edit.png"?>"></a>
                    <a href="/"><img src="<?php echo $app_path . "images/trash.png"?>"></a>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>

</main>


<?php include("../../view/footer.php") ?>

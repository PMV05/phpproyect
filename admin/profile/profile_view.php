<?php include("../../view/header.php"); ?>

<main>
    <h1>Perfil</h1>

    <!-- Informacion del perfil -->
    <div id="profile">
        <div class="profile-info">
            <div>
                <label for="username">Nombre de usuario:</label>
                <input type="text" id="username" value=<?= $user->getUserID(); ?> disabled>
            </div>
            <div>
                <label for="email">Correo electrónico:</label>
                <input type="text" id="email" value=<?= $user->getEmail(); ?> disabled>
            </div>
        </div>

        <a class="button" href=".?action=edit_profile_form">Editar</a>
    </div>

    <!-- Oportunidades añadidas por el usuario -->
    <div id="profile-opportunities">
        <h2>Mis oportunidades:</h2>

        <div id="profile-opportunities-info">
            <a href=".?action=add_edit_opportunity_form"><img src="<?php echo $app_path . "images/add.png"?>" class="icon_image"></a>
            <?php if(!empty($opportunities)) {?>
                <!-- Mostrará cada oportunidad relacionada a la cuenta del usuario -->
                <?php foreach($opportunities as $opportunity) : ?>
                <div class="profile-opportunity-card">
                    <div>
                        <h3><?php echo $opportunity->getTitle(); ?></h3>
                        <span><?php echo $opportunity->getDatePosted() ?></span>
                    </div>
                    <div class="opportunity-options">
                        <!-- Boton para editar la oportunidad -->
                        <a href=".?action=add_edit_opportunity_form&opportunityId=<?= $opportunity->getId();?>">
                            <img src="<?php echo $app_path . "images/edit.png"?>"  class="icon_image">
                        </a>
                        <!-- Boton para eliminar la oportunidad -->
                        <a href=".?action=delete_opportunity&opportunityId=<?= $opportunity->getId();?>">
                            <img src="<?php echo $app_path . "images/trash.png"?>"  class="icon_image">
                        </a>
                    </div>
                </div>
                <?php endforeach ?>
            <?php } else {?>
                <h2>No has publicado ninguna oportunidad</h2>
            <?php } ?>
        </div>
    </div>
</main>

<?php include("../../view/footer.php") ?>

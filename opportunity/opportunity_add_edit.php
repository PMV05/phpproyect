<?php
    include("../view/header.php");

    // Si hay un id de una oportunidad la accion que se tomara es editar
    if (isset($opportunityId)) {
        $heading = "Editar Oportunidad";
        $action = "edit_opportunity";
    }
    else {
        $heading = "Añadir Oportunidad";
        $action = "add_opportunity";
    }

    // Dependiendo de la accion, tomara los valores adecuado
    $id = $opportunity->getId();
    $title = htmlspecialchars($opportunity->getTitle());
    $sponsor = ($opportunity->getSponsor()) ? $opportunity->getSponsor() : '';
    $typeId = htmlspecialchars($opportunity->getType());
    $deadline = htmlspecialchars($opportunity->getDeadline());
    $url = htmlspecialchars($opportunity->getURL());
    $attachment = htmlspecialchars($opportunity->getAttachment());
    $description = htmlspecialchars($opportunity->getDescription());

?>

<main>
    <h1><?= $heading; ?></h1>

    <form action="." method="post" id="add-edit-opportunity" enctype="multipart/form-data">
        <input type="hidden" name="action" value="<?= $action; ?>">
        <input type="hidden" name="opportunityId" value="<?= $id; ?>">
        <input type="hidden" name="userId" value="<?= $username; ?>">
        <div id="opportunity-info-form">
            <!-- Titulo de la oportunidad -->
            <div>
                <label for="title">Título:<b class='input-required'>*</b></label>
                <input type="text" id="title" name="title"
                    value="<?= $title; ?>" >
                <?php if(isset($errorMessage['title'])) { ?>
                    <span class="error-message">
                        <?php echo $errorMessage['title']; ?>
                    </span> 
                <?php }?>
            </div>

            <!-- Patrocinador de la oportunidad -->
            <div>
                <label for="sponsor">Patrocinador:<b class='input-required'>*</b></label>
                <input type="text" id="sponsor" name="sponsor"
                    value="<?= $sponsor; ?>" >
                <?php if(isset($errorMessage['sponsor'])) { ?>
                    <span class="error-message">
                        <?php echo $errorMessage['sponsor']; ?>
                    </span> 
                <?php }?>
            </div>

            <!-- Tipo de la oportunidad -->
            <div>
                <label for="type">Tipo:<b class='input-required'>*</b></label>
                
                <select id="opportunity-type" name="type" >
                    <option value="0"></option>
                    <?php foreach($opportunities_type as $opp_type) :?>
                        <option value="<?= $opp_type['id']; ?>" 
                            <?php if ($typeId == $opp_type['id']) echo 'selected';?>>
                            <?= $opp_type['name']; ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <?php if(isset($errorMessage['type'])) { ?>
                    <span class="error-message">
                        <?php echo $errorMessage['type']; ?>
                    </span> 
                <?php }?>
            </div>

            <!-- Fecha límite de la oportunidad -->
            <div>
                <label for="deadline">Fecha límite:</label>
                <input type="date" id="deadline" name="deadline"
                    value="<?= $deadline; ?>" min="<?= date('Y-m-d'); ?>">
            </div>

            <!-- Url de la oportunidad -->
            <div>
                <label for="url">URL:</label>
                <input type="text" id="url" name="url"
                    value="<?= $url; ?>">
                <?php if(isset($errorMessage['url'])) { ?>
                    <span class="error-message">
                        <?php echo $errorMessage['url']; ?>
                    </span> 
                <?php }?>
            </div>

            <!-- Archivo adjuntado de la oportunidad -->
            <div>
                <input type="hidden" name="delete-attachment" id='delete-attachment' value="0">
                <input type="hidden" name="filename" value="<?= $attachment; ?>">

                <label for="attachment">Adjunto:</label>
                <input type="file" id="attachment" name="attachment">

                <?php if(isset($errorMessage['file'])) { ?>
                    <span class="error-message">
                        <?php echo $errorMessage['file']; ?>
                    </span> 
                <?php }?>

                <?php if(!empty($attachment)) { ?>
                    <ul class="opportunity-attachment">
                        <li><button type='button' id="attach-delete">X</button></li>
                        <li><a href="<?= File::getFile($attachment); ?>" target="_blank">
                            <?= $attachment;?>
                        </a></li>
                    </ul>
                <?php }?>
            </div>
        </div>
        
        <!-- Descripcion de la oportunidad -->
        <label for="description">Descripción:<b class='input-required'>*</b></label>
        <textarea id="description" name="description" rows="8" ><?= $description; ?></textarea>
        <?php if(isset($errorMessage['description'])) { ?>
            <span class="error-message">
                <?php echo $errorMessage['description']; ?>
            </span> 
        <?php }?>

        <div id="description-instruction">
            <label>Instrucciones para escribir en la descripción:</label>
            <ul>
                <li>Use dos saltos de línea para comenzar un nuevo párrafo.</li>
                <li>Use un asterisco para marcar elementos en una lista con "bullet".</li>
                <li>Use un salto de línea entre elementos con una lista con "bullet".</li>
                <li>Use <?php htmlspecialchars("<b></b>") ?> para poner text en negrita.</li>
                <li>Use <?php htmlspecialchars("<i></i>") ?> para poner texto en itálica.</li>
            </ul>
        </div>

        <input type="submit" value="Guardar" class="button submit-button">
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            // Cuando se oprima el boton el archivo adjuntado sera eliminado de la ventana
            document.querySelector('#attach-delete').addEventListener('click', () => {
                document.querySelector('.opportunity-attachment').style.display = "none";
                document.querySelector('#delete-attachment').value = 1;
            });
        });
    </script>
</main>

<?php include("../view/footer.php"); ?>
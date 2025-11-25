<?php
    include("../util/main.php");
    include("../view/header.php");

    // $opportunities = [1 => "Trabajo", 2 => "Intenardo", 3 => "Beca", 4 => "Proyecto de Investigación"];

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
    $type = htmlspecialchars($opportunity->getType());
    $deadline = htmlspecialchars($opportunity->getDeadline());
    $url = htmlspecialchars($opportunity->getURL());
    $attachment = htmlspecialchars($opportunity->getAttachment());
    $description = htmlspecialchars($opportunity->getDescription());

?>


<main>
    <h1><?= $heading; ?></h1>

    <form action="." method="post" id="add-edit-opportunity">
        <input type="hidden" name="action" value="<?= $action; ?>">
        <input type="hidden" name="opportunityId" value="<?= $id; ?>">
        <input type="hidden" name="userId" value="<?= $username; ?>">
        <div id="opportunity-info-form">
            <div>
                <label for="title">Título:</label>
                <input type="text" id="title" name="title"
                    value="<?= $title; ?>" required>
            </div>
            <div>
                <label for="sponsor">Patrocinador:</label>
                <input type="text" id="sponsor" name="sponsor"
                    value="<?= $sponsor; ?>" required>
            </div>
            <div>
                <label for="type">Tipo:</label>
                <select id="opportunity-type" name="type" required>
                    <?php foreach($opportunities_type as $opp_type) :?>
                        <option value="<?= $opp_type['id']; ?>" <?php if ($type == $opp_type['id']) echo 'selected';?>><?= $opp_type['name']; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div>
                <label for="deadline">Fecha límite:</label>
                <input type="date" id="deadline" name="deadline"
                    value="<?= $deadline; ?>">
            </div>
            <div>
                <label for="url">URL:</label>
                <input type="text" id="url" name="url"
                    value="<?= $url; ?>">
            </div>
            <div>
                <label for="attachment">Adjunto:</label>
                <input type="file" id="attachment" name="attachment"
                    value="<?= $attachment; ?>">
            </div>
        </div>
        
        <label for="description">Descripción:</label>
        <textarea id="description" name="description" rows="8" required><?= $description; ?></textarea>

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
</main>

<?php include("../view/footer.php"); ?>
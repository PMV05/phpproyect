<?php
    include("../util/main.php");
    include("../view/header.php");

    $opportunities = [1 => "Trabajo", 2 => "Intenardo", 3 => "Beca", 4 => "Proyecto de Investigación"];

?>

<main>
    <h1>Añadir Oportunidad</h1>

    <form action="." method="post" id="add-edit-opportunity">
        <div id="opportunity-info-form">
            <div>
                <label for="title">Título:</label>
                <input type="text" id="title" name="title">
            </div>
            <div>
                <label for="sponsor">Patrocinador:</label>
                <input type="text" id="sponsor" name="sponsor">
            </div>
            <div>
                <label for="type">Tipo:</label>
                <select id="opportunity-type">
                    <?php foreach($opportunities as $id => $opportunity) :?>
                        <option value="<?php echo $id; ?>"><?php echo $opportunity; ?></option>
                    <?php endforeach?>
                </select>
            </div>
            <div>
                <label for="deadline">Fecha límite:</label>
                <input type="date" id="deadline" name="deadline">
            </div>
            <div>
                <label for="url">URL:</label>
                <input type="text" id="url" name="url">
            </div>
            <div>
                <label for="attachment">Adjunto:</label>
                <input type="file" id="attachment" name="attachment">
            </div>
        </div>
        
        <label for="description">Descripción:</label>
        <textarea id="description" name="description" rows="8"></textarea>

        <div id="description-instruction">
            <label>Instrucciones para escribir en la descripción:</label>
            <ul>
                <li>Use dos saltos de línea para comenzar un nuevo párrafo.</li>
                <li>Use un asterisco para marcar elementos en una lista con "bullet".</li>
                <li>Use un salto de línea entre elementos con una lista con "bullet".</li>
                <li>Use [b][/b] para poner text en negrita.</li>
                <li>Use [i][/i] para poner texto en itálica.</li>
            </ul>
        </div>

        <input type="submit" value="Añadir" class="button submit-button">
    </form>
</main>

<?php include("../view/footer.php"); ?>
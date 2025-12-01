<?php
include("../../util/main.php");
include("../../view/header_admin.php");
require_once "../../model/db.php";
require_once "../../model/opportunity_db.php";

$db = Database::getDB();
$statement = $db->prepare("SELECT typeID, typeName FROM opportunities_type");
$statement->execute();
$opportunities_types = $statement->fetchAll();
$statement->closeCursor();

$ownerUserID = "admin";

$error = "";

    $title       = trim($_POST["title"] ?? "");
    $sponsor     = trim($_POST["sponsor"] ?? "");
    $type        = intval($_POST["type"] ?? 0);
    $deadline    = $_POST["deadline"] ?? null;
    $url         = trim($_POST["url"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $attachment  = null; 

    if ($title === "" || $description === "" || $type === 0) {
        $error = "Debe llenar el título, la descripción y seleccionar un tipo.";
    }
    
    else {
    $opportunity = new Opportunity(
        0,
        $title,
        $description,
        $sponsor,
        $url !== "" ? $url : "",
        $attachment !== "" ? $attachment : "",
        date("d-m-Y"),
        $deadline !== "" ? $deadline : null,
        $type,
        $ownerUserID,
        ""
    );

    OpportunityDB::addOpportunity($opportunity);

    header("Location: index.php");
    exit;
}

?>

<link rel="stylesheet" href="admin.css">
<main>
    <h1>Añadir Oportunidad</h1>

    <?php if (!empty($error)): ?>
        <p style="color:red; text-align:center;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" id="add-edit-opportunity">
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

                <select id="opportunity-type" name="type">
                    <?php foreach($opportunities_types as $t): ?>
                        <option value="<?= $t['typeID']; ?>">
                            <?= htmlspecialchars($t['typeName']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="deadline">Deadline:</label>
                <input type="date" id="deadline" name="deadline">
            </div>
            <div>
                <label for="url">URL:</label>
                <input type="text" id="url" name="url">
            </div>
            <div>
                <label for="attachment">Archivo:</label>
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
                <li>Use un salto de línea entre elementos de la lista.</li>
                <li>Use [b][/b] para texto en negrita.</li>
                <li>Use [i][/i] para texto en itálica.</li>
            </ul>
        </div>

        <input type="submit" value="Añadir" class="button submit-button">
    </form>
</main>

<?php include("../../view/footer.php"); ?>

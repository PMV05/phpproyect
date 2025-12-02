<link rel="stylesheet" href="../../style.css">

<main class="op-edit-page">
    <h1 class="op-edit-title">Añadir Oportunidad</h1>

    <?php if (!empty($error)): ?>
        <p class="form-error-global"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <div class="op-edit-card">
        <form method="post" id="add-edit-opportunity" enctype="multipart/form-data">
            <div id="opportunity-info-form">
                <div class="field-group">
                    <label for="title">Título:</label>
                    <input type="text" id="title" name="title"
                           value="<?= htmlspecialchars($title); ?>">
                </div>

                <div class="field-group">
                    <label for="sponsor">Patrocinador:</label>
                    <input type="text" id="sponsor" name="sponsor"
                           value="<?= htmlspecialchars($sponsor); ?>">
                </div>

                <div class="field-group">
                    <label for="type">Tipo:</label>
                    <select id="type" name="type">
                        <option value="0"></option>
                        <?php foreach ($opportunities_types as $opp_type): ?>
                            <option value="<?= $opp_type['typeID']; ?>"
                                <?php if ((int)$type === (int)$opp_type['typeID']) echo 'selected'; ?>>
                                <?= htmlspecialchars($opp_type['typeName']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="field-group">
                    <label for="deadline">Fecha límite:</label>
                    <input type="date" id="deadline" name="deadline"
                           value="<?= htmlspecialchars($deadline); ?>">
                </div>

                <div class="field-group">
                    <label for="url">URL:</label>
                    <input type="url" id="url" name="url"
                           value="<?= htmlspecialchars($url); ?>">
                </div>

                <div class="field-group">
                    <label for="attachment">Adjunto:</label>
                    <input type="file" id="attachment" name="attachment">
                </div>
            </div>

            <div class="field-group field-description">
                <label for="description">Descripción:</label>
                <textarea id="description" name="description" rows="8"><?= htmlspecialchars($description); ?></textarea>
            </div>

            <div class="description-help">
                <p>Instrucciones para escribir en la descripción:</p>
                <ul>
                    <li>Use dos saltos de línea para comenzar un nuevo párrafo.</li>
                    <li>Use un asterisco para marcar elementos en una lista con "bullet".</li>
                    <li>Use un salto de línea entre elementos de la lista.</li>
                    <li>Use [b][/b] para texto en negrita.</li>
                    <li>Use [i][/i] para texto en itálica.</li>
                </ul>
            </div>

            <div class="form-actions">
                <input type="submit" value="Añadir" class="button submit-button">
            </div>
        </form>
    </div>
</main>

<?php include("../../view/footer.php"); ?>

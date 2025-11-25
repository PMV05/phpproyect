<?php include("../../view/header_admin.php"); ?>

<link rel="stylesheet" href="../admin.css">
<link rel="stylesheet" href="../../opportunity/style_op.css">

<div class="container">
    <h1 class="titulo">Administrar oportunidades</h1>

    <div class="contenido">
        <section class="tarjetas">
            <div class="grid">

                <?php if (empty($opportunities)): ?>
                    <p class="empty-message">Todavía no hay oportunidades registradas.</p>
                <?php else: ?>
                    <?php foreach ($opportunities as $opp): ?>
                        <div class="card">
                            <h2><?= htmlspecialchars($opp->getTitle()); ?></h2>

                            <p>Tipo:<br><?= htmlspecialchars($opp->getTypeName()); ?></p>
                            <p>Patrocinador:<br><?= htmlspecialchars($opp->getSponsor()); ?></p>
                            <p>Fecha de publicación:<br><?= htmlspecialchars($opp->getDatePosted()); ?></p>
                            <p>Publicado por:<br><?= htmlspecialchars($opp->getAuthor()); ?></p>

                            <div class="card-actions">
                                <a href="opportunity_add_edit.php?action=edit&oppID=<?= $opp->getId(); ?>" 
                                   class="button button-small" 
                                   onclick="event.stopPropagation();">
                                   Editar
                                </a>

                                <form method="post" action="index.php" class="delete-form">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="oppID" value="<?= $opp->getId(); ?>">
                                    <button type="submit" class="button button-small button-danger" onclick="event.stopPropagation();">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </section>
    </div>
</div>

<div class="overlay" id="overlay"></div>
<div class="card-expandida" id="cardExpandida">
    <div class="cerrar-card" id="cerrarCard">×</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".card");
    const overlay = document.getElementById("overlay");
    const modal = document.getElementById("cardExpandida");

    function cerrar() {
        modal.style.display = "none";
        overlay.style.display = "none";
    }

    cards.forEach(card => {
        card.addEventListener("click", () => {
            modal.innerHTML = `
                <div class="cerrar-card" id="cerrarCard">×</div>
                ${card.innerHTML}
            `;
            modal.style.display = "block";
            overlay.style.display = "block";

            document.getElementById("cerrarCard").addEventListener("click", cerrar);
        });
    });

    overlay.addEventListener("click", cerrar);
});
</script>

<?php include("../../view/footer.php"); ?>

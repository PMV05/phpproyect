<?php
include("../../view/header_admin.php");
?>

<link rel="stylesheet" href="../../opportunity/style_op.css">
<link rel="stylesheet" href="../admin.css">

<div class="container">

    <h1 class="titulo">Oportunidades</h1>
    <div class="busqueda-container">
        <input type="text" id="search-input" placeholder="Buscar oportunidades...">
        <button id="search-btn">Buscar</button>
    </div>

    <div class="contenido">
        <aside class="filtros">
            <h2>Filtros:</h2>

            <h3>Tipo de Oportunidad:</h3>
            <label><input type="checkbox" id="jobs" value="1"> Empleos</label>
            <label><input type="checkbox" id="internship" value="2"> Internados</label>
            <label><input type="checkbox" id="fellowships" value="3"> Becas</label>
            <label><input type="checkbox" id="project" value="4"> Proyectos de Investigación</label>

            <h3>Ordenar:</h3>
            <label><input type="radio" name="orden" id="recent"> Más recientes</label>
            <label><input type="radio" name="orden" id="old"> Más antiguos</label>

            <div>
                <button class="guardar" id="save-filter">Guardar</button>
                <button class="guardar" id="clean-filter">Limpiar</button>
            </div>
        </aside>

        <div class="linea-vertical"></div>

        <section class="tarjetas">
            <div class="add-container">
                <a href="index.php?action=add" class="btn-add" title="Añadir oportunidad">+</a>
            </div>

            <?php if (empty($opportunities)): ?>
                <p class="empty-message">Todavía no hay oportunidades registradas.</p>
            <?php else: ?>

                <div class="grid">
                    <?php foreach ($opportunities as $opp): ?>
                        <div class="card">
                            <h2><?php echo htmlspecialchars($opp->getTitle()); ?></h2>

                            <p><strong>Publicado por:</strong> <?php echo htmlspecialchars($opp->getAuthor()); ?></p>
                            <p><strong>Patrocinador:</strong> <?php echo htmlspecialchars($opp->getSponsor()); ?></p>
                            <p><strong>Tipo:</strong> <?php echo htmlspecialchars($opp->getTypeName()); ?></p>
                            <p><strong>Fecha de publicación:</strong> <?php echo htmlspecialchars($opp->getDatePosted()); ?></p>

                            <div class="card-actions">
                                <a href="index.php?action=edit&id=<?php echo $opp->getId(); ?>"
                                   class="btn-icon editar"
                                   title="Editar">
                                    Edit
                                </a>

                                <form method="post"
                                      action="index.php"
                                      class="delete-form"
                                      onsubmit="return confirm('¿Eliminar esta oportunidad?');">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="opportunityID" value="<?php echo $opp->getId(); ?>">
                                    <button type="submit" class="btn-icon eliminar" title="Eliminar">Delete</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php endif; ?>

        </section>
    </div>
</div>

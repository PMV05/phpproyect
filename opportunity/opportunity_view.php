<?php include("../view/header.php"); ?>

<link rel="stylesheet" href="style_op.css">

<div class="container">

    <h1 class="titulo">Oportunidades</h1>

    <!-- Barra de búsqueda -->
    <div class="busqueda-container">
        <input type="text" id="search-input" placeholder="Buscar oportunidades...">
        <button id="search-btn">Buscar</button>
    </div>

    <div class="contenido">

        <!-- FILTROS -->
        <aside class="filtros">
            <h2>Filtros:</h2>
            <h3>Tipo de Oportunidad:</h3>
            <label><input type="checkbox" id="jobs" value="1"> Empleos</label>
            <label><input type="checkbox" id="internship" value="2"> Internados</label>
            <label><input type="checkbox" id="fellowships" value="3"> Becas</label>
            <label><input type="checkbox" id="project" value="4"> Proyectos de Investigación</label>

            <h3>Ordenar:</h3>
            <label><input type="radio" name="orden" id='recent'> Más recientes</label>
            <label><input type="radio" name="orden" id="old"> Más antiguos</label>

            <div>
                <button class="guardar" id="save-filter">Guardar</button>
                <button class="guardar" id="clean-filter">Limpiar</button>
            </div>
        </aside>

        <div class="linea-vertical"></div>

        <!-- Tarjetas de todas las oportunidades disponibles -->
        <?php if(!empty($opportunities)) {?>
            <section class="tarjetas">
                <div class="grid">
                    <?php foreach($opportunities as $opportunity) :?>
                        <div class="card"
                            data-title="<?= htmlentities($opportunity->getTitle()); ?>"
                            data-type="<?= htmlentities($opportunity->getType()); ?>"
                            data-type_name="<?= htmlentities($opportunity->getTypeName()); ?>"
                            data-sponsor="<?= htmlentities($opportunity->getSponsor()); ?>"
                            data-date_posted="<?= htmlentities($opportunity->getDatePosted()); ?>"
                            data-date_posted_format="<?= htmlentities($opportunity->getDatePostedFormat()); ?>"
                            data-deadline="<?= htmlentities($opportunity->getDeadlineFormat()); ?>"
                            data-author="<?= htmlentities($opportunity->getAuthor()); ?>"
                            data-url="<?= $opportunity->getURL(); ?>"
                            data-file_name="<?= $opportunity->getAttachment(); ?>"
                            data-attachment="<?= File::getFile($opportunity->getAttachment()); ?>"
                            data-description="<?= text\addTags($opportunity->getDescription()); ?>">

                            <h3><?= $opportunity->getTitle() ?></h3>
                            <p><strong>Tipo:</strong><br><?= htmlentities($opportunity->getTypeName()); ?></p>
                            <p><strong>Patrocinador:</strong><br><?= htmlentities($opportunity->getSponsor()); ?></p>
                            <p><strong>Fecha de publicación:</strong><br><?= htmlentities($opportunity->getDatePostedFormat()); ?></p>
                            <p><strong>Publicado por:</strong><br><?= htmlentities($opportunity->getAuthor()); ?></p>
                        </div>
                    <?php endforeach ?>
                </div>
            </section>
        <?php } else { ?>
            <h2>No hay oportunidades disponibles</h2>
        <?php } ?>


    </div>
</div>

<div class="overlay" id="overlay"></div>

<div class="card-expandida" id="cardExpandida">
    <div class="cerrar-card" id="cerrarCard">×</div>
    <div class="open-card">
        <h3 id='opp-title'></h3>
        <div id='opp-info'>
            <div id='left-info'>
                <div>
                    <p><strong>Tipo:</strong></p>
                    <span id='opp-type'></span>
                 </div>
                <div>
                    <p><strong>Patrocinador:</strong></p>
                    <span id='opp-sponsor'></span>
                 </div>
                <div>
                    <p><strong>Fecha de publicación:</strong></p>
                    <span id='opp-date-posted-format'></span>
                 </div>
                <div>
                    <p><strong>Fecha límite:</strong></p>
                    <span id='opp-deadline'></span>
                 </div>
            </div>
            <div id='right-info'>
                <div>
                    <p><strong>Publicado por:</strong></p>
                    <span id='opp-author'></span>
                 </div>
                <div>
                    <p><strong>URL:</strong></p>
                    <a href="" id='opp-url'  target="_blank"></a>
                 </div>
                <div>
                    <p><strong>Adjunto:</strong></p>
                    <a href="" id='opp-attachment'  target="_blank"></a>
                 </div>
            </div>
        </div>
        <div id="description">
            <p><strong>Descripción:</strong></p>
            <p id="opp-description"></p>
        </div>
    </div>
</div>

<script src="script.js"></script>

<?php
    include("../view/footer.php");
?>
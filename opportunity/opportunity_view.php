<?php include("../view/header.php"); ?>

<link rel="stylesheet" href="style_op.css">

<div class="container">

    <h1 class="titulo">Oportunidades</h1>

    <!-- Barra de búsqueda -->
    <div class="busqueda-container">
        <input type="text" placeholder="Buscar oportunidades...">
        <button>Buscar</button>
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

            <div><button class="guardar" id="save-filter">Guardar</button></div>
        </aside>

        <div class="linea-vertical"></div>

        <!-- Tarjetas de todas las oportunidades disponibles -->
        <section class="tarjetas">
            <div class="grid">
                 <?php foreach($opportunities as $opportunity) :?>
                    <div class="card"
                        data-title="<?= htmlentities($opportunity->getTitle()); ?>"
                        data-type="<?= htmlentities($opportunity->getType()); ?>"
                        data-typeName="<?= htmlentities($opportunity->getTypeName()); ?>"
                        data-sponsor="<?= htmlentities($opportunity->getSponsor()); ?>"
                        data-datePosted="<?= htmlentities($opportunity->getDatePosted()); ?>"
                        data-datePostedFormat="<?= htmlentities($opportunity->getDatePostedFormat()); ?>"
                        data-deadline="<?= htmlentities($opportunity->getDeadlineFormat()); ?>"
                        data-author="<?= htmlentities($opportunity->getAuthor()); ?>"
                        data-url="<?= $opportunity->getURL(); ?>"
                        data-fileName="<?= $opportunity->getAttachment(); ?>"
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

<script>
    const getElement = selector => document.querySelector(selector);


    // Evento que abrira un popup al seleccionar un card de una oportunidad
    document.addEventListener("DOMContentLoaded", () => {
        const cards = document.querySelectorAll(".card");
        const overlay = getElement("#overlay");
        const modal = getElement("#cardExpandida");

        const cerrar = () => {
            modal.style.display = "none";
            overlay.style.display = "none";
        }

        cards.forEach(card => {
            card.addEventListener("click", () => {
                // Se obtienen los datos del card
                const title = card.dataset.title;
                const typeName = card.dataset.typeName;
                const sponsor = card.dataset.sponsor;
                const datePostedFormat = card.dataset.datePostedFormat;
                const deadline = card.dataset.deadline;
                const author = card.dataset.author;
                const url = card.dataset.url;
                const attachment = card.dataset.attachment;
                const fileName = card.dataset.fileName;
                const description = card.dataset.description;

                // Se colocan los datos en el popup
                getElement("#opp-title").textContent = title;
                getElement("#opp-type").textContent = typeName;
                getElement("#opp-sponsor").textContent = sponsor;
                getElement("#opp-date-posted-format").textContent = datePostedFormat;
                getElement("#opp-deadline").textContent = deadline;
                getElement("#opp-author").textContent = author;
                getElement("#opp-url").textContent = url;
                getElement("#opp-url").href = url;
                getElement("#opp-attachment").textContent = fileName;
                getElement("#opp-attachment").href = attachment;
                getElement("#opp-description").innerHTML = description;

                // Muestra el popup
                modal.style.display = "block";
                overlay.style.display = "block";
            });
        });

        getElement("#cerrarCard").addEventListener("click", cerrar);
        overlay.addEventListener("click", cerrar);

        // Funcion para verificar si hay un filtro activo
        const typeActiveFilter = (card) => {
            const jobs = getElement("#jobs");
            const internship = getElement("#internship");
            const fellowships = getElement("#fellowships");
            const project = getElement("#project");
            const type = card.dataset.type;

            if(jobs.checked && type == jobs.value)
                return true;

            if(internship.checked && type == internship.value)
                return true;

            if(fellowships.checked && type == fellowships.value)
                return true;

            if(project.checked && type == project.value)
                return true;

            return false;
        }

        const filterActive = () => {
            const jobs = getElement("#jobs");
            const internship = getElement("#internship");
            const fellowships = getElement("#fellowships");
            const project = getElement("#project");
            const recent = getElement("#recent");
            const old = getElement("#old");

            if(jobs.checked)
                return true;

            if(internship.checked)
                return true;

            if(fellowships.checked)
                return true;

            if(project.checked)
                return true;

            if(recent.checked)
                return true;

            if(old.checked)
                return true;

            return false;
        }

        const orderFilterActive = () => {
            const recent = getElement("#recent");
            const old = getElement("#old");

            if(recent.checked)
                return true;

            if(old.checked)
                return true;

            return false;
        }

        // Funcion que ordenara los cards, y lo devolvera ordenado
        const sortDate = (array) =>{
            //Ordenara de la fecha mas nueva a la mas nueva
            if(getElement("#recent").checked){
                return array.sort((a, b) => {
                    console.log(b.type);
                    return new Date(b.datePosted) - new Date(a.datePosted);
                })
            }
            //Ordenara de la fecha mas vieja a la mas nueva
            else if (getElement("#old").checked){
                return array.sort((a, b) => {
                    return new Date(b.datePosted) - new Date(a.datePosted);
                })
            }
        }

        getElement("#save-filter").addEventListener("click", () => {
            // Hay un filtro activado
            if(filterActive){  
                const cardsFilters = Array.from(cards).filter(card => typeActiveFilter(card));
                let newCards = null;

                if(getElement("#recent").checked){
                    Array.from(cards).sort((a, b) => {
                        console.log(b.type);
                        return new Date(b.datePosted) - new Date(a.datePosted);
                    });
                }
                //Ordenara de la fecha mas vieja a la mas nueva
                else if (getElement("#old").checked){
                    Array.from(cards).sort((a, b) => {
                        return new Date(b.datePosted) - new Date(a.datePosted);
                    });
                }
            }
            else {
                Array.from(cards).forEach(card => {
                    card.style.display = 'block';
                });
            }

        });

    });

</script>

<?php
    include("../view/footer.php");
?>
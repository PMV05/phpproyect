<!-- Pagina principal del visitante y del contribuyente -->

<!-- Imagen de bienvenida -->
<div id="home-view">
    <h1>Únete a nuestra comunidad y recibe lo último.</h1>
    <a class="button" id="home-button" href="<?php echo $app_path . "suscribe/"?>">Suscribirme</a>
</div>

<!-- Se muestra la describcion de cada una de las oportunidades que estaran disponibles -->
<main>
    <h2>Oportunidades</h2>

    <div id="opportunities-info">
        <a href="<?php echo $app_path . "opportunity/"?>">
            <div class="opportunity-info-card">
                <h3>Empleos</h3>
                <p>
                    Oportunidades de trabajo remunerado en empresas u organizaciones, 
                    donde los profesionales contribuyen con sus habilidades a proyectos 
                    y tareas específicas. Los empleos pueden ser a tiempo completo, 
                    parcial o por contrato, y permiten adquirir experiencia práctica 
                    mientras se obtiene estabilidad económica.
                </p>
            </div>
        </a>

        <a href="<?php echo $app_path . "opportunity/"?>">
            <div class="opportunity-info-card">
                <h3>Internados</h3>
                <p>
                    Programas temporales diseñados para estudiantes o recién graduados, 
                    enfocados en adquirir experiencia profesional en un entorno real 
                    de trabajo. Las pasantías permiten desarrollar habilidades, aprender 
                    sobre la industria y construir una red de contactos, y pueden ser 
                    remuneradas o no.
                </p>
            </div>
        </a>

        <a href="<?php echo $app_path . "opportunity/"?>">
            <div class="opportunity-info-card">
                <h3>Becas</h3>
                <p>
                    Programas que brindan apoyo financiero y recursos para que profesionales 
                    o académicos se dediquen a investigación, desarrollo profesional o 
                    estudios avanzados. Los fellows reciben mentoría y acceso a proyectos 
                    de prestigio, con el objetivo de profundizar conocimientos y generar 
                    un impacto significativo en su campo.
                </p>
            </div>
        </a>

        <a href="<?php echo $app_path . "opportunity/"?>">
            <div class="opportunity-info-card">
                <h3>Proyectos de Investigación</h3>
                <p>
                    Iniciativas planificadas para generar conocimiento nuevo o resolver 
                    problemas específicos mediante investigación sistemática. Los proyectos 
                    de investigación pueden ser académicos, universitarios o institucionales, 
                    y suelen involucrar recopilación de datos, análisis y documentación de resultados.
                </p>
            </div>
        </a>
    </div>
</main>
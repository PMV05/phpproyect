<?php
    include("../util/main.php");
    include("../view/header.php");
?>

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

    
            <label><input type="checkbox"> Trabajos</label>
            <label><input type="checkbox"> Internados</label>
            <label><input type="checkbox"> Becas</label>
            <label><input type="checkbox"> Proyectos de Investigación</label>

            <h3>Ordenar:</h3>
            <label><input type="radio" name="orden"> Más recientes</label>
            <label><input type="radio" name="orden"> Más antiguos</label>

            <button class="guardar">Guardar</button>
        </aside>

        
        <div class="linea-vertical"></div>

        <!-- TARJETAS -->
        <section class="tarjetas">

            <div class="grid">
                <!-- CORRECCIÓN: Solo un div.grid principal, no anidados -->
                <div class="card">
                    <h2>Nombre</h2>
                    <p><strong>Tipo:</strong><br>Trabajo</p>
                    <p><strong>Patrocinador:</strong><br>INVID</p>
                    <p><strong>Fecha de publicación:</strong><br>11/3/2025</p>
                    <p><strong>Publicado por:</strong><br>Jonathan Vega</p>
                </div>

                <div class="card">
                    <h2>Nombre</h2>
                    <p><strong>Tipo:</strong><br>Trabajo</p>
                    <p><strong>Patrocinador:</strong><br>INVID</p>
                    <p><strong>Fecha de publicación:</strong><br>11/3/2025</p>
                    <p><strong>Publicado por:</strong><br>Jonathan Vega</p>
                </div>

                <div class="card">
                    <h2>Nombre</h2>
                    <p><strong>Tipo:</strong><br>Trabajo</p>
                    <p><strong>Patrocinador:</strong><br>INVID</p>
                    <p><strong>Fecha de publicación:</strong><br>11/3/2025</p>
                    <p><strong>Publicado por:</strong><br>Jonathan Vega</p>
                </div>

                <div class="card">
                    <h2>Nombre</h2>
                    <p><strong>Tipo:</strong><br>Trabajo</p>
                    <p><strong>Patrocinador:</strong><br>INVID</p>
                    <p><strong>Fecha de publicación:</strong><br>11/3/2025</p>
                    <p><strong>Publicado por:</strong><br>Jonathan Vega</p>
                </div>

                <div class="card">
                    <h2>Nombre</h2>
                    <p><strong>Tipo:</strong><br>Trabajo</p>
                    <p><strong>Patrocinador:</strong><br>INVID</p>
                    <p><strong>Fecha de publicación:</strong><br>11/3/2025</p>
                    <p><strong>Publicado por:</strong><br>Jonathan Vega</p>
                </div>

                <div class="card">
                    <h2>Nombre</h2>
                    <p><strong>Tipo:</strong><br>Trabajo</p>
                    <p><strong>Patrocinador:</strong><br>INVID</p>
                    <p><strong>Fecha de publicación:</strong><br>11/3/2025</p>
                    <p><strong>Publicado por:</strong><br>Jonathan Vega</p>
                </div>

                <div class="card">
                    <h2>Nombre</h2>
                    <p><strong>Tipo:</strong><br>Trabajo</p>
                    <p><strong>Patrocinador:</strong><br>INVID</p>
                    <p><strong>Fecha de publicación:</strong><br>11/3/2025</p>
                    <p><strong>Publicado por:</strong><br>Jonathan Vega</p>
                </div>

                <div class="card">
                    <h2>Nombre</h2>
                    <p><strong>Tipo:</strong><br>Trabajo</p>
                    <p><strong>Patrocinador:</strong><br>INVID</p>
                    <p><strong>Fecha de publicación:</strong><br>11/3/2025</p>
                    <p><strong>Publicado por:</strong><br>Jonathan Vega</p>
                </div>

                <div class="card">
                    <h2>Nombre</h2>
                    <p><strong>Tipo:</strong><br>Trabajo</p>
                    <p><strong>Patrocinador:</strong><br>INVID</p>
                    <p><strong>Fecha de publicación:</strong><br>11/3/2025</p>
                    <p><strong>Publicado por:</strong><br>Jonathan Vega</p>
                </div>
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

<?php
    include("../view/footer.php");
?>
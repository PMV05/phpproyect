<!-- 
    Autor:  
    - Jonathan J Vega Rivera 
    - Pedro M. Vazquez Gonzalez 
    - Pedro I. Perez Nieves

    Pagina inicial del admin
-->

<?php
    include("../util/main.php");
    include("../view/header_admin.php");
?>

<main>
    <h1>Menu</h1>

    <!-- Opciones que tiene el administrador para navegar -->
    <div id="menu-options">
        <a href="<?php echo $app_path . "admin/opportunity/"?>">
            <div class="menu-card">
                <h2>Oportunidades</h2>
                <img src="<?php echo $app_path . "images/opportunity.png" ?>" />
            </div>
        </a>
        <a href="<?php echo $app_path . "admin/profile/"?>" >
            <div class="menu-card">
                <h2>Cuentas</h2>
                <img src="<?php echo $app_path . "images/user.png" ?>" />
            </div>
        </a>
    </div>
</main>

<?php include("../view/footer.php"); ?>
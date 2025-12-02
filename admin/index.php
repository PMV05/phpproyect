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
<link rel="stylesheet" href="../style.css">
<main>
    <h1>Menu</h1>

    <!-- Opciones que tiene el administrador para navegar -->
    <div id="menu-options">
        <a href="<?php echo $app_path . "admin/opportunity/"?>">
            <div class="menu-card">
                <h2>Oportunidades</h2>
                <img src="../images/opportunity.png">
            </div>
        </a>
        <a href="<?php echo $app_path . "admin/account/"?>" >
            <div class="menu-card">
                <h2>Cuentas</h2>
                <img src="../images/user.png">
            </div>
        </a>
    </div>
</main>

<?php include("../view/footer.php"); ?>
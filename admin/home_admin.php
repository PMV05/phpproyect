<?php 
    include('../util/main.php');
    include("../view/header.php");
?>

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
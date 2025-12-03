
<?php
    /* Autor:  
    - Jonathan J Vega Rivera 
    - Pedro M. Vazquez Gonzalez 
    - Joseph I. Perez Nieves

    Pagina inicial de la aplicacion web
    */

    include("../util/main.php");

    if($isAdminLog){
        $action = filter_input(INPUT_GET, 'action');

        if(!isset($action))
            $action = "home";
    }
    else
        $action = "login";

    switch ($action){
        // Muestra la pagina principal
        case 'home':
            include("home_admin.php");
            break;

        // Iniciar sesion
        case 'login':
            header("Location: ./login/");
            exit();

        // Cierra sesion 
        case 'logout':
            unset($_SESSION['user']);
            unset($_SESSION['role']);
            header("Location: ./login/");
            exit();
    }
?>
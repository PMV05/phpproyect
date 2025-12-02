<?php 
    require_once("../util/main.php");
    include("../util/text.php");
    include("../util/file.php");
    require_once("../model/opportunity.php");
    require_once("../model/opportunity_db.php");

    $action = filter_input(INPUT_POST, 'action');

    // Se muestran las oportunidades
    if (!isset($action)) {
        $action = filter_input(INPUT_GET, 'action');

        if (!isset($action))
            $action = "view_opportunities";
    }

    switch($action) {
        // Accion por default para ver el perfil del usuario
        case 'view_opportunities':
            // Busca todas las oportunidades relacionadas al usuario
            $opportunities = OpportunityDB::getAllOpportunities();

            include("opportunity_view.php");
            break;
    }
 ?>
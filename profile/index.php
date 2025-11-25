<?php 
    require_once("../util/main.php");
    require_once("../model/opportunity.php");
    require_once("../model/opportunity_db.php");

    // $opportunityId = filter_input(INPUT_POST, 'opportunityId', FILTER_VALIDATE_INT);
    $action = filter_input(INPUT_POST, 'action');

    // Esto es solo un ejemplo en lo que se utiliza el UserDB
    $username = 'jonathan.vega';

    // Si no hay una accion entrada, mostrara el perfil por deafult
    if (!isset($action)) {
        $action = filter_input(INPUT_GET, 'action');

        if (!isset($action))
            $action = "view_profile";
    }

    switch($action) {
        // Accion por defualt para ver el perfil del usuario
        case 'view_profile':
            // Busca todas las oportunidades relacionadas al usuario
            $opportunities = OpportunityDB::getOpportunitiesByUserId($username);

            include("profile_view.php");
            break;

        // Muestra el formulario para añadir o editar una oportunidad
        case 'add_edit_opportunity_form':
            $opportunityId = filter_input(INPUT_POST, 'opportunityId', FILTER_VALIDATE_INT);
            $opportunities_type = OpportunityDB::getOpportunitiesType();

            $opportunity = OpportunityDB::getOpportunityById($opportunityId);

            if($opportunity === null)
                $opportunity = new Opportunity();
                
            include("../opportunity/opportunity_add_edit.php");
            break;

        // Accion para añadir una oportunidad
        case 'add_opportunity':
            $opportunity = new Opportunity();
            $opportunity->setType(filter_input(INPUT_POST, 'type', FILTER_VALIDATE_INT));
            $opportunity->setAuthor(filter_input(INPUT_POST, 'userId'));
            $opportunity->setTitle(filter_input(INPUT_POST, 'title'));
            $opportunity->setDescription(filter_input(INPUT_POST, 'description'));
            $opportunity->setSponsor(filter_input(INPUT_POST, 'sponsor'));
            $opportunity->setURL(filter_input(INPUT_POST, 'url'));
            $opportunity->setAttachment(filter_input(INPUT_POST, 'attachment'));
            $opportunity->setDeadline(filter_input(INPUT_POST, 'deadline'));


            OpportunityDB::addOpportunity($opportunity);
            header("Location: .");
            break;

        // Accion para eliminar unaoportunidad
        case "delete_opportunity":
            
            $opportunityId = filter_input(INPUT_POST, "opportunityId", FILTER_VALIDATE_INT);
            
            OpportunityDB::deleteOpportunity($opportunityId);
            
            header("Location: .");
            break;

        // Accion para editar una oportunidad
        case "edit_opportunity":
            $opportunity = new Opportunity();
            $opportunity->setId(filter_input(INPUT_POST, 'opportunityId', FILTER_VALIDATE_INT));
            $opportunity->setType(filter_input(INPUT_POST, 'type', FILTER_VALIDATE_INT));
            $opportunity->setTitle(filter_input(INPUT_POST, 'title'));
            $opportunity->setDescription(filter_input(INPUT_POST, 'description'));
            $opportunity->setSponsor(filter_input(INPUT_POST, 'sponsor'));
            $opportunity->setURL(filter_input(INPUT_POST, 'url'));
            $opportunity->setAttachment(filter_input(INPUT_POST, 'attachment'));
            $opportunity->setDeadline(filter_input(INPUT_POST, 'deadline'));
            
            OpportunityDB::updateOpportunity($opportunity);

            header("Location: .");
    }
 ?>
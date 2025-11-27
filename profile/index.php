<?php 
    require_once("../util/main.php");
    require_once("../model/opportunity.php");
    require_once("../model/opportunity_db.php");
    require_once("../model/validate.php");

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
            // Recibe el id de la oportunidad seleccionada, para recibir un objeto de la oportunidad 
            // seleccionada en el caso de que no exista se crea un nuevo objeto 
            $opportunityId = filter_input(INPUT_POST, 'opportunityId', FILTER_VALIDATE_INT);
            $opportunities_type = OpportunityDB::getOpportunitiesType();

            $opportunity = OpportunityDB::getOpportunityById($opportunityId);

            if($opportunity === null)
                $opportunity = new Opportunity();
                
            include("../opportunity/opportunity_add_edit.php");
            break;

        // Accion para añadir una oportunidad
        case 'add_opportunity':
            // IMPORTANTE: ENVIAR EMAIL DE LA LISTA DE DISTRIBUCION

            // Lista de los mensajes de error
            $errorMessage= [] ;

            $opportunities_type = OpportunityDB::getOpportunitiesType();

            $type = filter_input(INPUT_POST, 'type', FILTER_VALIDATE_INT);
            $title = filter_input(INPUT_POST, 'title');
            $description = filter_input(INPUT_POST, 'description');
            $sponsor = filter_input(INPUT_POST, 'sponsor');
            $url = filter_input(INPUT_POST, 'url');

            $opportunity = new Opportunity();

            // Se validan los campos

            if(!validate\type($type))
                $errorMessage['type'] = 'Escoge un tipo';
            
            if(!validate\title($title))
                $errorMessage['title'] = 'Coloca un título';

            if(!validate\description($description))
                $errorMessage['description'] = 'Coloca una descripción';

            if(!validate\sponsor($sponsor))
                $errorMessage['sponsor'] = 'Coloca un patrocinador';

            if($url != "")
                if(!validate\url($url))
                    $errorMessage['url'] = 'Entre un url válido';

            if(count($errorMessage) > 0){
                include("../opportunity/opportunity_add_edit.php");
                exit;
            }

            $opportunity->setType($type);
            $opportunity->setAuthor(filter_input(INPUT_POST, 'userId'));
            $opportunity->setTitle($title);
            $opportunity->setDescription($description);
            $opportunity->setSponsor($sponsor);
            $opportunity->setURL($url);
            $opportunity->setAttachment(filter_input(INPUT_POST, 'attachment'));
            $opportunity->setDeadline(filter_input(INPUT_POST, 'deadline'));

            OpportunityDB::addOpportunity($opportunity);
            header("Location: .");
            break;

        // Accion para eliminar unaoportunidad
        case "delete_opportunity":
            // Recibe el id de la oportunidad que se va a eliminar
            $opportunityId = filter_input(INPUT_POST, "opportunityId", FILTER_VALIDATE_INT);
            
            OpportunityDB::deleteOpportunity($opportunityId);
            
            header("Location: .");
            break;

        // Accion para editar una oportunidad
        case "edit_opportunity":
            // Lista de los mensajes de error
            $errorMessage= [] ; 

            $type = filter_input(INPUT_POST, 'type', FILTER_VALIDATE_INT);
            $title = filter_input(INPUT_POST, 'title');
            $description = filter_input(INPUT_POST, 'description');
            $sponsor = filter_input(INPUT_POST, 'sponsor');
            $url = filter_input(INPUT_POST, 'url');

            $opportunity = new Opportunity();

            // Se validan los campos

            if(!validate\type($type))
                $errorMessage['type'] = 'Escoge un tipo';
            
            if(!validate\title($title))
                $errorMessage['title'] = 'Coloca un título';

            if(!validate\description($description))
                $errorMessage['description'] = 'Coloca una descripción';

            if(!validate\sponsor($sponsor))
                $errorMessage['sponsor'] = 'Coloca un patrocinador';

            if($url != "")
                if(!validate\url($url))
                    $errorMessage['url'] = 'Entre un url válido';

            if(count($errorMessage) > 0){
                include("../opportunity/opportunity_add_edit.php");
                exit;
            }

            $opportunity->setId(filter_input(INPUT_POST, 'opportunityId', FILTER_VALIDATE_INT));
            $opportunity->setType($type);
            $opportunity->setTitle($title);
            $opportunity->setDescription($description);
            $opportunity->setSponsor($sponsor);
            $opportunity->setURL($url);
            $opportunity->setAttachment(filter_input(INPUT_POST, 'attachment'));
            $opportunity->setDeadline(filter_input(INPUT_POST, 'deadline'));
            
            OpportunityDB::updateOpportunity($opportunity);

            header("Location: .");
    }
 ?>
<?php

    // session_start();

    include("../../util/main.php");
    include("../../util/file.php");
    include("../../util/text.php");
    require_once "../../model/opportunity.php";
    require_once "../../model/opportunity_db.php";
    require_once "../../model/distributionListdb.php";
    require_once("../../model/validate.php");

    $action = filter_input(INPUT_POST, 'action');
    // Se muestran las oportunidades
    if (!isset($action)) {
        $action = filter_input(INPUT_GET, 'action');

        if (!isset($action))
            $action = "view_opportunities";
    }

    $username = "jonathan.vega";

    switch ($action) {

        case 'view_opportunities':
            $opportunities = OpportunityDB::getAllOpportunities();
            
            include("index_view.php");
            break;

        case 'add_edit_opportunity_form':
            // Recibe el id de la oportunidad seleccionada, para recibir un objeto de la oportunidad 
            // seleccionada en el caso de que no exista se crea un nuevo objeto 
            $opportunityId = filter_input(INPUT_GET, 'opportunityId', FILTER_VALIDATE_INT);
            $opportunities_type = OpportunityDB::getOpportunitiesType();

            $opportunity = OpportunityDB::getOpportunityById($opportunityId);

            if($opportunity === null)
                $opportunity = new Opportunity();
                    
            include("../opportunity/opportunity_add_edit.php");
            break;

        // Lista de los mensajes de error
        case 'add_opportunity':
            $errorMessage= [] ;

            $opportunities_type = OpportunityDB::getOpportunitiesType();

            // Se obtienen los datos
            $id = filter_input(INPUT_POST, 'userId');
            $type = filter_input(INPUT_POST, 'type', FILTER_VALIDATE_INT);
            $title = filter_input(INPUT_POST, 'title');
            $description = filter_input(INPUT_POST, 'description');
            $sponsor = filter_input(INPUT_POST, 'sponsor');
            $url = filter_input(INPUT_POST, 'url');
            $typeName = "";

            // Segun el id busca el nombre del tipo de la oportunidad
            foreach($opportunities_type as $types)
                if($types['id'] == $type)
                    $typeName = $types['name'];

            $opportunity = new Opportunity();

            // Se validan los campos
            if(!validate\requiredField($type))  // TIPO
                $errorMessage['type'] = 'Escoge un tipo';
            
            if(!validate\requiredField($title)) // TITULO
                $errorMessage['title'] = 'Coloca un título';

            if(!validate\requiredField($description))   // DESCRIPCION
                $errorMessage['description'] = 'Coloca una descripción';

            if(!validate\requiredField($sponsor))   // PATROCINADOR
                $errorMessage['sponsor'] = 'Coloca un patrocinador';

            if(!empty($url))    // URL
                if(!validate\url($url))
                    $errorMessage['url'] = 'Entre un url válido';

            $fileMessage = File::upload('attachment');
            if($fileMessage !== True)   // ADJUNTO
                $errorMessage['file'] = $fileMessage;

            // Se añade los valores hasta el momento
            $opportunity->setType($type);
            $opportunity->setAuthor($id);
            $opportunity->setTitle($title);
            $opportunity->setDescription($description);
            $opportunity->setSponsor($sponsor);
            $opportunity->setURL($url);
            $opportunity->setAttachment(File::getFileName('attachment'));
            $opportunity->setTypeName($typeName);
            $opportunity->setDeadline(filter_input(INPUT_POST, 'deadline'));

            // Si hay un error se le enviara volver a mostrar el formulario
            if(count($errorMessage) > 0){
                include("opportunity_add_edit.php");
                break;
            }

            // Se añade a la base de datos
            OpportunityDB::addOpportunity($opportunity);

            // Obtiene todos los emails de la lista de distribucion
            // para avisarles que una nueva oportunidad fue publicada
            $emails = DistributionListDB::getAllEmails();

            foreach($emails as $email){
                $subject = "Nueva Oportunidad!";
                $content = "Saludos,\n\n" .
                           "Se ha publicado una nueva oportunidad en nuestra plataforma:\n\n" .
                            "Título: $title\n" .
                            "Publicado por: $id\n" .
                            "Patrocinador: $sponsor\n" .  
                            "Tipo: $typeName\n\n" . 
                            "¡No pierdas esta oportunidad de crecer profesionalmente!\n\n" .
                            "Atentamente,\n" .
                            "Equipo OportuniHub";
                $header = "From: oportunihub@gmail.com\r\n";
                        
                mail($email, $subject, $content, $header);
            }

            header("Location: .");
            exit();

        // Accion para eliminar unaoportunidad
        case "delete_opportunity":
            // Recibe el id de la oportunidad que se va a eliminar
            $opportunityId = filter_input(INPUT_GET, "opportunityId", FILTER_VALIDATE_INT);
            
            OpportunityDB::deleteOpportunity($opportunityId);
            
            header("Location: .");
            exit();

        // Accion para editar una oportunidad
        case "edit_opportunity":
            // Lista de los mensajes de error
            $errorMessage= [] ; 

            $opportunities_type = OpportunityDB::getOpportunitiesType();

            // Obtiene todos los datos
            $opportunityId = filter_input(INPUT_POST, 'opportunityId', FILTER_VALIDATE_INT);
            $type = filter_input(INPUT_POST, 'type', FILTER_VALIDATE_INT);
            $title = filter_input(INPUT_POST, 'title');
            $description = filter_input(INPUT_POST, 'description');
            $sponsor = filter_input(INPUT_POST, 'sponsor');
            $url = filter_input(INPUT_POST, 'url');
            $attachment = filter_input(INPUT_POST, 'filename');
            $delete_attachment = filter_input(INPUT_POST, 'delete-attachment', FILTER_VALIDATE_INT);

            $opportunity = new Opportunity();

            // Se validan los campos
            if(!validate\requiredField($type))  // TIPO
                $errorMessage['type'] = 'Escoge un tipo';
            
            if(!validate\requiredField($title)) // TITULO
                $errorMessage['title'] = 'Coloca un título';

            if(!validate\requiredField($description))   // DESCRIPCION
                $errorMessage['description'] = 'Coloca una descripción';

            if(!validate\requiredField($sponsor))   // PATROCINADOR
                $errorMessage['sponsor'] = 'Coloca un patrocinador';

            if(!empty($url))    // URL
                if(!validate\url($url))
                    $errorMessage['url'] = 'Entre un url válido';

            $fileMessage = True;

            // Si existe un archivo pero se va a añadio otro, se borra el que estaba
            // y se carga el nuevo archivo adjuntado
            // Tambien, sera cierto si no hay ningun archivo adjuntado
            if(isset($_FILES['attachment']) or empty($attachment)){
                if(!empty($attachment))
                    File::deleteFile($attachment);

                $fileMessage = File::upload('attachment');

                // Si no hay ningun error, se cambia el valor de la variable attachment, al del nuevo archivo
                if($fileMessage !== True)   // ADJUNTO
                    $errorMessage['file'] = $fileMessage;
                else
                    $attachment = File::getFileName('attachment');
            }

            // Se añade los valores hasta el momento
            $opportunity->setId($opportunityId);
            $opportunity->setType($type);
            $opportunity->setTitle($title);
            $opportunity->setDescription($description);
            $opportunity->setSponsor($sponsor);
            $opportunity->setURL($url);
            $opportunity->setDeadline(filter_input(INPUT_POST, 'deadline'));

            // Se elimina el archivo 
            if($delete_attachment == 1){
                $isDeleted = File::deleteFile($attachment);
                
                if ($isDeleted)
                    $opportunity->setAttachment('');
            }
            else
                $opportunity->setAttachment($attachment);

            // Si hay un error se le enviara volver a mostrar el formulario
            if(count($errorMessage) > 0){
                include("../opportunity/opportunity_add_edit.php");
                break;
            }

            // Se edita la oportunidad
            OpportunityDB::updateOpportunity($opportunity);

            header("Location: .");
            exit();
}

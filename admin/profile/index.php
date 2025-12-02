<?php 
    require_once("../../util/main.php");
    require_once("../../model/opportunity.php");
    require_once("../../model/opportunity_db.php");    
    require_once("../../model/user.php");
    require_once("../../model/user_db.php");
    require_once("../../model/distributionListdb.php");
    require_once("../../model/validate.php");
    require_once("../../util/file.php");

    $action = filter_input(INPUT_POST, 'action');

    // Esto es solo un ejemplo en lo que se utiliza el UserDB
    $username = 'jonathan.vega';

    // Si no hay una accion entrada, mostrara el perfil por default
    if (!isset($action)) {
        $action = filter_input(INPUT_GET, 'action');

        if (!isset($action))
            $action = "view_profile";
    }

    switch($action) {
        // Accion por default para ver el perfil del usuario
        case 'view_profile':
            // Busca la informacion del usuario
            $user = UserDB::getUserById($username);

            // Busca todas las oportunidades relacionadas al usuario
            $opportunities = OpportunityDB::getOpportunitiesByUserId($username);

            include("profile_view.php");
            break;

        // Accion para mostrar el formulario
        case 'edit_profile_form':
            // Busca la informacion del usuario
            $user = UserDB::getUserById($username);

            include("profile_edit.php");
            break;

        // Accion para editar el perfil del usuario
        case "edit_profile":
            // Almacena los mensajes de errores
            $errorMessage = [];
            // Almacena las contraseñas que se colocaron 
            $passwords = [];

            $users = UserDB::getAllUsers();
            $user = UserDB::getUserById($username);

            $userID = filter_input(INPUT_POST, 'username'); 
            $email = filter_input(INPUT_POST, 'email'); 
            $password = filter_input(INPUT_POST, 'password'); 
            $newPassword = filter_input(INPUT_POST, 'new-password');
            $confirmPassword = filter_input(INPUT_POST, 'confirm-password');
           
            // Se validan los campos

            // Valida el nombre del usuario
            if(!validate\userID($userID) || !validate\requiredField($userID)){
                $errorMessage['userID'] = "Nombre de usuario inválido";
                $user->setUserID($userID);
            }
            else
                // Si el id no es lo mismo y no existe en la base de datos se cambia
                if($user->getUserID() != $userID)
                    if(!UserDB::findUserID($userID))
                        $user->setUserID($userID);
                    
                    else
                        $errorMessage['userID'] = "Nombre de usuario no disponible";

            // Valida el email    
            if(!validate\email($email) || !validate\requiredField($email))
                $errorMessage['email'] = "Email inválido";
            else
                // Si el email no es lo mismo y no existe en la base de datos se cambia
                if($user->getEmail() != $email)
                    if(!UserDB::findEmail($email))
                        $user->setEmail($email);
                    else
                        $errorMessage['email'] = "Email no disponible";

            # Valida que esten todos los campos de la contraseñas
            if(validate\requiredField($password) &&
                validate\requiredField($newPassword) &&
                validate\requiredField($confirmPassword)){

                // Valida que las contraseñas tengan el formato correct
                if(validate\password($password) &&
                    validate\password($newPassword) &&
                    validate\password($confirmPassword)){ 

                    // Verifica que la contraseña actual sea la correcta
                    if(password_verify($password, $user->getPassword())){
                        #Verifica que la contraseña nueva este escrita correctamente
                        if($newPassword === $confirmPassword)
                            $user->setPassword(password_hash($newPassword, PASSWORD_DEFAULT));
                        
                        else
                            $errorMessage['confirmPassword'] = "Las contraseñas no coinciden";
                    }
                    else 
                        $errorMessage['password'] = "Contraseña incorrecta";
                }
                else {
                    // Contraseña actual
                    if(!validate\password($password))
                        $errorMessage['password'] = "La contraseña no es segura";
                    
                    // Contraseña nueva
                    if(!validate\password($newPassword))
                        $errorMessage['newPassword'] = "La contraseña no es segura";

                    // Confirmacion de la contraseña nueva
                    if(!validate\password($confirmPassword))
                        $errorMessage['confirmPassword'] = "La contraseña no es segura";
                }
            }
            // Valida que haya por lo menos un campo lleno
            else if(validate\requiredField($password) ||
                    validate\requiredField($newPassword) ||
                    validate\requiredField($confirmPassword)) {

                // Contraseña actual
                if(!validate\requiredField($password))
                    $errorMessage['password'] = "Debe colocar la contraseña";

                // Contraseña nueva
                if(!validate\requiredField($newPassword))
                    $errorMessage['newPassword'] = "Debe colocar la nueva contraseña";

                // Confirmacion de la contraseña nueva
                if(!validate\requiredField($confirmPassword))
                    $errorMessage['confirmPassword'] = "Debe confirmar la contraseña";
            }

            $passwords['password'] = $password;
            $passwords['newPassword'] = $newPassword;
            $passwords['confirmPassword'] = $confirmPassword;

            // Si hay un error se le enviara volver a mostrar el formulario
            if(count($errorMessage) > 0){
                include("profile_edit.php");
                break;
            }
            
            UserDB::updateUser($user, $username);

            header("Location: .");
            exit();

        // Muestra el formulario para añadir o editar una oportunidad
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

        // Accion para añadir una oportunidad
        case 'add_opportunity':
            // Lista de los mensajes de error
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
                include("../opportunity/opportunity_add_edit.php");
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
 ?>
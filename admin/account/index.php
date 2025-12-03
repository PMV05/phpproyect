    <?php
    include("../../util/main.php");
    require_once "../../model/user.php";
    require_once "../../model/user_db.php";
    require_once "../../model/validate.php";

    // Verifica si ha iniciado sesion
    if($isAdminLog){
        $action = filter_input(INPUT_POST, 'action');

        // Si no hay una accion entrada, mostrara el perfil por default
        if (!isset($action)) {
            $action = filter_input(INPUT_GET, 'action');

            if (!isset($action))
                $action = "list";
        }
    }
    else {
        $action = "login";
    }

    switch ($action) {

        // Iniciar sesion
        case 'login':
            header("Location: ../login/");
            exit();

        // Cierra sesion 
        case 'logout':
            unset($_SESSION['user']);
            unset($_SESSION['role']);
            header("Location: ../login/");
            exit();
        
        case 'list':
            $users = UserDB::getAllUsers();
            include("account_list_view.php");
            exit();
        
        case 'delete':
            $userID = filter_input(INPUT_GET, 'userID');
            if (!empty($userID)) {
                UserDB::deleteUser($userID);
            }

            $users = UserDB::getAllUsers();
            header("Location: .");
            exit();


        case 'add_edit_account_form':
            $userId = filter_input(INPUT_GET, 'userID');

            // Si hay un id entonces la accion que hara sera editar
            if(!isset($userId))
                $action = "add";
            else
                $action = 'edit';

            // Si el id existe se creara un objeto con los datos
            // Si no existe se crea un objeto vacio
            $user = UserDB::getUserById($userId);

            if($user === null)
                $user = new User();
                    
            include("account_add_edit.php");
            break;

        case 'add':
            $errors = [];

            $userID = filter_input(INPUT_POST, 'userID');
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password');
            $role = filter_input(INPUT_POST, 'role', FILTER_VALIDATE_INT);;

            $user = new User();

            // Validaciones nombre de usuario
            if (!validate\requiredField($userID) || !validate\userID($userID))
                $errors['userID'] = "Nombre de usuario inválido.";
            
            else
                if(UserDB::findUserID($userID))
                    $errors['userID'] = "Nombre de usuario no disponible.";
                else 
                    $user->setUserID($userID);

            // Validaciones del correo electronico
            if (!validate\requiredField($email) || !validate\email($email))
                $errors['email'] = "Correo electrónico inválido.";
            
            else
                if(UserDB::findEmail($email))
                    $errors['email'] = "Correo electrónico no disponible.";
                else
                    $user->setEmail($email);

            // Validaciones de la contraseña
            if (!validate\requiredField($password) || !validate\password($password))
                $errors['password'] = "Contraseña inválida";
            else
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

            // Verifica que se haya seleccionado un rol
            if ($role <= 0) 
                $errors['role'] = "Seleccione un rol";
            else 
                $user->setUserRole($role);
            
            // Si hay errores muestra el formulario
            if (count($errors) > 0) {
                include("account_add_edit.php");
                break;
            }

            UserDB::addUser($user);

            header("Location: .");
            exit();

        // case 'add':
        case 'edit':
            $errors = [];

            $currentUserID = filter_input(INPUT_POST, 'currentUserID');
            $userID = filter_input(INPUT_POST, 'userID');
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password');
            $role = filter_input(INPUT_POST, 'role', FILTER_VALIDATE_INT);;

            $user = UserDB::getUserById($currentUserID);

            // Validaciones nombre de usuario
            if (!validate\requiredField($userID) || !validate\userID($userID))
                $errors['userID'] = "Nombre de usuario inválido.";
            
            // Si el nombre de usuario entrado es diferente al actual, 
            // verifica si existe, y si no existe lo cambia
            else if ($currentUserID != $userID){
                if(UserDB::findUserID($userID))
                    $errors['userID'] = "Nombre de usuario no disponible.";
                else 
                    $user->setUserID($userID);
            }

            // Validaciones del correo electronico
            if (!validate\requiredField($email) || !validate\email($email))
                $errors['email'] = "Correo electrónico inválido.";
            
            // Si el email entrado es diferente al actual, 
            // verifica si existe, y si no existe lo cambia
            else if ($user->getEmail() != $email){
                if(UserDB::findEmail($email))
                    $errors['email'] = "Nombre de usuario no disponible.";
                else 
                    $user->setEmail($email);
            }

            // Validaciones de la contraseña
            if (validate\requiredField($password) && !validate\password($password))
                $errors['password'] = "Contraseña inválida";
            else
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

            // Verifica que se haya seleccionado un rol
            if ($role <= 0) 
                $errors['role'] = "Seleccione un rol";
            else 
                $user->setUserRole($role);
            
            // Si hay errores muestra el formulario
            if (count($errors) > 0) {
                include("account_add_edit.php");
                break;
            }

            UserDB::updateUser($user, $currentUserID);

            header("Location: .");
            exit();
    }
?>

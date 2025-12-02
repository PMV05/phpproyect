<?php
require_once("../util/main.php");
require_once("../model/user.php");
require_once("../model/user_db.php");
require_once("../model/validate.php");
echo '<link rel="stylesheet" href="/ccom4019/phpproyect/login/style_log.css">';

session_start();

// Acción inicial
$action = filter_input(INPUT_POST, 'action');

if (!isset($action)) {
    $action = filter_input(INPUT_GET, 'action');

    if (!isset($action))
        $action = "view_login_form";
}

switch ($action) {

    // Mostrar formulario
    case "view_login_form":
        include("login.php");
        break;

    // Procesar login
    case "login":

        $errorMessage = [];

        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        // Validaciones nombre de usuario
        if (!validate\requiredField($username) || !validate\userID($username))
            $errorMessage['usernameLog'] = "Nombre de usuario inválido.";
        
        else
            if(!UserDB::findUserID($username))
                $errorMessage['usernameLog'] = "Nombre de usario no existe.";

        // Validaciones de la contraseña
        if (!validate\requiredField($password) || !validate\password($password))
            $errorMessage['password'] = "Contraseña inválida";


        // Si hay errores muestra el formulario
        if (count($errorMessage) > 0) {
            include("login.php");
            break;
        }

        // Buscar usuario
        $user = UserDB::getUserById($username);

        // Verificar contrasena
        if (!password_verify($password, $user->getPassword())) {
            $errorMessage['password'] = "Contraseña incorrecta";
            include("login.php");
            break;
        }

        // Login exitoso
        $_SESSION['user'] = $user->getUserID();
        header("Location: ../index.php");
        exit();

    case 'register':
        
        $errorMessage = [];

        $username = filter_input(INPUT_POST, 'username');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $role = 1;

        $user = new User();
        $user->setUserRole($role);

        // Validaciones nombre de usuario
        if (!validate\requiredField($username) || !validate\userID($username))
            $errorMessage['username'] = "Nombre de usuario inválido.";
        
        else
            if(UserDB::findUserID($username))
                $errorMessage['username'] = "Nombre de usuario no disponible.";
            else
                $user->setUserID($username);

        // Validaciones del correo electronico
        if (!validate\requiredField($email) || !validate\email($email))
            $errorMessage['email'] = "Correo electrónico inválido.";
        
        else
            if(UserDB::findEmail($email))
                $errorMessage['email'] = "Correo electrónico no disponible.";
            else
                $user->setEmail($email);

        // Validaciones de la contraseña
        if (!validate\requiredField($password) || !validate\password($password))
            $errorMessage['password'] = "Contraseña inválida";
        else
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

        // Si hay errores muestra el formulario
        if (count($errorMessage) > 0) {
            include("login.php");
            break;
        }

        UserDB::addUser($user);

        header("Location: .");
        exit();

    // Logout
    case "logout":
        session_destroy();
        header("Location: ../index.php");
        exit();

}

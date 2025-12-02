<?php
require_once("../../util/main.php");
require_once("../../model/user.php");
require_once("../../model/user_db.php");
require_once("../../model/validate.php");
echo '<link rel="stylesheet" href="/ccom4019/phpproyect/admin/login/style_log.css">';

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

        // Validaciones
        if (!validate\requiredField($username))
            $errorMessage['username'] = "Debe colocar su nombre de usuario";

        if (!validate\requiredField($password))
            $errorMessage['password'] = "Debe colocar su contraseña";

        // Si hay errores muestra el formulario
        if (count($errorMessage) > 0) {
            include("login.php");
            break;
        }

        // Buscar usuario
        $user = UserDB::getUserById($username);

        if ($user === null) {
            $errorMessage['username'] = "Usuario no encontrado";
            include("login.php");
            break;
        }

        // Verificar contrasena
        if (!password_verify($password, $user->getPassword())) {
            $errorMessage['password'] = "Contraseña incorrecta";
            include("login.php");
            break;
        }

        // Login exitoso
        $_SESSION['user'] = $user->getUserID();
        header("Location: ../dashboard/index.php");
        exit();

    // Logout
    case "logout":
        session_destroy();
        header("Location: index.php?action=view_login_form");
        exit();

}

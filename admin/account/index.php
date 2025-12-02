<?php
include("../../util/main.php");
require_once "../../model/user.php";
require_once "../../model/user_db.php";
require_once "../../model/validate.php";

$action = filter_input(INPUT_POST, 'action');
if ($action === null) {
    $action = filter_input(INPUT_GET, 'action');
}
if ($action === null || $action === '') {
    $action = 'list';  
}

switch ($action) {

    case 'delete':
        $userID = filter_input(INPUT_POST, 'userID');
        if (!empty($userID)) {
            UserDB::deleteUser($userID);
        }

        $users = UserDB::getAllUsers();
        include("account_list_view.php");
        exit();

    case 'add':
    case 'edit':
        $mode = $action;     
        $errors = [];
        $user   = null;
        $userID   = "";
        $email    = "";
        $password = "";
        $role     = 0;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $userID   = trim((string) filter_input(INPUT_POST, 'userID'));
            $email    = trim((string) filter_input(INPUT_POST, 'email'));
            $password = trim((string) filter_input(INPUT_POST, 'password'));
            $role     = (int) filter_input(INPUT_POST, 'role');

            // ---- VALIDACIONES ----
            if (!validate\requiredField($userID) || !validate\userID($userID)) {
                $errors['userID'] = "Nombre de usuario no valido (Formato nombre.apellido)";
            }

            if (!validate\requiredField($email) || !validate\email($email)) {
                $errors['email'] = "El email es inválido.";
            } 
            else {
                if ($mode === 'add') {
                    if (UserDB::findEmail($email)) {
                        $errors['email'] = "Este email ya existe";
                    }
                }

                if ($mode === 'edit') {
                    $editUser = UserDB::getUserById($userID);

                    if (UserDB::findEmail($email) && $email !== $editUser->getEmail()) {
                        $errors['email'] = "Este email ya existe.";
                    }
                }
            }
            
            if ($role <= 0) {
                $errors['role'] = "Seleccione un rol";
            }

            if ($mode === 'add') {
                if (!validate\requiredField($password)) {
                    $errors['password'] = "Contraseña requerida.";
                } 
                elseif (!validate\password($password)) {
                    $errors['password'] = "Password no es valido (mayúscula, minúscula, número y símbolo).";
                }
            } 
            else {
                if ($password !== '' && !validate\password($password)) {
                    $errors['password'] = "Password no es valido (mayúscula, minúscula, número y símbolo).";
                }
            }

            if (empty($errors)) {

                if ($password !== '') {
                    $hashed = password_hash($password, PASSWORD_DEFAULT);
                }

                if ($mode === 'edit') {
                    $oldUser = UserDB::getUserById($userID);
                    if ($oldUser) {
                        $finalPassword = ($password === '') ? $oldUser->getPassword() : $hashed;
                        $user = new User($userID, $email, $finalPassword, $role, "");
                        UserDB::updateUser($user, $userID);
                    }
                } else {

                    $user = new User($userID, $email, $hashed, $role, "");
                    UserDB::addUser($user);
                }


                header("Location: index.php");
                exit();
            }

        } 
        else {
                $userIDParam = filter_input(INPUT_GET, 'id');
                if ($userIDParam) {
                    $user = UserDB::getUserById($userIDParam);
                    if ($user) {
                        $userID = $user->getUserID();
                        $email  = $user->getEmail();
                        $role   = $user->getUserRole();
                    }
                }
        }

        include("account_add_edit_view.php");
        exit();


    case 'list':
    default:
        $users = UserDB::getAllUsers();
        include("account_list_view.php");
        exit();
}
?>

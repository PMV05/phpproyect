<?php
include("../../util/main.php");

require_once "../../model/user.php";
require_once "../../model/user_db.php";

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

        header("Location: index.php");
        exit();

    case 'add':
    case 'edit':
        include("account_add_edit.php");
        break;

    case 'list':
    default:
        $users = UserDB::getAllUsers();
        function getRoleLabel($user) {
            if (method_exists($user, 'getRole')) {
                $role = $user->getRole();
            } elseif (method_exists($user, 'getUserRole')) {
                $role = $user->getUserRole();
            } else {
                return 'Desconocido';
            }

            if ($role == 1) return "Contribuidor";
            if ($role == 2) return "Administrador";
            return "Rol $role";
        }

        include("account_list_view.php");
        break;
}
?>

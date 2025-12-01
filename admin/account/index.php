<?php
include("../../util/main.php");

require_once "../../model/user.php";
require_once "../../model/user_db.php";

// Handle delete
$action = filter_input(INPUT_POST, 'action');
if ($action === null) {
    $action = filter_input(INPUT_GET, 'action');
}

if ($action === 'delete') {
    $userID = filter_input(INPUT_POST, 'userID');
    if (!empty($userID)) {
        UserDB::deleteUser($userID);
    }
    header("Location: index.php");
    exit();
}

// Get all users
$users = UserDB::getAllUsers();
if ($users === null) $users = [];
else if (!is_array($users)) $users = [$users];

// Function to get role label (keeps UserDB untouched)
function getRoleLabel($user) {
    if (method_exists($user, 'getRoleName')) {
        return $user->getRoleName();
    }
    if (method_exists($user, 'getRole')) {
        $role = $user->getRole();
    } elseif (method_exists($user, 'getUserRole')) {
        $role = $user->getUserRole();
    } else {
        return 'Desconocido';
    }

    return ($role == 1 ? "Contribuidor" : ($role == 2 ? "Administrador" : "Rol $role"));
}

// Pass variables to view
include("account_list_view.php");
?>

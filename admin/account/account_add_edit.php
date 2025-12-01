<?php
include("../../util/main.php");

require_once "../../model/user.php";
require_once "../../model/user_db.php";

$mode = filter_input(INPUT_GET, 'action');
$userID = filter_input(INPUT_GET, 'id');

if (!isset($mode) || $mode === null) {
    $mode = 'add';
}

$errors = [];
$user = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $mode     = $_POST['mode'];
    $userID   = trim($_POST['userID']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role     = (int) $_POST['role'];

    if ($userID === '')
         $errors[] = "El usuario es requerido.";
    if ($email === '')  
        $errors[] = "El email es requerido.";
    if ($mode == 'add' && $password === '') 
        $errors[] = "Contraseña requerida.";

    if ($role <= 0) $errors[] = "Selecciona un rol.";

    if (empty($errors)) {

        if ($password !== '') {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($mode === 'edit') {
            $oldUser = UserDB::getUserById($userID);
            if ($oldUser) {
                $finalPassword = ($password === '') ? $oldUser->getPassword() : $hashed;

                $user = new User($userID, $email, $finalPassword, $role, "");
                UserDB::updateUser($user);
            }
        } else {
            $user = new User($userID, $email, $hashed, $role, "");
            UserDB::addUser($user);
        }

        header("Location: index.php");
        exit();
    }
}

// Load for edit view
if ($mode === 'edit' && $userID) {
    $user = UserDB::getUserById($userID);
}

include("account_add_edit_view.php");
?>

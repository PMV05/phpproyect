<?php
require_once(__DIR__ . '/../../model/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    session_start();

    # valoresForm()
    #
    #  valores edl formulario
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    # validarCampos()
    #
    # verificar que ningun campo este vacio
    if ($email === '' || $password === '') {
        $_SESSION['login_error'] = "Todos los campos son obligatorios";
        header("Location: login.php");
        exit();
    }

    # Login()
    #
    # buscar el usuario por correo
    $query = "SELECT userID, email, password, userRole
              FROM users
              WHERE email = :email";

    try {

        # conectarDB()
        #
        # conexion con la base de datos
        $db = Database::getDB();

        #
        $login = $db->prepare($query);
        $login->bindValue(':email', $email);

        $login->execute();

        # obtenerUser()
        #
        # datos del usuario
        $user = $login->fetch(PDO::FETCH_ASSOC);

        # validarUser()
        #
        # verificar si el usuario existe
        if (!$user) {
            $_SESSION['login_error'] = "El correo no esta registrado";
            header("Location: login.php");
            exit();
        }

        # validarPassword()
        #
        # verificar que la contrasena sea correcta
        if (!password_verify($password, $user['password'])) {
            $_SESSION['login_error'] = "Contrasena incorrecta";
            header("Location: login.php");
            exit();
        }

        # crearSesion()
        #
        # guardar los datos del usuario 
        $_SESSION['userID'] = $user['userID'];
        $_SESSION['userRole'] = $user['userRole'];

        # irInicio()
        #
        # redirigir al inicio
        header("Location: ../../index.php");
        exit();

    } catch (PDOException $e) {

        # errorLogin()
        #
        # error al iniciar sesion
        $_SESSION['login_error'] = "Error del servidor " . $e->getMessage();
        header("Location: login.php");
        exit();
    }
}
?>

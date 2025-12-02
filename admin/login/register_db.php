<?php
require_once(__DIR__ . '/../../model/db.php');

session_start();



if ($_SERVER["REQUEST_METHOD"] === "POST") {

    # Recibir los datos datos
    $userID = trim($_POST["fullname"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    # validarCampos()
    #
    # valida que los campos no esten vacios
    # Recibe userID email password
    # Devuelve mensaje de error si falta un campo
    if ($userID === "" || $email === "" || $password === "") {
        $_SESSION["register_error"] = "Todos los campos son obligatorios";
        header("Location: register.php");
        exit();
    }

    # verifica si existe el usuario
    # buscaUser()
    #
    # busca si el userID ya esta registrado
    $check = "SELECT userID FROM users WHERE userID = :userID";

    # insertar usuario nuevo
    # crearUser()
    #
    # inserta usuario dentro de la bases de datos
    # Recibe userID email password encriptado 
    $insert = "INSERT INTO users (userID, email, password, userRole)
               VALUES (:userID, :email, :password, :role)";

    try {

   
        # crea la conexion con la base de datos
        $db = Database::getDB();

        # Verificar si el usuario ya existe
        $q = $db->prepare($check);
        $q->bindValue(":userID", $userID);
        $q->execute();

        if ($q->fetch()) {

           
            # verifica si el usuario ya existe
            $_SESSION["register_error"] = "Ese nombre de usuario ya existe";
            header("Location: register.php");
            exit();
        }

        # generarHash()
        #
        # crea el hash de la contrasena
        $hash = password_hash($password, PASSWORD_DEFAULT);

        # asignarRol()
        #
        # asigna un rol por defecto al usuario nuevo
        $role = 1;

        # Insertar usuario nuevo
        $newUser = $db->prepare($insert);
        $newUser->bindValue(":userID", $userID);
        $newUser->bindValue(":email", $email);
        $newUser->bindValue(":password", $hash);
        $newUser->bindValue(":role", $role);

        if ($newUser->execute()) {

            # crearSesion()
            #
            # inicia sesion 
            $_SESSION["userID"] = $userID;
            $_SESSION["userRole"] = $role;

            header("Location: ../../index.php");
            exit();
        }

        # errorInsert()
        #
        # error al intentar registrar
        $_SESSION["register_error"] = "Error al crear la cuenta";
        header("Location: register.php");
        exit();

    } catch (PDOException $e) {

        # errorServidor()
        #
        # error en el servidor 
        $_SESSION["register_error"] = "Error en el servidor";
        header("Location: register.php");
        exit();
    }
}
?>

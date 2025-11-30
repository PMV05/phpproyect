<?php
require_once(__DIR__ . '/../../model/db.php');

# Este archivo maneja el proceso de registro de un nuevo usuario
# Valida datos, verifica nombres repetidos y crea la cuenta en la base de datos

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    # Se reciben los valores enviados desde el formulario
    # Se usa trim para eliminar espacios extra antes o despues del texto
    $userID = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    # Validacion basica: ningun campo puede estar vacio
    if (empty($userID) || empty($email) || empty($password)) {
        die("Todos los campos son obligatorios.");
    }

    try {
        # Se establece la conexion a la base de datos
        $db = Database::getDB();

       
        # Verificar si el userID ya esta registrado
        # Consulta para revisar si existe un nombre de usuario igual
        $checkQuery = "SELECT userID FROM users WHERE userID = :userID";
        $checkStmt = $db->prepare($checkQuery);
        $checkStmt->bindValue(':userID', $userID);
        $checkStmt->execute();

        # Si la consulta devuelve un resultado, el nombre ya esta en uso
        if ($checkStmt->fetch()) {
            die("Ese nombre de usuario ya existe. Elige otro.");
        }

        
        # Preparar los datos para insertar
        # Se encripta la contrasena usando password_hash
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        # El rol por defecto es Contribuidor (roleID = 1)
        $role = 1;

       
        // Insertar el usuario en la tabla users
        $insertQuery = "INSERT INTO users (userID, email, password, userRole)
                        VALUES (:userID, :email, :password, :role)";

        # Se prepara la sentencia
        $stmt = $db->prepare($insertQuery);
        $stmt->bindValue(':userID', $userID);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $hashedPassword);
        $stmt->bindValue(':role', $role);

        # Si la insercion fue exitosa, se notifica al usuario
        if ($stmt->execute()) {
            echo "Cuenta creada exitosamente.";
        } else {
            echo "Error al crear la cuenta.";
        }

    } catch (PDOException $e) {
        # Captura errores relacionados con la base de datos
        echo "Error en el servidor: " . $e->getMessage();
    }
}
?>

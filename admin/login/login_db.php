<?php
require_once(__DIR__ . '/../../model/db.php');

# Este archivo maneja el proceso de iniciar sesion de un usuario
# Valida el email, verifica la contrasena y retorna mensaje de exito o error

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    # Recibe los valores del formulario
    # Se limpian espacios extra para evitar errores
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    # Validacion inicial de campos vacios
    # Si falta el email o la contrasena, no se continua
    if (empty($email) || empty($password)) {
        die("Todos los campos son obligatorios.");
    }

    try {
        # Se obtiene la conexion a la base de datos
        $db = Database::getDB();

        # Buscar el usuario usando su email
        # Consulta que obtiene userID, email, contrasena y rol
        $query = "SELECT userID, email, password, userRole FROM users WHERE email = :email";
        
        # Se prepara la sentencia para evitar inyeccion SQL
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        # Se guarda el usuario encontrado en un arreglo asociativo
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        # Si no existe un registro con ese email, se detiene el proceso
        if (!$user) {
            die("Correo no encontrado.");
        }

        # Validar contrasena
        # password_verify compara la contrasena escrita con la encriptada en la base de datos
        if (!password_verify($password, $user['password'])) {
            die("Contrasena incorrecta.");
        }

        # Si pasa todas las validaciones, el login es exitoso
        echo "Login exitoso. Bienvenido " . $user['userID'];

    } catch (PDOException $e) {
        # Captura cualquier error generado por la base de datos
        echo "Error en el servidor: " . $e->getMessage();
    }
}
?>

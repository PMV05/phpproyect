<?php
require_once("../util/main.php");
require_once("../model/validate.php");
require_once("../model/distributionListdb.php");

use validate as val;

# Este archivo procesa la suscripcion de correos a la lista de distribucion
# Valida el correo recibido y lo inserta en la base de datos si es valido

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    # Recibe el correo desde el formulario
    # Se utiliza trim para remover espacios al inicio y final
    $email = trim($_POST['correo'] ?? '');

    # Validar que el correo no este vacio
    if (!val\requiredField($email)) {
        $error_message = "El correo es requerido";
        include("../errors/error.php");
        exit();
    }

    # Validar que el correo tenga un formato valido
    if (!val\email($email)) {
        $error_message = "El correo no es valido";
        include("../errors/error.php");
        exit();
    }

    # Verificar si el correo ya existe en la base de datos
    if (DistributionListDB::emailExists($email)) {
        $error_message = "Este correo ya esta suscrito";
        include("../errors/error.php");
        exit();
    }

    # Insertar el correo en la lista de distribucion
    # addEmail no retorna nada pero si no ocurren errores significa exito
    $inserted = DistributionListDB::addEmail($email);

    # Redirige a la pagina de suscripcion exitosa
    header("Location: sus_exitosa.php");
    exit();
}
?>

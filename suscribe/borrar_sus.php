<?php
require_once("../util/main.php");
require_once("../model/validate.php");
require_once("../model/distributionListdb.php");

use validate as val;

# Este archivo procesa la cancelacion de la suscripcion
# Valida el correo recibido y lo elimina de la base de datos si existe

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

    # Verificar si el correo existe en la base de datos
    if (!DistributionListDB::emailExists($email)) {
        $error_message = "Este correo no esta suscrito";
        include("../errors/error.php");
        exit();
    }

    # Eliminar el correo de la lista de distribucion
    DistributionListDB::deleteEmail($email);

    # Redirige a la pagina de cancelacion exitosa
    header("Location: .?action=delete_exitosa");
    exit();
}
?>

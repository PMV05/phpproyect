<?php 
require_once("../util/main.php");
require_once("../model/validate.php");
require_once("../model/distributionListdb.php");

use validate as val;

$action = filter_input(INPUT_POST, 'action');

// Si no hay una accion entrada, mostrara el perfil por default
if (!isset($action)) {
    $action = filter_input(INPUT_GET, 'action');

    if (!isset($action)) {
        $action = "view_subscribe";
    }
}

switch ($action) {

    // Mostrar formulario de suscripciones
    case "view_subscribe":
        include("sus_form.php");
        break;

    // PROCESAR y mostrar pantalla exitosa
    case "suscripcion_exitosa":

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            # Recibe el correo desde el formulario
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
            $inserted = DistributionListDB::addEmail($email);
        }

        # Mostrar pantalla exitosa
        include("sus_exitosa.php");
        break;



    #Mostrar formulario para cancelar suscripción

    case "delete_email":
        include("borrar_form.php");
        break;


    // Procesar la eliminacion de emial
    case "procesar_delete":
        include("borrar_sus.php");
        break;



        //  Pantalla exitosa al eliminar
    case "delete_exitosa":
        include("eliminacion_exitosa.php");
        break;

    default:
        include("sus_form.php");
        break;
}
?>

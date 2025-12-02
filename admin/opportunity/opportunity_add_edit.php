<?php
session_start();

include("../../util/main.php");
include("../../view/header_admin.php");
require_once "../../model/db.php";
require_once "../../model/opportunity.php";
require_once "../../model/opportunity_db.php";

$db = Database::getDB();
$statement = $db->prepare("SELECT typeID, typeName FROM opportunities_type");
$statement->execute();
$opportunities_types = $statement->fetchAll();
$statement->closeCursor();

//test
if (!isset($_SESSION['userID'])) {

    $_SESSION['userID'] = 'admin';   
}
$ownerUserID = $_SESSION['userID'];

$error      = "";
$title      = trim($_POST["title"] ?? "");
$sponsor    = trim($_POST["sponsor"] ?? "");
$type       = intval($_POST["type"] ?? 0);
$deadline   = $_POST["deadline"] ?? "";
$url        = trim($_POST["url"] ?? "");
$description= trim($_POST["description"] ?? "");
$attachment = null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($title === "" || $description === "" || $type === 0) {
        $error = "Debe llenar el título, la descripción y seleccionar un tipo.";
    } else {

        $opportunity = new Opportunity(
            0,                                
            $title,
            $description,
            $sponsor,
            $url !== "" ? $url : "",
            $attachment !== "" ? $attachment : "",
            date("Y-m-d"),                    
            $deadline !== "" ? $deadline : null,
            $type,
            $ownerUserID,                     
            ""                                
        );

        OpportunityDB::addOpportunity($opportunity);

        header("Location: index.php");
        exit;
    }
}

include("opportunity_add_edit_view.php");

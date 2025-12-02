<?php

session_start();

include("../../util/main.php");

require_once "../../model/opportunity.php";
require_once "../../model/opportunity_db.php";

$action = filter_input(INPUT_POST, 'action');
if ($action === null || $action === '') {
    $action = filter_input(INPUT_GET, 'action');
}
if ($action === null || $action === '') {
    $action = 'list'; 
}

switch ($action) {

    case 'delete':

        $opportunityID = filter_input(INPUT_POST, 'opportunityID', FILTER_VALIDATE_INT);

        if ($opportunityID) {
            OpportunityDB::deleteOpportunity($opportunityID);
        }

 
        header("Location: index.php");
        exit;

    case 'add':
    case 'edit':
        include("opportunity_add_edit.php");
        break;

    case 'list':
    default:
        $opportunities = OpportunityDB::getAllOpportunities();
        include("index_view.php");
        break;
}

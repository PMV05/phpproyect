<?php
include("../../util/main.php");
include("../../model/opportunity.php");
include("../../model/opportunity_db.php");

$opportunities = OpportunityDB::getAllOpportunities();

if ($opportunities === null) {
    $opportunities = [];
} else if (!is_array($opportunities)) {
    $opportunities = [$opportunities];
}

include("index_view.php");  // <-- Nueva vista

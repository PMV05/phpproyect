
<?php

include("database.php");

class OpportunityDB {
    

    public static function getOpportunitiesByUserId($user_id) {
        $db = Database::getDB();
        $query = 'SELECT id, title, date_posted FROM opportunities WHERE user_id = :user_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $opportunities = $statement->fetchAll();
        $statement->closeCursor();
        return $opportunities;
    }

    public static function addOpportunity($user_id, $title, $description) {
        $db = Database::getDB();
        $query = 'INSERT INTO opportunities (user_id, title, description, date_posted)
                  VALUES (:user_id, :title, :description)';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function deleteOpportunity($opportunity_id) {
        $db = Database::getDB();
        $query = 'DELETE FROM opportunities 
                  WHERE id = :opportunity_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':opportunity_id', $opportunity_id);
        $statement->execute();
        $statement->closeCursor();
    }


    public static function updateOpportunity($opportunity_id, $title, $description) {
        $db = Database::getDB();
        $query = 'UPDATE opportunities 
                  SET title = :title, description = :description 
                  WHERE id = :opportunity_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':opportunity_id', $opportunity_id);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function getOpportunityById($opportunity_id) {
        $db = Database::getDB();
        $query = 'SELECT id, title, description, date_posted 
                  FROM opportunities 
                  WHERE id = :opportunity_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':opportunity_id', $opportunity_id);
        $statement->execute();
        $opportunity = $statement->fetch();
        $statement->closeCursor();
        return $opportunity;
    }

    public static function getAllOpportunities() {
            $db = Database::getDB();
            $query = 'SELECT id, title, description, date_posted 
                      FROM opportunities';
            $statement = $db->prepare($query);
            $statement->execute();
            $opportunities = $statement->fetchAll();
            $statement->closeCursor();
            return $opportunities;
        }

}
?>
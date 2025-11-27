<?php

require_once ('model/db.php');

class UserDB {


    public static function get_users() {
        $db = Database::getDB();

        $query = 'SELECT userID, email, password, role
                  FROM users
                  ORDER BY userID ASC';

        $statement = $db->prepare($query);
        $statement->execute();
        $users = $statement->fetchAll();
        $statement->closeCursor();

        return $users;
    }

    public static function get_user_by_id($userID) {
        $db = Database::getDB();

        $query = 'SELECT userID, email, password, role
                  FROM users
                  WHERE userID = :userID';

        $statement = $db->prepare($query);
        $statement->bindValue(':userID', $userID);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();

        return $user ?: null;
    }

    public static function get_user_by_email($email) {
        $db = Database::getDB();

        $query = 'SELECT userID, email, password, role
                  FROM users
                  WHERE email = :email';

        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();

        return $user ?: null;
    }

    public static function add_user($email, $password, $role) {
        $db = Database::getDB();

        $query = 'INSERT INTO users (email, password, role)
                  VALUES (:email, :password, :role)';

        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':role', $role);
        $statement->execute();

        $userID = $db->lastInsertId();
        $statement->closeCursor();

        return $userID;
    }

    public static function update_user($userID, $email, $password, $role) {
        $db = Database::getDB();

        $query = 'UPDATE users
                  SET email = :email,
                      password = :password,
                      role = :role
                  WHERE userID = :userID';

        $statement = $db->prepare($query);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':role', $role);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function delete_user($userID) {
        $db = Database::getDB();

        $query = 'DELETE FROM users
                  WHERE userID = :userID';

        $statement = $db->prepare($query);
        $statement->bindValue(':userID', $userID);
        $statement->execute();
        $statement->closeCursor();
    }
}

?>

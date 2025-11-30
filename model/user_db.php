<?php

require_once ('model/db.php');

class UserDB {

    # get_users()
    #
    # Devuelve todos los usuarios registrados en la base de datos
    # Retorna: un arreglo con los usuarios o un arreglo vacio si ocurre un error
    public static function get_users() {

        $query = 'SELECT userID, email, password, role
                  FROM users
                  ORDER BY userID ASC';

        try {
            $db = Database::getDB();

            $statement = $db->prepare($query);
            $statement->execute();
            $users = $statement->fetchAll();
            $statement->closeCursor();

            return $users;

        } catch (PDOException $e) {
            return [];
        }
    }

    # get_user_by_id()
    #
    # Devuelve la informacion de un usuario segun su ID
    # Recibe: el ID del usuario
    # Retorna: los datos del usuario o null si no existe o ocurre un error
    public static function get_user_by_id($userID) {

        $query = 'SELECT userID, email, password, role
                  FROM users
                  WHERE userID = :userID';

        try {
            $db = Database::getDB();

            $statement = $db->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $user = $statement->fetch();
            $statement->closeCursor();

            return $user ?: null;

        } catch (PDOException $e) {
            return null;
        }
    }

    # get_user_by_email()
    #
    # Obtiene un usuario utilizando su email
    # Recibe: el email del usuario
    # Retorna: los datos del usuario o null si no existe o ocurre un error
    public static function get_user_by_email($email) {

        $query = 'SELECT userID, email, password, role
                  FROM users
                  WHERE email = :email';

        try {
            $db = Database::getDB();

            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $user = $statement->fetch();
            $statement->closeCursor();

            return $user ?: null;

        } catch (PDOException $e) {
            return null;
        }
    }

    # add_user()
    #
    # Inserta un nuevo usuario en la base de datos
    # Recibe: email, password y role del usuario
    # Retorna: el ID creado o 0 si ocurre un error
    public static function add_user($email, $password, $role) {

        $query = 'INSERT INTO users (email, password, role)
                  VALUES (:email, :password, :role)';

        try {
            $db = Database::getDB();

            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':role', $role);
            $statement->execute();

            $userID = $db->lastInsertId();
            $statement->closeCursor();

            return $userID;

        } catch (PDOException $e) {
            return 0;
        }
    }

    # update_user()
    #
    # Actualiza la informacion de un usuario
    # Recibe: userID, email, password y role
    # Retorna: true si se actualizo, false si ocurrio un error
    public static function update_user($userID, $email, $password, $role) {

        $query = 'UPDATE users
                  SET email = :email,
                      password = :password,
                      role = :role
                  WHERE userID = :userID';

        try {
            $db = Database::getDB();

            $statement = $db->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':role', $role);
            $statement->execute();
            $statement->closeCursor();

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    # delete_user()
    #
    # Elimina un usuario segun su ID
    # Recibe: el ID del usuario
    # Retorna: true si se elimino o false si ocurrio un error
    public static function delete_user($userID) {

        $query = 'DELETE FROM users
                  WHERE userID = :userID';

        try {
            $db = Database::getDB();

            $statement = $db->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $statement->closeCursor();

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }
}

?>

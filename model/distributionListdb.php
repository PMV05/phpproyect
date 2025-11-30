<?php
require_once("db.php");

class DistributionListDB {

    # addEmail()
    #
    # ingresaun email dentro de la lista de distribucion
    # Recibe: el email a registrar
    public static function addEmail(string $email){
        $db = Database::getDB();
        $query = 'INSERT INTO distribution_list (email)
                  VALUES (:email)';
        
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {

            # Error al insertar email
            Database::displayError($e->getMessage());
        }
    }

    # emailExists()
    #
    # Verifica si un email ya esta registrado
    # Devuelve: true si existe, false si no existe
    public static function emailExists(string $email){
        $db = Database::getDB();
        $query = 'SELECT email
                  FROM distribution_list
                  WHERE email = :email';

        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $result = $statement->fetch();
            $statement->closeCursor();
    
            return $result !== false;
        } catch (PDOException $e) {

            # Error al verificar si existe el email
            Database::displayError($e->getMessage());
        }
    }

    # deleteEmail()
    #
    # Elimina un email de la lista 
    public static function deleteEmail(string $email){
        $db = Database::getDB();
        $query = 'DELETE FROM distribution_list
                  WHERE email = :email';

        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {

            # Error al eliminar email
            Database::displayError($e->getMessage());
        }
    }

    # getAllEmails()
    #
    # Devuelve todos los emails registrados en la lista
    public static function getAllEmails(){
        $db = Database::getDB();
        $query = 'SELECT email
                  FROM distribution_list';

        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            $statement->closeCursor();

            // Se crea una lista con todos los email de la base de datos
            $emails = [];
            foreach($rows as $row)
                $emails[] = $row['email'];
            
            return $emails;
        } catch (PDOException $e) {

            # Error al obtener emails
            Database::displayError($e->getMessage());
        }
    }

}
?>
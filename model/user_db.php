<?php
    // Clase que tendra los cruds para los usuarios
    require_once ('db.php');

    class UserDB {

        # getAllUsers()
        #
        # Devuelve todos los usuarios registrados en la base de datos
        # Retorna: lista de objetos tipo User con todos los usuarios
        public static function getAllUsers() {
            $db = Database::getDB();
            $query = 'SELECT *
                    FROM users u 
                    INNER JOIN roles r
                        ON u.userRole = r.roleID
                    ORDER BY userID ASC';

            try {
                $statement = $db->prepare($query);
                $statement->execute();
                $rows = $statement->fetchAll();
                $statement->closeCursor();

                // Añade en una lista de objeto tipo User todos
                // los usuarios que hay en la base de datos
                if($rows) {
                    $users = [];

                    foreach($rows as $row) {
                        $users[] = new User(
                            $row['userID'],
                            $row['email'],
                            $row['password'],
                            $row['userRole'],
                            $row['roleName']
                        );
                    }
                        
                    return $users;
                }

            } catch (PDOException $e) {
                Database::displayError($e->getMessage());
            }
        }

        # findUserID()
        #
        # Verifica si el id del usuario existe
        # Retorna: True si existe y False si no
        public static function findUserID($userID) {
            $db = Database::getDB();
            $query = 'SELECT userID
                    FROM users
                    WHERE userID = :userID';

            try {
                $statement = $db->prepare($query);
                $statement->bindValue(':userID', $userID);
                $statement->execute();
                $row = $statement->fetch();
                $statement->closeCursor();

                // Si el id existe devuelve True y false si no existe
                if($row) 
                    return True;
                else 
                    return False;
                
            } catch (PDOException $e) {
                Database::displayError($e->getMessage());
            }
        }

        # findEmail()
        #
        # Verifica si el email existe en la base de datos
        # Retorna: True si existe y False si no
        public static function findEmail($email) {
            $db = Database::getDB();
            $query = 'SELECT email
                    FROM users
                    WHERE email = :email';

            try {
                $statement = $db->prepare($query);
                $statement->bindValue(':email', $email);
                $statement->execute();
                $row = $statement->fetch();
                $statement->closeCursor();

                // Si el email existe devuelve True y false si no existe
                if($row) 
                    return True;
                else 
                    return False;
                
            } catch (PDOException $e) {
                Database::displayError($e->getMessage());
            }
        }

        # getUserById()
        #
        # Devuelve la informacion de un usuario segun su ID
        # Recibe: el ID del usuario
        # Retorna: los datos del usuario con un objeto o null si no existe o ocurre un error
        public static function getUserById($userID) {
            $db = Database::getDB();
            $query = 'SELECT *
                    FROM users u 
                    INNER JOIN roles r
                        ON u.userRole = r.roleID
                    WHERE userID = :userID';

            try {
                $statement = $db->prepare($query);
                $statement->bindValue(':userID', $userID);
                $statement->execute();

                $row = $statement->fetch();
                $statement->closeCursor();

                if($row) 
                    return new User(
                            $row['userID'],
                            $row['email'],
                            $row['password'],
                            $row['userRole'],
                            $row['roleName']
                        );
                else 
                    return null;


            } catch (PDOException $e) {
                Database::displayError($e->getMessage());
            }
        }

        # getUserByEmail()
        #
        # Obtiene un usuario utilizando su email
        # Recibe: el email del usuario
        # Retorna: los datos del usuario o null si no existe o ocurre un error
        public static function getUserByEmail($email) {
            $db = Database::getDB();
            $query = 'SELECT *
                    FROM users u 
                    INNER JOIN roles r
                        ON u.userRole = r.roleID
                    WHERE email = :email';

            try {
                $statement = $db->prepare($query);
                $statement->bindValue(':email', $email);
                $statement->execute();
                $row = $statement->fetch();
                $statement->closeCursor();

                if($row) 
                    return new User(
                            $row['userID'],
                            $row['email'],
                            $row['password'],
                            $row['userRole'],
                            $row['roleName']
                        );
                else 
                    return null;

            } catch (PDOException $e) {
                Database::displayError($e->getMessage());
            }
        }

        # addUser()
        #
        # Inserta un nuevo usuario en la base de datos
        # Recibe: un objeto tipo User
        # Retorna: el ID del usuario o un error
        public static function addUser($user) {
            $db = Database::getDB();
            $query = 'INSERT INTO users (userID, email, password, userRole)
                    VALUES (:userID, :email, :password, :role)';

            try {
                $statement = $db->prepare($query);
                $statement->bindValue(':userID', $user->getUserID());
                $statement->bindValue(':email', $user->getEmail());
                $statement->bindValue(':password', $user->getPassword());
                $statement->bindValue(':role', $user->getUserRole());
                $statement->execute();

                $userID = $user->getUserID();
                $statement->closeCursor();

                return $userID;

            } catch (PDOException $e) {
                Database::displayError($e->getMessage());
            }
        }

        # updateUser()
        #
        # Actualiza la informacion de un usuario
        # Recibe: un objeto de tipo User
        # Retorna: true si se actualizo, false si ocurrio un error
        public static function updateUser($user, $userID) {
            $db = Database::getDB();
            $query = 'UPDATE users
                    SET userID = :newUserID,
                        email = :email,
                        password = :password,
                        userRole = :role
                    WHERE userID = :userID';

            try {
                $statement = $db->prepare($query);
                $statement->bindValue(':userID', $userID);
                $statement->bindValue(':newUserID', $user->getUserID());
                $statement->bindValue(':email', $user->getEmail());
                $statement->bindValue(':password', $user->getPassword());
                $statement->bindValue(':role', $user->getUserRole());
                $statement->execute();

                $statement->closeCursor();

            } catch (PDOException $e) {
                Database::displayError($e->getMessage());
            }
        }

        # deleteUser()
        #
        # Elimina un usuario segun su ID
        # Recibe: el ID del usuario
        public static function deleteUser($userID) {
            $db = Database::getDB();
            $query = 'DELETE FROM users
                    WHERE userID = :userID';

            try {
                $statement = $db->prepare($query);
                $statement->bindValue(':userID', $userID);
                $statement->execute();
                $statement->closeCursor();

            } catch (PDOException $e) {
                Database::displayError($e->getMessage());
            }
        }
    }
?>

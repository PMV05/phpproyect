<?php
    require_once("db.php");

    class OpportunityDB {
        
        /*
            getOpportunitiesByUserId()

            Buscar todas las oportunidades que estan relacionadas a un usuario
            Parametros: id del usuario
            Devuelve: una lista de objetos de tipo Opportunity
        */
        public static function getOpportunitiesByUserId($userId) {
            $db = Database::getDB();
            $query = 'SELECT *
                      FROM opportunities o
                        INNER JOIN opportunities_type t
                            ON o.oppType = t.typeID
                      WHERE o.ownerUserID = :userId';
                      
            try {
                $statement = $db->prepare($query);
                $statement->bindValue(':userId', $userId);
                $statement->execute();
                $rows = $statement->fetchAll();
                $statement->closeCursor();

                // Añade en una lista de objeto tipo Opportunity todas 
                // las oportunidades que tiene el usuario
                if($rows) {
                    $opportunities = [];

                    foreach($rows as $row) 
                        $opportunities[] = new Opportunity($row['oppID'], $row['title'], $row['description'], $row['sponsor'], $row['url'],
                                                         $row['attachmentPath'], $row['datePosted'], $row['deadline'], $row['typeID'], $row['ownerUserID'], $row['typeName']);
                    
                    return $opportunities;
                }
                // Si el usuario no tiene ninguna oportunidad devuelve null
                else 
                    return null;

            } catch (PDOException $e) {
                Database::displayError($e->getMessage());
            }
        }

        /*
            addOpportunity()

            Añade una nueva oportunidad a la base de datos
            Parametros: objeto tipo Opportunity
            Devuelve: una lista de objetos de tipo Opportunity
        */
        public static function addOpportunity($opportunity) {
            $db = Database::getDB();
            $query = 'INSERT INTO opportunities 
                            (oppType, ownerUserID, title, description, 
                             sponsor, url, attachmentPath, deadline) 
                            
                    VALUES (:oppType, :ownerUserID, :title, :description, 
                            :sponsor, :url, :attachmentPath, :deadline)';
            
            try {
                $statement = $db->prepare($query);
                $statement->bindValue(':oppType', $opportunity->getType());
                $statement->bindValue(':ownerUserID', $opportunity->getAuthor());
                $statement->bindValue(':title', $opportunity->getTitle());
                $statement->bindValue(':description', $opportunity->getDescription());
                $statement->bindValue(':sponsor', $opportunity->getSponsor());
                $statement->bindValue(':url', $opportunity->getURL());
                $statement->bindValue(':attachmentPath', $opportunity->getAttachment());
                $statement->bindValue(':deadline', $opportunity->getDeadline());
                $statement->execute();

                $opportunityId = $db->lastInsertId();
                $statement->closeCursor();
                return $opportunityId;
            } catch(PDOException $e) {
                Database::displayError($e->getMessage());
            }
        }

        /*
            deleteOpportunity()

            Elimina una oportunidad en la base de datos
            Parametros: id de la oportunidad a eliminar
            Devuelve: una lista de objetos de tipo Opportunity
        */
        public static function deleteOpportunity($opportunityId) {
            $db = Database::getDB();
            $query = 'DELETE FROM opportunities 
                        WHERE oppID = :opportunityId';
            
            try {
                $statement = $db->prepare($query);
                $statement->bindValue(':opportunityId', $opportunityId);
                $statement->execute();
                $statement->closeCursor();
            } catch(PDOException $e) {
                Database::displayError($e->getMessage());
            }
        }

        /*
            updateOpportunity()

            Actualiza una oportunidad de la base de datos
            Parametros: id de la oportunidad a eliminar
            Devuelve: una lista de objetos de tipo Opportunity
        */
        public static function updateOpportunity($opportunity) {
            $db = Database::getDB();
            $query = 'UPDATE opportunities 
                      SET oppType = :oppType, 
                          title = :title, 
                          description = :description, 
                          sponsor = :sponsor, 
                          url = :url, 
                          attachmentPath = :attachmentPath, 
                          deadline = :deadline
                    WHERE oppID = :oppID';

            try {
                $statement = $db->prepare($query);
                $statement->bindValue(':oppID', $opportunity->getId());
                $statement->bindValue(':oppType', $opportunity->getType());
                $statement->bindValue(':title', $opportunity->getTitle());
                $statement->bindValue(':description', $opportunity->getDescription());
                $statement->bindValue(':sponsor', $opportunity->getSponsor());
                $statement->bindValue(':url', $opportunity->getURL());
                $statement->bindValue(':attachmentPath', $opportunity->getAttachment());
                $statement->bindValue(':deadline', $opportunity->getDeadline());
                $statement->execute();

                $statement->closeCursor();

            } catch(PDOException $e) {
                Database::displayError($e->getMessage());
            }
        }

        /*
            getOpportunityById()

            Busca una oportunidad en la base de datos por su id
            Parametros: id de la oportunidad
            Devuelve: objeto tipo Opportunity
        */
        public static function getOpportunityById($opportunityId){
            $db = Database::getDB();
            $query = 'SELECT *
                      FROM opportunities o
                        INNER JOIN opportunities_type t 
                            ON o.oppType = t.typeID
                      WHERE oppID = :opportunityId';

            try {
                $statement = $db->prepare($query);
                $statement->bindValue(':opportunityId', $opportunityId);
                $statement->execute();

                $row = $statement->fetch();
                $statement->closeCursor();

                if($row) 
                    return new Opportunity($row['oppID'], $row['title'], $row['description'], $row['sponsor'], $row['url'],
                                                         $row['attachmentPath'], $row['datePosted'], $row['deadline'], $row['typeID'], $row['ownerUserID'], $row['typeName']);
                
                else 
                    return null;

            } catch(PDOException $e) {
                Database::displayError($e->getMessage());
            }
        }

        /*
            getAllOpportunities()

            Busca todas las oportunidades de la base de datos
            Devuelve: lista de objetos tipo Opportunity
        */
        public static function getAllOpportunities() {
            $db = Database::getDB();
            $query = 'SELECT *
                      FROM opportunities o
                      INNER JOIN opportunities_type t
                        ON o.oppType = t.typeID
                      WHERE o.ownerUserID = :userId';
                      
            try {
                $statement = $db->prepare($query);
                $statement->bindValue(':user_id', $user_id);
                $statement->execute();
                $rows = $statement->fetchAll();
                $statement->closeCursor();

                // Añade en una lista de objeto tipo Opportunity todas 
                // las oportunidades que hay en la base de datos
                if($rows) {
                    $opportunities = [];

                    foreach($rows as $row) 
                        $opportunities = new Opportunity($row['oppID'], $row['title'], $row['description'], $row['sponsor'], $row['url'],
                                                         $row['attachmentPath'], $row['datePosted'], $row['deadline'], $row['typeID'], $row['userID'], $row['typeName']);
                    
                    return $opportunities;
                }
                // Si no hay oportunidades devuelve null
                else 
                    return null;

            } catch (PDOException $e) {
                Database::displayError($e->getMessage());
            }
        }

        /*
            getOpportunitiesType()

            Busca todos los tipos de oportunidades de la base de datos
            Devuelve: lista del los id junto con el nombre de cada tipo
        */
        public static function getOpportunitiesType() {
            $db = Database::getDB();
            $query = 'SELECT *
                      FROM opportunities_type';
                      
            try {
                $statement = $db->prepare($query);
                $statement->execute();
                $rows = $statement->fetchAll();
                $statement->closeCursor();

                $oppTypes = [];

                foreach ($rows as $row) {
                    $oppTypes[] = ['id' => $row['typeID'], 'name' => $row['typeName']];
                }
                return $oppTypes;

            } catch (PDOException $e) {
                Database::displayError($e->getMessage());
            }
        }

    }
?>
<?php

require_once ROOT . '/app/config.php';

class Database  {
    
    private static $db = null;
    
    /**
     * Créer une connexion à la base de données.
     * @return un objet PDO
     */
    public static function getInstance() {
        if (self :: $db == null){
            try {
                self :: $db = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
                self :: $db->setAttribute(PDO :: ATTR_CASE, PDO :: CASE_UPPER);
                self :: $db->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
                self :: $db->setAttribute(PDO :: ATTR_ORACLE_NULLS, PDO :: NULL_TO_STRING);
                self :: $db->exec('SET NAMES utf8');         
            }
            catch (PDOException $e) {
                echo 'Echec de la connexion : ' . $e->getMessage();
            }
        }
        return self :: $db;            
    }
}

$db = Database::getInstance();
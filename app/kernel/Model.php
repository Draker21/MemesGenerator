<?php

abstract class Model  {
	
    protected $_id;
    protected $_champs;
    protected $db;

	public function __construct($i_id, $isInt = true) {
		$this->_id = ($isInt) ? intval($i_id) : $i_id;
		$this->_champs = array();
        $this->db = Database::getInstance();
	}
	
    /**
     * Charge une instance de classe
     */
	abstract public function Load();
	
    /**
     * Supprime une instance de classe
     */
	abstract public function Delete();
	
    /**
     * Vérifie sur la suppresion est possible
     */
	abstract public function IsDeletable();

    /**
     * @return int l'identifiant de l'instance
	 */	
	public function getID() {
    	return $this->_id;
    }        
    
    /**
     * @return array la liste des champs
     */
    public function getFields() {
		if (count($this->_champs) == 0) {
        	$this->Load();
		}
        return $this->_champs;
	}
	
	/**
	 * @param string $field le champ souhaité
	 * @return string la valeur d'un champ
	 */
	public function getField($field) {
		if ((!$this->exist()) || (!isset ($this->_champs[$field]))) {
			die(__METHOD__ . " (Champ non défini pour l'objet '" . get_class($this) . "') : " . $field);
		}
		return $this->_champs[$field];
	}	

	/**
	 * @param array $row une liste de champ
	 * @param bool $append si la liste doit s'ajouter à  l'existant ou le remplacer
	 */
	public function setFields($row, $append = false) {
		if ($append) {
			$this->_champs = array_merge($this->_champs, $row);			
		}
		else {
			$this->_champs = $row;
		}
	}	
	
    /**
     * @return bool Si l'objet existe
     */
    public function Exist() {
        if (count($this->_champs) == 0) {
        	$this->Load();
        }
    	return ($this->getID() != -1);
    }	
}
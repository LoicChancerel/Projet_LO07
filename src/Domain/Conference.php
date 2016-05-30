<?php

namespace Projet_LO07\Domain;

class Conference {
    
    /**
    * Equipe id
    *
    * @var integer
    */
    private $id;
    
    /**
    * Equipe nom
    * 
    * @var string
    */
    private $nom;
    
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getName() {
        return $this->nom;
    }
    
    public function setName($name) {
        $this->nom = $name;
    }
}
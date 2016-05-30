<?php

namespace Projet_LO07\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    
    /**
    * User id
    *
    * @var integer
    */
    private $id;
    
    /**
    * User nom
    * 
    * @var string
    */
    private $nom;
    
    /**
    * User prenom
    *
    * @var string
    */
    private $prenom;
    
    /**
    * User Username
    *
    * @var string
    */
    private $username;
    
    /**
    * User password
    *
    * @var string
    */
    private $password;
    
    /**
    * User salt
    *
    * @var string
    */
    private $salt;
    
    /**
    * Role
    *
    * Value : ROLE_USER or ROLE_ADMIN
    */
    private $role;
    
    
    /**
    * User organisation
    *
    * @var Organisation
    */
    private $organisation;
    
    /**
    * User equipe
    *
    * @var Equipe
    */
    private $equipe;
    
    /**
    * User laboratoire
    *
    * @var Laboratoire
    */
    private $laboratoire;

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
    
    public function getFirstname() {
        return $this->prenom;
    }
    
    public function setFirstname($fn) {
        $this->prenom = $fn;
    }
    
    public function getUsername() {
        return $this->username;
    }
    
    public function setUsername($username) {
        $this->username = $username;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function getSalt() {
        return $this->salt;
    }
    
    public function setSalt($salt) {
        $this->salt = $salt;
    }
    
    public function getRole() {
        return $this->role;
    }
    
    public function setRole($role) {
        $this->role = $role;
    }
    
    public function getRoles() {
        return array($this->getRole());
    }
    
    public function getOrga() {
        return $this->organisation;
    }
    
    public function setOrga($orga) {
        $this->organisation = $orga;
    }
    
    public function getTeam() {
        return $this->equipe;
    }
    
    public function setTeam($team) {
        $this->equipe = $team;
    }
    
    public function getLab() {
        return $this->laboratoire;
    }
    
    public function setLab($lab) {
        $this->laboratoire = $lab;
    }
    
    public function eraseCredentials() {
        
    }
}
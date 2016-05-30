<?php

namespace Projet_LO07\Domain;

class Article {
    
    /**
    * Article id
    *
    * @var integer
    */
    private $id;
    
    /**
    * Article titre
    * 
    * @var string
    */
    private $titre;
    
    /**
    * Article statut
    *
    * @var integer
    */
    private $statut;
    
    /**
    * Article text
    *
    * @var string
    */
    private $text;
    
    /**
    * Article annee
    *
    * @var integer
    */
    private $annee;
    
    /**
    * Article conference
    *
    * @var conference
    */
    private $conference;
    
    /**
    * Article categorie
    *
    * @var categorie
    */
    private $categorie;

    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getTitle() {
        return $this->titre;
    }
    
    public function setTitle($titre) {
        $this->titre = $titre;
    }
    
    public function getStatut() {
        return $this->statut;
    }
    
    public function setStatut($statut) {
        $this->statut = $statut;
    }
    
    public function getText() {
        return $this->texte;
    }
    
    public function setText($texte) {
        $this->texte = $texte;
    }
    
    public function getAnnee() {
        return $this->annee;
    }
    
    public function setAnnee($annee) {
        $this->annee = $annee;
    }
    
    public function getConf() {
        return $this->conference;
    }
    
    public function setConf($conf) {
        $this->conference = $conf;
    }
    
    public function getCat() {
        return $this->categorie;
    }
    
    public function setCat($cat) {
        $this->categorie = $cat;
    }
}
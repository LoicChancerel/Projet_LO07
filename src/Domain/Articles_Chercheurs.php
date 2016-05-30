<?php

namespace Projet_LO07\Domain;

class Articles_Users {
    
    /**
    * Articles_Users id
    *
    * @var integer
    */
    private $id;
    
    /**
    * Articles_Users Article
    * 
    * @var Article
    */
    private $article;
    
    /**
    * Articles_Users User
    *
    * @var User
    */
    private $user;
    
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getUser() {
        return $this->user;
    }
    
    public function setUser($user) {
        $this->user = $user;
    }
    
    public function getArticle() {
        return $this->article;
    }
    
    public function setArticle($article) {
        $this->label = $article;
    }
}
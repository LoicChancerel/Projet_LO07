<?php

namespace Projet_LO07\DAO;

use Doctrine\DBAL\Connection;
use Projet_LO07\Domain\Article;


class ArticleDAO extends DAO
{
    
    /**
    *@var \Projet_LO07\DAO\ConferenceDAO
    */
    private $conferenceDAO;
    
    /**
    *@var Projet_LO07\DAO\CategorieDAO
    */
    private $categorieDAO;
    
    public function setConferenceDAO(ConferenceDAO $conferenceDAO) {
        $this->conferenceDAO = $conferenceDAO;
    }
    
    public function setCategorieDAO(CategorieDAO $categorieDAO) {
        $this->categorieDAO = $categorieDAO;
    }
    
    /**
     * Return a list of all articles, sorted by date (most recent first).
     *
     * @return array A list of all articles.
     */
    public function findAll() {
        $sql = "select * from articles";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $articles = array();
        foreach ($result as $row) {
            $articleId = $row['id_articles'];
            $articles[$articleId] = $this->buildDomainObject($row);
        }
        return $articles;
    }
    
     public function find($id) {
        $sql = "select * from articles where id_articles = ".$id;
        $result = $this->getDB()->fetchAll($sql);
        
        $article = $this->buildDomainObject($result[0]);
        return $article;
    }
    
    
    

    /**
     * Creates an Article object based on a getDb() row.
     *
     * @param array $row The getDb() row containing Article data.
     * @return \MicroCMS\Domain\Article
     */
    protected function buildDomainObject($row) {
        $article = new Article();
        $article->setId($row['id_articles']);
        $article->setTitle($row['titre']);
        $article->setText($row['texte']);
        $article->setStatut($row['statut']);
        $article->setAnnee($row['annee']);
        if(isset($row['id_conference'])) {
            $article->setConf($this->conferenceDAO->find($row['id_conference']));   
        }
        if(isset($row['id_categorie'])) {
            $article->setCat($this->categorieDAO->find($row['id_categorie']));    
        }
        
        return $article;
    }
}
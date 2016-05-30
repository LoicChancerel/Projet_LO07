<?php

namespace Projet_LO07\DAO;

use Doctrine\DBAL\Connection;
use Projet_LO07\Domain\Articles_Users;

class Articles_UsersDAO extends DAO
{
    /**
    * @var \Projet_LO07\DAO\ArticleDAO
    */
    private $articleDAO;
    
    /**
    * @var \Projet_LO07\DAO\UserDAO
    */
    private $userDAO;
    
    public function setArticleDAO($articleDAO) {
        $this->articleDAO = $articleDAO;
    }
    
    public function setUserDAO($userDAO) {
        $this->userDAO = $userDAO;
    }
     
    /**
     * Return a list of all articles_userss, sorted by date (most recent first).
     *
     * @return array A list of all articles_userss.
     */
    public function findAll() {
        $sql = "select * from articles_users";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $articles_users = array();
        foreach ($result as $row) {
            $articles_usersId = $row['id'];
            $articles_userss[$articles_usersId] = $this->buildDomainObject($row);
        }
        return $articles_userss;
    }
    
    /**
    * Return one articles_users, with the id past in parameters
    *
    * @return articles_users
    */
    public function find($id) {
        $sql = "select * from articles_users where id = ".$id;
        $result = $this->getDb()->fetchAll($sql);
        
        $articles_users = $this->buildDomainObject($result[0]);
        return $articles_users;
    }
    
    public function findUsers($id_article) {
        $users = array();
        $sql = "select * from articles_users where id_article =".$id_article;
        $result = $this->getDb()->fetchAll($sql);
        foreach($result as $row) {
            $userId = $row['id_user'];
            $users[$userId] = $this->userDAO->find($userId);
        }
        return $users;
    }
    
    public function findArticles($id_user) {
        $articles = array();
        $sql = "select * from articles_users where id_user =".$id_user;
        $result = $this->getDb()->fetchAll($sql);
        foreach($result as $row) {
            $articleId = $row['id_article'];
            $articles[$articleId] = $this->articleDAO->find($articleId);
        }
        return $articles;
    }

    /**
     * Creates an articles_users object based on a DB row.
     *
     * @param array $row The DB row containing articles_users data.
     * @return \MicroCMS\Domain\articles_users
     */
    protected function buildDomainObject($row) {
        $articles_users = new articles_users();
        $articles_users->setId($row['id']);
        $articles_users->setArticle($this->articleDAO->find($row['id_article']));
        $articles_users->setUser($this->userDAO->find($row['id_user']));
        return $articles_users;
    }
}
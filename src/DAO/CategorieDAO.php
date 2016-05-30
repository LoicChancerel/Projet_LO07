<?php

namespace Projet_LO07\DAO;

use Doctrine\DBAL\Connection;
use Projet_LO07\Domain\Categorie;

class CategorieDAO extends DAO
{
    /**
     * Return a list of all categories, sorted by date (most recent first).
     *
     * @return array A list of all categories.
     */
    public function findAll() {
        $sql = "select * from categories";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $categories = array();
        foreach ($result as $row) {
            $categorieId = $row['id_categorie'];
            $categories[$categorieId] = $this->buildDomainObject($row);
        }
        return $categories;
    }
    
    /**
    * Return one categorie, with the id past in parameters
    *
    * @return categorie
    */
    public function find($id) {
        $sql = "select * from categories where id_categorie = ".$id;
        $result = $this->getDb()->fetchAll($sql);
        
        $categorie = $this->buildDomainObject($result[0]);
        return $categorie;
    }

    /**
     * Creates an categorie object based on a DB row.
     *
     * @param array $row The DB row containing categorie data.
     * @return \MicroCMS\Domain\categorie
     */
    protected function buildDomainObject($row) {
        $categorie = new categorie();
        $categorie->setId($row['id_categorie']);
        $categorie->setName($row['nom_categorie']);
        $categorie->setLabel($row['label_categorie']);
        return $categorie;
    }
}
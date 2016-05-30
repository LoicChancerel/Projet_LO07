<?php

namespace Projet_LO07\DAO;

use Doctrine\DBAL\Connection;
use Projet_LO07\Domain\Equipe;

class EquipeDAO extends DAO
{
    /**
     * Return a list of all Equipes, sorted by date (most recent first).
     *
     * @return array A list of all Equipes.
     */
    public function findAll() {
        $sql = "select * from Equipes";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $equipes = array();
        foreach ($result as $row) {
            $equipeId = $row['id_equipe'];
            $equipes[$equipeId] = $this->buildDomainObject($row);
        }
        return $equipes;
    }
    
    /**
    * Return one Equipe, with the id past in parameters
    *
    * @return Equipe
    */
    public function find($id) {
        $sql = "select * from Equipes where id_equipe = ".$id;
        $result = $this->getDb()->fetchAll($sql);
        
        $equipe = $this->buildDomainObject($result[0]);
        return $equipe;
    }

    /**
     * Creates an Equipe object based on a DB row.
     *
     * @param array $row The DB row containing Equipe data.
     * @return \MicroCMS\Domain\Equipe
     */
    protected function buildDomainObject($row) {
        $equipe = new Equipe();
        $equipe->setId($row['id_equipe']);
        $equipe->setName($row['nom_equipe']);
        $equipe->setLabel($row['label_equipe']);
        return $equipe;
    }
}
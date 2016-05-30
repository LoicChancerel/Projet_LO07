<?php

namespace Projet_LO07\DAO;

use Doctrine\DBAL\Connection;
use Projet_LO07\Domain\Laboratoire;

class LaboratoireDAO
{
    /**
     * Return a list of all Laboratoires, sorted by date (most recent first).
     *
     * @return array A list of all Laboratoires.
     */
    public function findAll() {
        $sql = "select * from laboratoires";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $Laboratoires = array();
        foreach ($result as $row) {
            $laboratoireId = $row['id_laboratoire'];
            $laboratoires[$laboratoireId] = $this->buildDomainObject($row);
        }
        return $laboratoires;
    }
    
    /**
    * Return one Laboratoire, with the id past in parameters
    *
    * @return Laboratoire
    */
    public function find($id) {
        $sql = "select * from laboratoires where id_laboratoire = ".$id;
        $result = $this->getDb()->fetchAll($sql);
        
        $laboratoire = $this->buildDomainObject($result[0]);
        return $laboratoire;
    }

    /**
     * Creates an Laboratoire object based on a DB row.
     *
     * @param array $row The DB row containing Laboratoire data.
     * @return \MicroCMS\Domain\Laboratoire
     */
    protected function buildDomainObject(array $row) {
        $laboratoire = new Laboratoire();
        $laboratoire->setId($row['id_laboratoire']);
        $laboratoire->setName($row['nom_laboratoire']);
        $laboratoire->setLabel($row['label_laboratoire']);
        return $laboratoire;
    }
}
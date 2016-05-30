<?php

namespace Projet_LO07\DAO;

use Doctrine\DBAL\Connection;
use Projet_LO07\Domain\Organisation;

class OrganisationDAO
{
    /**
     * Return a list of all organisations, sorted by date (most recent first).
     *
     * @return array A list of all organisations.
     */
    public function findAll() {
        $sql = "select * from organisations";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $organisations = array();
        foreach ($result as $row) {
            $organisationId = $row['id_organisation'];
            $organisations[$organisationId] = $this->buildDomainObject($row);
        }
        return $organisations;
    }
    
    /**
    * Return one organisation, with the id past in parameters
    *
    * @return organisation
    */
    public function find($id) {
        $sql = "select * from organisations where id_organisation = ".$id;
        $result = $this->getDb()->fetchAll($sql);
        
        $organisation = $this->buildDomainObject($result[0]);
        return $organisation;
    }

    /**
     * Creates an organisation object based on a DB row.
     *
     * @param array $row The DB row containing organisation data.
     * @return \MicroCMS\Domain\organisation
     */
    protected function buildDomainObject(array $row) {
        $organisation = new organisation();
        $organisation->setId($row['id_organisation']);
        $organisation->setName($row['nom_organisation']);
        $organisation->setLabel($row['label_organisation']);
        return $organisation;
    }
}
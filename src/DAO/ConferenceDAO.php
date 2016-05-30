<?php

namespace Projet_LO07\DAO;

use Doctrine\DBAL\Connection;
use Projet_LO07\Domain\Conference;

class ConferenceDAO extends DAO
{
    /**
     * Return a list of all conferences, sorted by date (most recent first).
     *
     * @return array A list of all conferences.
     */
    public function findAll() {
        $sql = "select * from conferences";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $conferences = array();
        foreach ($result as $row) {
            $conferenceId = $row['id_conference'];
            $conferences[$conferenceId] = $this->buildDomainObject($row);
        }
        return $conferences;
    }
    
    /**
    * Return one conference, with the id past in parameters
    *
    * @return conference
    */
    public function find($id) {
        $sql = "select * from conferences where id_conference = ".$id;
        $result = $this->getDb()->fetchAll($sql);
        
        $conference = $this->buildDomainObject($result[0]);
        return $conference;
    }

    /**
     * Creates an conference object based on a DB row.
     *
     * @param array $row The DB row containing conference data.
     * @return \MicroCMS\Domain\conference
     */
    protected function buildDomainObject($row) {
        $conference = new conference();
        $conference->setId($row['id_conference']);
        $conference->setName($row['nom_conference']);
        return $conference;
    }
}
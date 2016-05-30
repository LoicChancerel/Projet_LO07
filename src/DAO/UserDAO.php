<?php

namespace Projet_LO07\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Projet_LO07\Domain\User;

class UserDAO extends DAO implements UserProviderInterface
{
    /**
    * @var \Projet_LO7\DAO\EquipeDAO
    */
    private $equipeDAO;
    
    /**
    * @var \Projet_LO07\DAO\OrganisationDAO
    */
    private $orgaDAO;
    
    /**
    * @var \Projet_LO07\DAO\LaboratoireDAO
    */
    private $laboDAO;
    
    public function setEquipeDAO($equipeDAO) {
        $this->equipeDAO = $equipeDAO;
    }
    
    public function setOrgaDAO($orgaDAO) {
        $this->orgaDAO = $orgaDAO;
    }
    
    public function setLaboDAO($laboDAO) {
        $this->laboDAO = $laboDAO;
    }
    
    /**
     * Return a list of all Users, sorted by date (most recent first).
     *
     * @return array A list of all Users.
     */
    public function findAll() {
        $sql = "select * from users";
        $result = $this->db->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $users = array();
        foreach ($result as $row) {
            $userId = $row['id_users'];
            $users[$UserId] = $this->buildDomainObject($row);
        }
        return $users;
    }
    
       /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $sql = "select * from users where `username`=?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'Projet_LO07\Domain\User' === $class;
    }
    
    /**
    * Return one user, with the id past in parameters
    *
    * @return User
    */
    public function find($id) {
        $sql = "select * from users where id_user = ".$id;
        $result = $this->getDb()->fetchAll($sql);
        
        $user = $this->buildDomainObject($result[0]);
        return $user;
    }

    /**
     * Creates an User object based on a DB row.
     *
     * @param array $row The DB row containing User data.
     * @return \MicroCMS\Domain\User
     */
    protected function buildDomainObject($row) {
        $user = new User();
        $user->setId($row['id_user']);
        $user->setName($row['nom']);
        $user->setFirstname($row['prenom']);
        $user->setUsername($row['username']);
        $user->setPassword($row['password']);
        $user->setSalt($row['salt']);
        $user->setRole($row['role']);
        if(isset($row['id_orga'])) {
            $user->setOrga($this->orgaDAO->find($row['id_orga']));
        }
        if(isset($row['id_equipe'])) {
            $user->setTeam($this->equipeDAO->find($row['id_equipe']));
        }
        if(isset($row['id_lab'])) {
            $user->setLabo($this->laboDAO->find($row['id_lab']));
        }
        return $user;
    }
}
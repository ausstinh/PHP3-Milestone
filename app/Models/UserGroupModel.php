<?php
namespace App\Models;

class UserGroupModel
{
    private $id;
    private $users_id;
    private $groups_id;
    private $username;
    private $role;
    
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsers_id()
    {
        return $this->users_id;
    }

    /**
     * @return mixed
     */
    public function getGroups_id()
    {
        return $this->groups_id;
    }

  
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $users_id
     */
    public function setUsers_id($users_id)
    {
        $this->users_id = $users_id;
    }

    /**
     * @param mixed $groups_id
     */
    public function setGroups_id($groups_id)
    {
        $this->groups_id = $groups_id;
    }
    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }
    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }
    
    
    public function __construct($id, $username, $role, $users_id, $groups_id)
    {
        $this->id = $id;
        $this->username = $username;
        $this->role = $role;
        $this->users_id = $users_id;
        $this->groups_id = $groups_id;
    }
    
    
}


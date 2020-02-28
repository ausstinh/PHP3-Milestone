<?php
namespace App\Models;
class CredentialsModel{
    
    private $users_id;
    private $password;
    private $email;

    
    public function __construct($users_id, $email, $password)
    {
        $this->$users_id = $users_id;
        $this->password = $password;
        $this->email = $email;
 
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    
    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
 
    
    
}
?>
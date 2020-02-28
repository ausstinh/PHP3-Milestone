<?php
namespace App\Models;

class JobPostingModel
{
    private $id;
    private $name;
    private $description;
    private $salary;
    private $location;
    private $company_id;
   
    public function __construct($id, $name, $description, $salary, $location, $company_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->salary = $salary;
        $this->location = $location;
        $this->company_id = $company_id;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return mixed
     */
    public function getCompany_id()
    {
        return $this->company_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $salary
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @param mixed $company_id
     */
    public function setCompany_id($company_id)
    {
        $this->company_id = $company_id;
    }

    
    
    
}


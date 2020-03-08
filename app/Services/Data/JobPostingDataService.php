<?php
namespace App\Services\Data;

use App\Interfaces\Data\JobPostingDataInterface;
use App\Models\JobPostingModel;
use Exception;
use PDO;

class JobPostingDataService implements JobPostingDataInterface
{
    private $db = NULL;
    
    // BEST practice: Do not create Database Connections in a
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    public function read($id)
    {
        try{
        // select statement to search through database using ID passed in
        $stmt = $this->db->prepare("SELECT * FROM JOBS WHERE id = :id");
        // variable to store sql statment and connection to database
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $jobInfo = null;
        
        // while loop to continue to fetch information until no more information can be fetched
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $jobInfo = new JobPostingModel($id, $row['NAME'], $row['DESCRIPTION'], $row['SALARY'], $row['LOCATION'], $row['COMPANY_ID']);
        }
        // return job
        return $jobInfo;
    }catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }
    
    public function create($job)
    {
        try{
        $name = $job->getName();
        $desc = $job->getDescription();
        $ln = $job->getLocation();
        $salary = $job->getSalary();
        $company = "Company";
        $stmt = $this->db->prepare("INSERT INTO COMPANY (COMPANY) VALUES (:cy)");
        $stmt->bindParam(':cy', $company);
        $stmt->execute();
        // if number of affected rows within the database is greater than 0, meaning user got successfully entered
        if ($stmt->rowCount() == 1) {
        $stmt = $this->db->prepare("INSERT INTO JOBS (NAME, DESCRIPTION, SALARY, LOCATION, COMPANY_ID) VALUES (:nm, :desc, :sc, :ln, LAST_INSERT_ID())");
        
       
        $stmt->bindParam(':nm', $name);
        $stmt->bindParam(':ln', $ln);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':sc', $salary);

        
        $stmt->execute();
        // if number of affected rows within the database is greater than 0, meaning user got successfully entered
        if ($stmt->rowCount() == 1) {
            // return true
            return true;
        } // else return false
        else 
            return false;
        
        }
        else {
            return false;
        }
    }catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }
    
    public function update($job)
    {
        try{
        // variables to retrieve new information from $job
        $id = $job->getId();
        $name = $job->getName();
        $desc = $job->getDescription();
        $ln = $job->getLocation();
        $salary = $job->getSalary();
       
        // Select sql statement to look through database using job entered information
        $stmt = $this->db->prepare("UPDATE `JOBS` SET `NAME`= :nm, `DESCRIPTION`= :desc, `SALARY`= :sc, `LOCATION`= :ln WHERE id= :id Limit 1");
        
        $stmt->bindParam(':nm', $name);
        $stmt->bindParam(':ln', $ln);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':sc', $salary);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        // if result has information
        if ($stmt->rowCount() == 1) {
            // create new job with updated information
            $jobInfo = new JobPostingModel($id, $name, $desc, $salary, $ln, $job->getCompany_id());
        }
        else {
            return null;
        }
        // return job
        return $jobInfo;
        } catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }
    
    public function delete($id)
    {
        try{
        // Delete statement where user ID is ID passed in
        $stmt = $this->db->prepare("DELETE FROM `JOBS` WHERE `JOBS`.`id` = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        // if result == 1
        if ($stmt->rowCount() == 1)
            return true;
            
            // if result vaiable doesn't find user with entered credentials
            else
                return false;
        }   catch (Exception $e2) {
                    // display our Global Exception Handler page
                    return view("error");
                }
    }
    
    public function readall()
    {
        try{
        // read all from jobs table
        $stmt = $this->db->prepare("SELECT * FROM JOBS");
        // variable to store sql statment and connection to database
        $stmt->execute();
        
        // create new education array
        $job_array = array();
        $profileInfo = null;
        // while loop to continue to fetch information until no more information can be fetched
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            // create new user with found ID
            $profileInfo = new JobPostingModel($row['id'], $row['NAME'], $row['DESCRIPTION'], $row['SALARY'], $row['LOCATION'], $row['COMPANY_ID']);
            array_push($job_array, $profileInfo);
        }
        // return jobs
        return $job_array;
        }catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }
    
    
}
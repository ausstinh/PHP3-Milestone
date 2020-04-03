<?php
namespace App\Services\Data;

use App\Interfaces\Data\JobPostingDataInterface;
use App\Models\JobPostingModel;
use App\Services\Utility\MyLogger2;
use Exception;
use PDO;
use App\Services\Utility\MyLogger3;

class JobPostingDataService implements JobPostingDataInterface
{
    private $db = NULL;
    
    // BEST practice: Do not create Database Connections in a
    public function __construct($db)
    {
        $this->db = $db;
    }
    /*
     * Refer to JobPostingDataInterface
     */
    public function read($job_result)
    {
        MyLogger3::info("Entering JobPostingDataService.read()");
       try{
        // select statement to search through database using ID passed in
        $stmt = $this->db->prepare("SELECT * FROM JOBS WHERE id = :id");
        // variable to store sql statment and connection to database
        $stmt->bindParam(':id', $job_result);
        $stmt->execute();
        
        $jobInfo = null;
        
        // while loop to continue to fetch information until no more information can be fetched
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $jobInfo = new JobPostingModel($job_result, $row['NAME'], $row['DESCRIPTION'], $row['SALARY'], $row['LOCATION'], $row['COMPANY_ID']);
        }
        else
        {
            $stmt = $this->db->prepare("SELECT * FROM JOBS WHERE NAME = :search OR DESCRIPTION = :search OR LOCATION = :search");
            $stmt->bindParam(':search', $job_result);
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
            MyLogger3::info("Exiting JobPostingDataService.read() with job array passed");
            return $job_array;
        }
        // return job
        MyLogger3::info("Exiting JobPostingDataService.read() with job passed");
        return $jobInfo;
   }catch (Exception $e2) {
       MyLogger3::info("Exiting JobPostingDataService.read() with job failed");
           // display our Global Exception Handler page
           return view("error");
       }
    }
    /*
     * Refer to JobPostingDataInterface
     */
    public function create($job)
    {
        MyLogger3::info("Entering JobPostingDataService.create()");
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
            MyLogger3::info("Exiting JobPostingDataService.create() with job passed");
            // return true
            return true;
        } // else return false
        else {
            MyLogger3::info("Exiting JobPostingDataService.create() with job failed");
            return false;
        }
        
        }
        else {
            return false;
        }
    }catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }
    /*
     * Refer to JobPostingDataInterface
     */
    public function update($job)
    {
        MyLogger3::info("Entering JobPostingDataService.update()");
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
            MyLogger3::info("Exiting JobPostingDataService.update() with job failed");
            return null;
        }
        // return job
        MyLogger3::info("Exiting JobPostingDataService.update() with job passed");
        return $jobInfo;
        } catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }
    /*
     * Refer to JobPostingDataInterface
     */
    public function delete($id)
    {
        MyLogger3::info("Entering JobPostingDataService.delete()");
        try{
        // Delete statement where user ID is ID passed in
        $stmt = $this->db->prepare("DELETE FROM `JOBS` WHERE `JOBS`.`id` = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        // if result == 1
        if ($stmt->rowCount() == 1){
            MyLogger3::info("Exiting JobPostingDataService.delete() with job passed");
            return true;
        }
            // if result vaiable doesn't find user with entered credentials
        else{
            MyLogger3::info("Exiting JobPostingDataService.delete() with job failed");
                return false;
        }
        }   catch (Exception $e2) {
                    // display our Global Exception Handler page
                    return view("error");
                }
    }
    /*
     * Refer to JobPostingDataInterface
     */
    public function readall()
    {
        MyLogger3::info("Entering JobPostingDataService.readall()");
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
        MyLogger3::info("Exiting JobPostingDataService.readall() with job array passed");
        return $job_array;
        }catch (Exception $e2) {
            // display our Global Exception Handler page
           return view("error");
       }
    }
    
    
}
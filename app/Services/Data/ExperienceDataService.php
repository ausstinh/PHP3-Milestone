<?php
namespace App\Services\Data;

use App\Interfaces\Data\ProfileDataInterface;
use App\Models\ExperienceModel;
use Exception;
use PDO;


class ExperienceDataService implements ProfileDataInterface
{

    private $db = NULL;

    // BEST practice: Do not create Database Connections in a
    public function __construct($db)
    {
        $this->db = $db;
    }
    /*
     * Refer to ExperienceDataInterface
     */
    public function create($experience)
    {
        try{
        $users_id = $experience->getUsers_id();
        $ed = $experience->getEndDate();
        $sd = $experience->getStartDate();
        $title = $experience->getTitle();
        $location = $experience->getLocation();
        $desc = $experience->getDescription();
        $company = $experience->getCompany();
        $stmt = $this->db->prepare("INSERT INTO EXPERIENCE (COMPANY, DESCRIPTION, LOCATION, TITLE, STARTDATE, ENDDATE, USERS_ID) VALUES (:cm, :desc, :ln, :tt, :sd, :ed, :ui)");
      
        $stmt->bindParam(':ui', $users_id);
        $stmt->bindParam(':cm', $company);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':ln', $location);
        $stmt->bindParam(':tt', $title);
        $stmt->bindParam(':sd', $sd);
        $stmt->bindParam(':ed', $ed);
        
        $stmt->execute();
        // if number of affected rows within the database is greater than 0, meaning user got successfully entered
        if ($stmt->rowCount() == 1) {
            // return true
            return true;
        } // else return false
        else {
            return false;
        }
        }catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }
    /*
     * Refer to ExperienceDataInterface
     */
    public function read($id)
    {  
      
        try{
        // select statement to search through database using ID passed in
        $stmt = $this->db->prepare("SELECT * FROM EXPERIENCE WHERE id = :id LIMIT 1");
        // variable to store sql statment and connection to database
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // create new user with found ID
            $profileInfo = new ExperienceModel($id, $row['COMPANY'], $row['DESCRIPTION'], $row['LOCATION'], $row['TITLE'], $row['STARTDATE'], $row['ENDDATE'], $row['USERS_ID']);
            
        }
        // return user
        return $profileInfo;
        }catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }

   
     /*
     * Refer to ExperienceDataInterface
     */
    public function update($experience)
    {
        try{
        // variables to retrieve new information from $user
        $id = $experience->getId();
        $exCompany = $experience->getCompany();
        $exDesc = $experience->getDescription();
        $exLocation = $experience->getLocation();
        $exTitle = $experience->getTitle();
        $exStartDate = $experience->getStartDate();
        $exEndDate = $experience->getEndDate();

        // Select sql statement to look through database using user entered information
        $stmt = $this->db->prepare("UPDATE `EXPERIENCE` SET `COMPANY`= :cm, `DESCRIPTION`= :ds, `LOCATION` = :ln, `TITLE` = :tt, `STARTDATE` = :sd, `ENDDATE` = :ed WHERE id = :id Limit 1");

        $stmt->bindParam(':cm', $exCompany);
        $stmt->bindParam(':ds', $exDesc);
        $stmt->bindParam(':ln', $exLocation);
        $stmt->bindParam(':tt', $exTitle);
        $stmt->bindParam(':sd', $exStartDate);
        $stmt->bindParam(':ed', $exEndDate);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
          
        // if result has information
        if ($stmt->rowCount() == 1) {
            // create new user with updated information
            $newExperience = new ExperienceModel($id, $exCompany, $exDesc, $exLocation, $exTitle, $exStartDate, $exEndDate, $experience->getUsers_id());
        } else {
            return null;
        }
        // return user
        return $newExperience;
    }catch (Exception $e2) {
        // display our Global Exception Handler page
        return view("error");
    }
    }
    /*
     * Refer to ExperienceDataInterface
     */
    public function delete($id)
    {
        try{
        // Delete statement where user ID is ID passed in
        $stmt = $this->db->prepare("DELETE FROM `EXPERIENCE` WHERE `EXPERIENCE`.`id` = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        // if result == 1
        if ($stmt->rowCount() == 1)
            return true;
            
            // if result vaiable doesn't find user with entered credentials
            else
            return false;
    }catch (Exception $e2) {
        // display our Global Exception Handler page
        return view("error");
    }
    }
    /*
     * Refer to ExperienceDataInterface
     */
    public function readall($users_id)
    {
        try{
        // select statement to search through database using ID passed in
        $stmt = $this->db->prepare("SELECT * FROM EXPERIENCE WHERE USERS_ID = :users_id");
        // variable to store sql statment and connection to database
        $stmt->bindParam(':users_id', $users_id);
        $stmt->execute();
        
        // create new education array
        $experience_array = array();
        $profileInfo = null;
        // while loop to continue to fetch information until no more information can be fetched
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            // create new user with found ID
            $profileInfo = new ExperienceModel($row['id'], $row['COMPANY'], $row['DESCRIPTION'], $row['LOCATION'], $row['TITLE'], $row['STARTDATE'], $row['ENDDATE'], $users_id);
            array_push($experience_array, $profileInfo);
        }
        // return user
        return $experience_array;
    }catch (Exception $e2) {
        // display our Global Exception Handler page
        return view("error");
    }
    }



   
}

?>
<?php
namespace App\Services\Data;

use App\Interfaces\Data\ProfileDataInterface;
use Exception;
use PDO;
use App\Models\EducationModel;
use App\Services\Utility\MyLogger2;


class EducationDataService implements ProfileDataInterface
{

    private $db = NULL;

    // BEST practice: Do not create Database Connections in a
    public function __construct($db)
    {
        $this->db = $db;
    }
    /*
     * Refer to EducationDataInterface
     */
    public function create($education)
    {
        MyLogger2::info("Entering EducationDataService.create()");
        try{
        $school = $education->getSchool();
        $desc = $education->getDescription();
        $ui = $education->getUsers_id();
        $stmt = $this->db->prepare("INSERT INTO EDUCATION (SCHOOL, DESCRIPTION, USERS_ID) VALUES (:sc, :desc, :ui)");
        
        $stmt->bindParam(':ui', $ui);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':sc', $school);
        
        $stmt->execute();
        // if number of affected rows within the database is greater than 0, meaning user got successfully entered
        if ($stmt->rowCount() == 1) {
            // return true
            MyLogger2::info("Exiting EducationDataService.create()");
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
     * Refer to EducationDataInterface
     */
    public function read($id)
    {  
        MyLogger2::info("Entering EducationDataService.read()");
        try{
        // select statement to search through database using ID passed in
        $stmt = $this->db->prepare("SELECT * FROM EDUCATION WHERE id = :id");
        // variable to store sql statment and connection to database
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        // create new education array
        $education_array = array();
        $profileInfo = null;
        
        // while loop to continue to fetch information until no more information can be fetched
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // create new person for each time a person is found
            $profileInfo = new EducationModel($id, $row['SCHOOL'], $row['DESCRIPTION'], $row['USERS_ID']);
            array_push($education_array, $profileInfo);
        }
        // return user
        MyLogger2::info("Exiting EducationDataService.read()");
        return $profileInfo;
        }  catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }

   
       /*
     * Refer to EducationDataInterface
     */
    public function update($education)
    {
        MyLogger2::info("Entering EducationDataService.update()");
        try{
        // variables to retrieve new information from $user
        $id = $education->getId();
        $schoolEdit = $education->getSchool();
        $edDescEdit = $education->getDescription();
        $users_id = $education->getUsers_id();
        // Select sql statement to look through database using user entered information
        $stmt = $this->db->prepare("UPDATE `EDUCATION` SET `SCHOOL`= :school, `DESCRIPTION`= :desc WHERE id = :id Limit 1");

        $stmt->bindParam(':school', $schoolEdit);
        $stmt->bindParam(':desc', $edDescEdit);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        // if result has information
        if ($stmt->rowCount() == 1) {
            // create new user with updated information
            $educationInfo = new EducationModel($id, $schoolEdit, $edDescEdit, $users_id);
        } else {
            return null;
        }
        // return user
        MyLogger2::info("Exiting EducationDataService.update()");
        return $educationInfo;
        } catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
        
    }
    /*
     * Refer to EducationDataInterface
     */
    public function delete($id)
    {
        MyLogger2::info("Entering EducationDataService.delete()");
        try{
        // Delete statement where user ID is ID passed in
        $stmt = $this->db->prepare("DELETE FROM `EDUCATION` WHERE `EDUCATION`.`id` = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        // if result == 1
        if ($stmt->rowCount() == 1){
            MyLogger2::info("Exiting EducationDataService.delete()");
            return true;
        }
            // if result vaiable doesn't find user with entered credentials
            else
                return false;
        } catch (Exception $e2) {
                    // display our Global Exception Handler page
                    return view("error");
                }
    }
    /*
     * Refer to EducationDataInterface
     */
    public function readall($users_id)
    {
        MyLogger2::info("Entering EducationDataService.readall()");
        try{
        // select statement to search through database using ID passed in
        $stmt = $this->db->prepare("SELECT * FROM EDUCATION WHERE USERS_ID = :users_id");
        // variable to store sql statment and connection to database
        $stmt->bindParam(':users_id', $users_id);
        $stmt->execute();
        
        // create new education array
        $education_array = array();
        $profileInfo = null;
        // while loop to continue to fetch information until no more information can be fetched
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // create new person for each time a person is found
            $profileInfo = new EducationModel($row['id'], $row['SCHOOL'], $row['DESCRIPTION'], $users_id);
            array_push($education_array, $profileInfo);
        }
        MyLogger2::info("Exiting EducationDataService.delete()");
        return $education_array;
        }catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }



   
}

?>
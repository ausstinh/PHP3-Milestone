<?php
namespace App\Services\Data;

use App\Interfaces\Data\ProfileDataInterface;
use App\Models\SkillsModel;
use PDO;

class SkillDataService implements ProfileDataInterface
{

    private $db = NULL;

    // BEST practice: Do not create Database Connections in a
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($skill)
    {
        $rating = $skill->getRating();
        $desc = $skill->getDescription();
  
        $ui = $skill->getUsers_id();
        $stmt = $this->db->prepare("INSERT INTO SKILLS (DESCRIPTION, RATING, USERS_ID) VALUES (:desc, :sc, :ui)");
        
        $stmt->bindParam(':ui', $ui);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':sc', $rating);
        
        $stmt->execute();
        // if number of affected rows within the database is greater than 0, meaning user got successfully entered
        if ($stmt->rowCount() == 1) {
            // return true
            return true;
        } // else return false
        else {
            return false;
        }
    }
    /*
     * @see UserBusinessService findById
     */
    public function read($id)
    {
        // select statement to search through database using ID passed in
        $stmt = $this->db->prepare("SELECT * FROM SKILLS WHERE id = :id");
        // variable to store sql statment and connection to database
        $stmt->bindParam(':id', $id);
        $stmt->execute();
 
        $profileInfo = null;
        
        // while loop to continue to fetch information until no more information can be fetched
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
          
            $profileInfo = new SkillsModel($id, $row['DESCRIPTION'], $row['RATING'], $row['USERS_ID']);
        }
        // return user
        return $profileInfo;
    }
    

   
    /*
     * @see UserBusinessService updateNewUser
     */
    public function update($skill)
    {
        // variables to retrieve new information from $user
        $id = $skill->getId();
        $DescEdit = $skill->getDescription();
        $RatingEdit = $skill->getRating();
     
        $users_id = $skill->getUsers_id();
        // Select sql statement to look through database using user entered information
        $stmt = $this->db->prepare("UPDATE `SKILLS` SET `DESCRIPTION`= :desc, `RATING`= :ra WHERE id = :id Limit 1");
        
        $stmt->bindParam(':desc', $DescEdit);
        $stmt->bindParam(':ra', $RatingEdit);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
     
        // if result has information
        if ($stmt->rowCount() == 1) {
            // create new user with updated information
            $skillInfo = new SkillsModel($id, $DescEdit, $RatingEdit, $users_id);
        }
        else {
            return null;
        }
        // return user
        return $skillInfo;
        
    }
    public function delete($id)
    {
        // Delete statement where user ID is ID passed in
        $stmt = $this->db->prepare("DELETE FROM `SKILLS` WHERE `SKILLS`.`id` = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        // if result == 1
        if ($stmt->rowCount() == 1)
            return true;
            
            // if result vaiable doesn't find user with entered credentials
            else
                return false;
    }
    
    public function readall($users_id)
    {
        // select statement to search through database using ID passed in
        $stmt = $this->db->prepare("SELECT * FROM SKILLS WHERE USERS_ID = :users_id");
        // variable to store sql statment and connection to database
        $stmt->bindParam(':users_id', $users_id);
        $stmt->execute();
      
        // create new education array
        $education_array = array();
        $profileInfo = null;
        // while loop to continue to fetch information until no more information can be fetched
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // create new person for each time a person is found
            $profileInfo = new SkillsModel($row['id'], $row['DESCRIPTION'], $row['RATING'], $users_id);
            array_push($education_array, $profileInfo);
        }
        return $education_array;
    }


   
}

?>
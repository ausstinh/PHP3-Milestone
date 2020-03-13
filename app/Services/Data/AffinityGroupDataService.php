<?php
namespace App\Services\Data;


use App\Models\GroupModel;
use App\Models\UserModel;
use Exception;
use PDO;
use App\Interfaces\Data\AffinityGroupDataInterface;

class AffinityGroupDataService implements AffinityGroupDataInterface
{
    private $db = NULL;
    
    // BEST practice: Do not create Database Connections in a
    public function __construct($db)
    {
        $this->db = $db;
    }
    /*
     * Refer to AffinityGroupDataInterface
     */
    public function read($id)
    {
        try
        {
        // select statement to search through database using ID passed in
        $stmt = $this->db->prepare("SELECT * FROM GROUPS WHERE id = :id");
        // variable to store sql statment and connection to database
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $groupInfo = null;
        
        // while loop to continue to fetch information until no more information can be fetched
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $groupInfo = new GroupModel($id, $row['NAME'], $row['DESCRIPTION']);
        }
        // return group
        return $groupInfo;
        }
        catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }
    /*
     * Refer to AffinityGroupDataInterface
     */
    public function create($group, $userGroup)
    {
        try
        {
        $name = $group->getName();
        $desc = $group->getDescription();
       
        $stmt = $this->db->prepare("INSERT INTO GROUPS (NAME, DESCRIPTION) VALUES (:nm,:desc)");
      
        $stmt->bindParam(':nm', $name);
        $stmt->bindParam(':desc', $desc);
        $stmt->execute();
        // if number of affected rows within the database is greater than 0, meaning user got successfully entered
        if ($stmt->rowCount() == 1) {
        $role = $userGroup->getRole();
        $username = $userGroup->getUsername();
        $userId = $userGroup->getUsers_id();
    
        $stmt = $this->db->prepare("INSERT INTO USER_GROUPS (USERNAME, ROLE, USERS_ID, GROUPS_ID) VALUES (:n, :role, :ui, LAST_INSERT_ID())");
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':n', $username);   
        $stmt->bindParam(':ui', $userId);    
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
    }
    catch (Exception $e2) {
        // display our Global Exception Handler page
        return view("error");
    }
    }
    /*
     * Refer to AffinityGroupDataInterface
     */
    public function update($group)
    {
        try
        {
        // variables to retrieve new information from $user
        $id = $group->getId();
        $name = $group->getName();
        $desc = $group->getDescription();
   
       
        // Select sql statement to look through database using user entered information
        $stmt = $this->db->prepare("UPDATE `GROUPS` SET `NAME`= :nm, `DESCRIPTION`= :desc WHERE id= :id Limit 1");
        
        $stmt->bindParam(':nm', $name);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':id', $id);
      
        $stmt->execute();
   
        // if result has information
        if ($stmt->rowCount() == 1) {
            // create new user with updated information
            $groupinfo = new GroupModel($id, $name, $desc);
        }
        else {
            return null;
        }
        // return user
        return $groupinfo;
    }
    catch (Exception $e2) {
        // display our Global Exception Handler page
        return view("error");
    }
    }
    /*
     * Refer to AffinityGroupDataInterface
     */
    public function delete($id)
    {
        try
        {
        // Delete statement where group ID is ID passed in
        $stmt = $this->db->prepare("DELETE FROM USER_GROUPS WHERE GROUPS_ID = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        // if result == 1
        if ($stmt->rowCount() > 0){
            $stmt = $this->db->prepare("DELETE FROM GROUPS WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            if($stmt->rowCount() == 1)
            return true;
            else 
                return false;
        }
            
            // if result vaiable doesn't find group with entered information
            else
                return false;
    }
    catch (Exception $e2) {
        // display our Global Exception Handler page
        return view("error");
    }
    }
    /*
     * Refer to AffinityGroupDataInterface
     */
    public function readAllUsers($group_id)
    {
        try
        {
        // select statement for all information in groups
        $stmt = $this->db->prepare("SELECT * FROM USER_GROUPS WHERE GROUPS_ID = :group_id");
        
        $stmt->bindParam(':group_id', $group_id);
        $userGroups = $stmt->execute();
        if($userGroups && $stmt->rowCount() > 0){
            $userGroups = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($userGroups, $row);
            }
            return $userGroups;
        }
        else{
      
        return false;
        }
    }
    catch (Exception $e2) {
        // display our Global Exception Handler page
        return view("error");
    }
    }
    /*
     * Refer to AffinityGroupDataInterface
     */
    public function readall()
    {
        try
        {
        // select statement to search through database using ID passed in
        $stmt = $this->db->prepare("SELECT * FROM GROUPS");
        // variable to store sql statment and connection to database
        $stmt->execute();
        
        // create new education array
        $group_array = array();
        $profileInfo = null;
        // while loop to continue to fetch information until no more information can be fetched
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            // create new group with found ID
            $profileInfo = new GroupModel($row['id'], $row['NAME'], $row['DESCRIPTION']);
            array_push($group_array, $profileInfo);
        }
        // return group array
        return $group_array;
    }
    catch (Exception $e2) {
        // display our Global Exception Handler page
        return view("error");
    }
    }

        
}
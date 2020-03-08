<?php
namespace App\Services\Data;



use App\Models\UserGroupModel;
use Exception;
use PDO;
use App\Interfaces\Data\UserGroupDataInterface;

class UserGroupDataService implements UserGroupDataInterface
{
    private $db = NULL;
    
    // BEST practice: Do not create Database Connections in a
    public function __construct($db)
    {
        $this->db = $db;
    }
    

    public function delete($userGroup)
    {
        try{
        $ui =  $userGroup->getUsers_id();
        $gi = $userGroup->getGroups_id();
        // Delete statement where user ID is ID passed in
        $stmt = $this->db->prepare("DELETE FROM `USER_GROUPS` WHERE GROUPS_ID = :gi AND USERS_ID = :ui");
       
        $stmt->bindParam(':ui', $ui);
        $stmt->bindParam(':gi', $gi);
        $stmt->execute();
        
        // if result == 1
        if ($stmt->rowCount() == 1)
            return true;
            
            // if result vaiable doesn't find user with entered credentials
            else
                return false;
        } catch (Exception $e2) {
                    // display our Global Exception Handler page
                    return view("error");
                }
    }
   
    
    public function readAll($group_id)
    {
        try{
        // select statement to search through database using ID passed in
        $stmt = $this->db->prepare("SELECT * FROM USER_GROUPS WHERE GROUPS_ID = :id");
        // variable to store sql statment and connection to database
        $stmt->bindParam(':id', $group_id);
        $stmt->execute();
        
        // create new education array
        $group_array = array();

        // while loop to continue to fetch information until no more information can be fetched
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            // create new user with found ID
            $groupInfo = new UserGroupModel($row['id'], $row['USERNAME'], $row['ROLE'], $row['USERS_ID'], $group_id);
            array_push($group_array, $groupInfo);
        }
        // return user
        return $group_array;
        }catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }
    public function create($userGroup)
    {
        try{
        $role = $userGroup->getRole();
        $username = $userGroup->getUsername();
        $userId = $userGroup->getUsers_id();
        $groupId = $userGroup->getGroups_id();
       
        $stmt = $this->db->prepare("INSERT INTO USER_GROUPS (USERNAME,ROLE, USERS_ID, GROUPS_ID) VALUES (:n, :role, :ui, :group)");
        
        $stmt->bindParam(':group', $groupId);
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
        }catch (Exception $e2) {
                // display our Global Exception Handler page
                return view("error");
            }
            
    }
    public function read($group_id, $users_id)
    {
        try{
        // select statement to search through database using ID passed in
        $stmt = $this->db->prepare("SELECT * FROM USER_GROUPS WHERE GROUPS_ID = :gi AND USERS_ID = :ui");
        // variable to store sql statment and connection to database
        $stmt->bindParam(':gi', $group_id);
        $stmt->bindParam(':ui', $users_id);
        $stmt->execute();
        
        $userGroupInfo = null;
        
        // while loop to continue to fetch information until no more information can be fetched
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $userGroupInfo = new UserGroupModel($row['id'], $row['USERNAME'], $row['ROLE'],$users_id, $group_id);
        }
        // return user
        return $userGroupInfo;
        } catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }

    

    
    
}
<?php
namespace App\Interfaces\Business;


interface UserGroupBusinessInterface{
    /**
     * Takes in a userGroup
     * Uses the UserDataService method to create() and returns bool
     * @param $userGroup     userGroup information to insert
     * @return true or false for create
     */ 
    public function joinUserGroup($userGroup);
    
    /**
     * Uses the UserGroupDataService method to readAll() and returns array of users
     * @return array of userGroups
     */
    public function retrieveAllUserGroups($group_id);
    
    /**
     * Takes in a userGroup model
     * Uses the UserGroupDataService method to delete() and returns true or false
     * @param $userGroup     userGroup Model
     * @return true or false for delete
     */
    public function leaveUserGroup($userGroup);
    
    
    /**
     * Takes in a group and user id
     * Uses the UserGroupDataService method to retrieve() and returns true or false
     * @param $userGroup     userGroup Model
     * @return userGroup object
     */
    public function retrieveUserGroup($group_id, $users_id);
    
}

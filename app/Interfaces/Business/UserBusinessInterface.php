<?php
namespace App\Interfaces\Business;


interface UserBusinessInterface{
    
    /**
     * Takes in a user
     * Uses the UserDataService method to authenticateUser() and returns it's result
     * @param $user     User information to login
     * @return true or false for login
     */
    public function authenticateUser($user);
   
    /**
     * Takes in a user
     * Uses the UserDataService method to create() and returns it's result
     * @param $user     User information to register
     * @return true or false for create
     */  
    public function insert($user);
    
    /**
     * Takes in a user
     * Uses the UserDataService method to delete() and returns true or false
     * @param $user     User ID
     * @return true or false for delete
     */
    public function terminate($users_ids);
    /**
     * Takes in a user
     * Uses the UserDataService method to update() and returns instance of new user
     * @param $user     User information to update
     * @return user
     */
    public function refurbish($user);
    /**
     * Takes in a user
     * Uses the UserDataService method to findById() and returns found person
     * @param $user     User ID
     * @return user
     */
    public function findById($users_id);
    /**
     * Uses the UserDataService method to readAll() and returns array of users
     * @return array of users
     */
    public function retrieveAll();

}

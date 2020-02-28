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
     * Uses the UserDataService method to createNewUser() and returns it's result
     * @param $user     User information to register
     * @return true or false for createNewUser
     */  
    public function insert($user);
    
    /**
     * Takes in a user
     * Uses the UserDataService method to terminateUser() and returns true or false
     * @param $user     User ID
     * @return true or false for terminateUser
     */
    public function terminate($users_ids);
    /**
     * Takes in a user
     * Uses the UserDataService method to refurbishUser() and returns instance of new user
     * @param $user     User information to edit
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
     * Uses the UserDataService method to getAllUsers() and returns array of users
     * @return array of users
     */
    public function retrieveAll();

}

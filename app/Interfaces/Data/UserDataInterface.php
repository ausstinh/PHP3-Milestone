<?php
namespace App\Interfaces\Data;
interface UserDataInterface {
    /**
     * Takes in a user
     * Inserts user into the database if no user exists
     * @param $user     User information to login
     * @return true or false for login
     */
    public function create($user);
    /**
     * Takes in a user
     * Selects user from the database and create a user_id session
     * @param $user
     * @return $user
     */
    public function authenticateUser($user);
    /**
     * Takes in a user
     * Reads if user's credentials is in the database
     * @param $user
     * @return $user
     */
    public function read($user);
    /**
     * Takes in a user's id
     * Delete user from the database
     * @param $userid
     * @return true or false for delete
     */
    public function delete($users_id);
    /**
     * Takes in a user ID
     * Update user from the database
     * @param $user
     * @return $user
     */
    public function update($user);
    /**
     * Takes in a user's id
     * Selects user from the database
     * @param $userid
     * @return $user
     */
    public function findById($users_id);
    /**
     * Select users from the database
     * @return $user array
     */
    public function readAll();
  
    
}
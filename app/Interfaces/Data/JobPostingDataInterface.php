<?php
namespace App\Interfaces\Data;
interface JobPostingDataInterface {

    public function create($job);
    /**
     * Takes in a user ID
     * Delete user from the database
     * @param $userid
     * @return true or false for delete
     */
    public function update($job);
    /**.
     * Takes in a user
     * Updates user from the database
     * @param $user
     * @return $user updated information
     */
    public function readall();
   
    public function delete($id);
    
    public function read($id);
}
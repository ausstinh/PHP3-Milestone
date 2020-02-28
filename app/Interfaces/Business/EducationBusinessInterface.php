<?php
namespace App\Interfaces\Business;


interface EducationBusinessInterface{
    
    /**
     * Takes in a education model
     * Uses the EducationDataService method to create() and returns it's result
     * @param $education     Education information to create
     * @return $education
     */
    public function insert($experience);
    /**
     * Takes in a user
     * Uses the EducationDataService method to update() and returns it's result
     * @param $user     Education information to update
     * @return $education
     */
    public function refurbish($experience);
    /**
     * Takes in a user's id
     * Uses the EducationDataService method to readAll() and returns it's result
     * @param $user's id    Education information to read
     * @return $education array
     */
    public function retrieveAll($users_id);
   
    /**
     * Takes in a user's id
     * Uses the EducationDataService method to delete() and returns result
     * @param $user     User ID
     * @return $education
     */
    public function terminate($id);
  
    /**
     * Takes in a user's id
     * Uses the EducationDataService method to read() and returns it's result
     * @param $user's id    Education information to read
     * @return $education
     */
    public function retrieve($id);
  
}

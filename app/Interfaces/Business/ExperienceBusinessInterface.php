<?php
namespace App\Interfaces\Business;


interface ExperienceBusinessInterface{
    
    /**
     * Takes in a education model
     * Uses the EducationDataService method to create() and returns it's result
     * @param $education     Experience information to create
     * @return $education
     */
    public function insertExperience($education);
    /**
     * Takes in a user
     * Uses the EducationDataService method to update() and returns it's result
     * @param $user     Experience information to update
     * @return $education
     */
    public function refurbishExperience($education);
    /**
     * Takes in a user's id
     * Uses the EducationDataService method to readAll() and returns it's result
     * @param $user's id    Experience information to read
     * @return $education array
     */
    public function retrieveAllExperiences($users_id);
   
    /**
     * Takes in a user's id
     * Uses the EducationDataService method to delete() and returns result
     * @param $user     User ID
     * @return $education
     */
    public function terminateExperience($users_id);
  
    /**
     * Takes in a user's id
     * Uses the EducationDataService method to read() and returns it's result
     * @param $user's id    Experience information to read
     * @return $education
     */
    public function retrieveExperience($id);
  
}

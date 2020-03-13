<?php
namespace App\Interfaces\Business;


interface EducationBusinessInterface{
    
    /**
     * Takes in a education model
     * Uses the EducationDataService method to create() and returns it's result
     * @param $education     Education information to create
     * @return $education
     */
    public function insertEducation($experience);
    /**
     * Takes in a user
     * Uses the EducationDataService method to update() and returns it's result
     * @param $user     Education information to update
     * @return $education
     */
    public function refurbishEducation($experience);
    /**
     * Takes in a user's id
     * Uses the EducationDataService method to readAll() and returns it's result
     * @param $user's id    Education information to read
     * @return $education array
     */
    public function retrieveAllEducations($users_id);
   
    /**
     * Takes in a user's id
     * Uses the EducationDataService method to delete() and returns result
     * @param $user     User ID
     * @return $education
     */
    public function terminateEducation($id);
  
    /**
     * Takes in a user's id
     * Uses the EducationDataService method to read() and returns it's result
     * @param $user's id    Education information to read
     * @return $education
     */
    public function retrieveEducation($id);
  
}

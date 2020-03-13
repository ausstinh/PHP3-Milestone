<?php
namespace App\Interfaces\Business;


interface SkillBusinessInterface{
    
    /**
     * Takes in a Skill model
     * Uses the SkillDataService method to create() and returns it's result
     * @param $skill     Skill information to create
     * @return bool
     */
    public function insertSkill($skill);
    /**
     * Takes in a user
     * Uses the SkillDataService method to update() and returns it's result
     * @param $user     Skill information to update
     * @return $skill object
     */
    public function refurbishSkill($skill);
    /**
     * Takes in a user's id
     * Uses the SkillDataService method to readAll() and returns it's result
     * @param $user's id    User information to read
     * @return Skill array
     */
    public function retrieveAllSkills($users_id);
   
    /**
     * Takes in a skill id
     * Uses the SkillDataService method to delete() and returns result
     * @param $id     skill Id to delete
     * @return bool
     */
    public function terminateSkill($id);
  
    /**
     * Takes in a skill id
     * Uses the SkillDataService method to read() and returns it's result
     * @param  $id    Skill id to read
     * @return $skill object
     */
    public function retrieveSkill($id);
  
}

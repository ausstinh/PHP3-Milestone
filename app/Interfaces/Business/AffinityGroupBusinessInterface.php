<?php
namespace App\Interfaces\Business;


interface AffinityGroupBusinessInterface{
    
    /**
     * Takes in a userGroup and group model
     * Uses the AffinityGroupDataService method to create() and returns true or false
     * @param $userGroup, $group     userGroup Model and group Model
     * @return true or false for delete
     */
    public function insertGroup($group, $userGroup);
    
    
    /**
     * Takes in a group model
     * Uses the AffinityGroupDataService method to update() and returns group model
     * @param $group     group Model
     * @return group Model
     */
    public function refurbishGroup($group);
    
    
    /**
     * Uses the AffinityGroupDataService method to readAll() and returns array of group models
     * @param $group     group Model
     * @return array of group models
     */
    public function retrieveAllGroups();
    
    
    /**
     * Takes in a group id
     * Uses the AffinityGroupDataService method to delete() and returns true or false
     * @param $id    group Model
     * @return true or false for delete
     */
    public function terminateGroup($id);
    
    
    /**
     * Takes in a group id
     * Uses the AffinityGroupDataService method to read() and returns group model
     * @param $group     group Model
     * @return  group Model
     */
    public function retrieveGroup($id);
    
}

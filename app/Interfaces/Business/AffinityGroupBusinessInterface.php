<?php
namespace App\Interfaces\Business;


interface AffinityGroupBusinessInterface{
    
    /**
     * Takes in a userGroup and group model
     * Uses the AffinityGroupDataService method to create() and returns true or false
     * @param $userGroup, $group     userGroup Model and group Model
     * @return true or false for delete
     */
    public function insert($group, $userGroup);
    
    
    /**
     * Takes in a group model
     * Uses the AffinityGroupDataService method to update() and returns group model
     * @param $group     group Model
     * @return group Model
     */
    public function refurbish($group);
    
    
    /**
     * Uses the AffinityGroupDataService method to readAll() and returns array of group models
     * @param $group     group Model
     * @return array of group models
     */
    public function retrieveAll();
    
    
    /**
     * Takes in a group id
     * Uses the AffinityGroupDataService method to delete() and returns true or false
     * @param $id    group Model
     * @return true or false for delete
     */
    public function terminate($id);
    
    
    /**
     * Takes in a group id
     * Uses the AffinityGroupDataService method to read() and returns group model
     * @param $group     group Model
     * @return  group Model
     */
    public function retrieve($id);
    
}

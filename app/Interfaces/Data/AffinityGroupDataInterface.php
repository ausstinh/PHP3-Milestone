<?php
namespace App\Interfaces\Data;
interface AffinityGroupDataInterface {
    /**
     * Takes in a group and userGroup model
     * create group into the database
     * @param $group, $userGroup
     * @return true or false for delete
     */
    public function create($group, $userGroup);
    
    /**
     * Takes in a group model
     * update group from the database
     * @param $group
     * @return Model group
     */
    public function update($group);
    
    /**.
     * read all groups from the database
     * @return array of groups
     */
    public function readall();
    
    /**
     * Takes in a group ID
     * Delete group from the database
     * @param $id
     * @return true or false for delete
     */
    public function delete($id);
    
    /**
     * Takes in a group ID
     * Read group from the database
     * @param $id
     * @return Model group
     */
    public function read($id);
    

}
<?php
namespace App\Interfaces\Data;
interface UserGroupDataInterface {
    /**
     * Takes in a userGroup model
     * create userGroup into the database
     * @param $userGroup
     * @return true or false for delete
     */
    public function create($userGroup);
    
    /**
     * Takes in a group id
     * read all userGroup in group from the database
     * @param $group_id
     * @return Array userGroup
     */
    public function readAll($group_id);
 
    /**
     * Takes in a group and user id
     * read userGroup from the database
     * @param $group_id, $users_id
     * @return Model userGroup
     */
    public function read($group_id, $users_id);
    
    /**
     * Takes in a userGroup model
     * delete userGroup from the database
     * @param $userGroup
     * @return true or false for delete
     */
    public function delete($userGroup);
   
}
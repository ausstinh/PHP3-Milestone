<?php
namespace App\Interfaces\Data;
interface ProfileDataInterface {
    
    /**
     * Takes in a model
     * Inserts model into the database if no model exists
     * @param $model     Model information to create
     * @return true or false for create
     */
    public function create($model);
    /**
     * Takes in a user
     * Updates user information into the database
     * @param $user     user information to update
     * @return $model updated information
     */
    public function update($user);
    /**.
     * Takes in a user's id
     * Selects models from the database
     * @param $user's id
     * @return $array of model information
     */
    public function readall($users_id);
    /**.
     * Takes in a user's id
     * Deletes model information from the database
     * @param $user's id
     * @return true or false for delete
     */
    public function delete($id);
    /**.
     * Takes in a user's id
     * Selects model from the database
     * @param $user's id
     * @return $model information
     */
    public function read($id);
}
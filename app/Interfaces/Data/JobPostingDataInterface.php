<?php
namespace App\Interfaces\Data;
interface JobPostingDataInterface {
    /**.
     * Takes in a job object
     * Creates job in the database
     * @param $job
     * @return $job created information
     */
    public function create($job);
    /**
     * Takes in a job object
     * Updates job from the database
     * @param $job
     * @return $job updated information
     */
    public function update($job);
    /**.
     * Retrieves all jobs from the database
     * @return $job array information
     */
    public function readall();
    /**.
     * Takes in a job id
     * Deletes job from the database
     * @param $id
     * @return True or False
     */
    public function delete($id);
    /**.
     * Takes in a job id
     * Retrieve job from the database
     * @param $id
     * @return $job object information
     */
    public function read($id);
}
<?php
namespace App\Interfaces\Business;


interface JobPostingBusinessInterface{
    /**
     * Takes in a Job object
     * Uses the JobPostingDataService method to create() and returns it's result
     * @param $job object    Job information to read
     * @return bool
     */
    public function insertJob($job);
    /**
     * Takes in a Job object
     * Uses the JobPostingDataService method to update() and returns it's result
     * @param $job object    Job information to read
     * @return $job
     */
    public function refurbishJob($job);
    /**
     * Uses the JobPostingDataService method to readAll() and returns it's result
     * @return $job_array
     */
    public function retrieveAllJobs();
    /**
     * Takes in a Job id
     * Uses the JobPostingDataService method to delete() and returns it's result
     * @param $id    Job id to read
     * @return bool
     */
    public function terminateJob($id);
     /**
     * Takes in a Job id
     * Uses the JobPostingDataService method to read() and returns it's result
     * @param $id    Job id to read
     * @return Job object
     */
    public function retrieveJob($id);
    /**
     * Takes in a Job id, name, description, or location
     * Uses the JobPostingDataService method to read() and returns it's result
     * @param $search    Job id, name, description, or location to read
     * @return job array
     */
    public function searchJob($search);
    
}

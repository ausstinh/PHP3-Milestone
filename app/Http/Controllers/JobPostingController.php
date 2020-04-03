<?php
namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Exception;
use App\Services\Business\JobPostingBusinessService;
use App\Services\Utility\ILoggerService;
use App\Services\Utility\MyLogger2;
use App\Models\JobPostingModel;


class JobPostingController extends Controller
{
    protected $logger;
    
    public function __construct(ILoggerService $logger){
        $this->logger = $logger;
    }
    /**
     * Takes in a job ID
     * Calls the business service to read
     * If successful, return job table page If not, return the home form
     *
     * @param
     *            Job Id
     * @return View job update page with job data
     */
    public function retrieveJob($id)
    {
        $this->logger->info("Entering JobPostingController.retrieveJob()");
        try {
            // create new instance of userBusinessService
            $jobBS = new JobPostingBusinessService();
            
            // attempt to findById user
            $job = $jobBS->retrieveJob($id);
            // if statement using read method from business service class passing job ID
            if ($job) {
                $this->logger->info("Exiting JobPostingController.retrieveJob() with job passed");
                // if job is successfully found, return view displaying job update table
                $data = [
                    'job' => $job,
                ];
                return view("jobs.jobView")->with($data);
            } 
        } catch (Exception $e2) {
            // display our Global Exception Handler page
            $this->logger->error("Exiting JobPostingController.retrieveJob() with job failed ");
            return view("error");
        }
    }
    
    /**
     * Takes in a job ID
     * Calls the business service to read
     * If successful, return job table page If not, return the home form
     *
     * @param
     *            Job Id
     * @return View job update page with job data
     */
    public function retrieveJobEdit($id)
    {
        $this->logger->info("Entering JobPostingController.retrieveJobEdit()");
        try {
            // create new instance of userBusinessService
        $jobBS = new JobPostingBusinessService();
           
            // attempt to findById user
            $job = $jobBS->retrieveJob($id);
            // if statement using read method from business service class passing job ID
            if ($job) {
                $this->logger->info("Exiting JobPostingController.retrieveJobEdit() with job passed");
                // if job is successfully found, return view displaying job update table
                $data = [
                    'job' => $job,      
                ];
                return view("jobs.jobUpdate")->with($data);
            } else {
                return view("home");
            }
       } catch (Exception $e2) {
            // display our Global Exception Handler page
           $this->logger->error("Exiting JobPostingController.retrieveJobEdit() with job failed ");
           return view("error");
       }
    }

    /**
     * Takes in a request for job information
     * Calls the business service to update job
     * If successful, return to job table, return the home form
     *
     * @param
     *           Job information to edit
     * @return View job table page with job data
     */
    public function refurbishJob(Request $request)
    {
        $this->logger->info("Entering JobPostingController.refurbishJob()");
     try 
     {
        // update job entered information
        $id = $request->input('id');
        $n = $request->input('name');
        $desc = $request->input('description');
        $salary = $request->input('salary');
        $location = $request->input('location');
       $ci = $request->input('company_id');
        
        // create new instance of JobPostingBusinessService
        $jobBS = new JobPostingBusinessService();
        
        
        // create new user using new variables
        $jobEdit = new JobPostingModel($id, $n, $desc, $salary, $location, $ci);
        
        // call update method using service passing new Job
         $job = $jobBS->refurbishJob($jobEdit);
        
        //if statement checking if update returns true
        if($job)
        {
            $this->logger->info("Exiting JobPostingController.refurbishJob() with job passed");
            // attempt to readAll jobs
            $jobs = $jobBS->retrieveAllJobs();
            // store jobs information into variable
            // display jobs table page
            $data = [
                'model' => $jobs
            ];
            return view("jobs.jobTable")->with($data);
            
        }
        else {
            return view("home");
        }
       } catch (Exception $e2) {
            // display our Global Exception Handler page
           $this->logger->error("Exiting JobPostingController.refurbishJob() with job failed ");
           return view("error");
     }
    }
    
   
    /**
     * Takes in a job id
     * Calls the business service to create
     * If successful, return job table view page
     *
     * @param
     *            Job information to create
     * @return View jobs table page with job data
     */
  

   public function insertJob(Request $request)
   {
       $this->logger->info("Entering JobPostingController.insertJob()");
      try{
      
           // new user entered information
           $n = $request->input('name');
           $desc = $request->input('description');
           $salary = $request->input('salary');
           $location = $request->input('location');
           
           
           // create new instance of JobPostingBusinessService
           $jobBS = new JobPostingBusinessService();
           
           $this->logger->info(" Parameters: ", array("Name" => $n,"Description" => $desc, "Salary" => $salary, "Location" => $location)); 
           // create new job using new variables
           $jobEdit = new JobPostingModel(null, $n, $desc, $salary, $location, null);
           $job = $jobBS->insertJob($jobEdit);
       
           //if statement checking if create returns true
           if($job)
           {
               $this->logger->info("Exiting JobPostingController.refurbishJob() with job passed");
               // attempt to readAll jobs
               $jobs = $jobBS->retrieveAllJobs();
               // store jobs information into variable
               // display jobs table page
               $data = [
                   'model' => $jobs
               ];
               return view("jobs.jobTable")->with($data);
         }
       else {
           return view("home");
       }
   } catch (Exception $e2) {
       // display our Global Exception Handler page
       $this->logger->error("Exiting JobPostingController.refurbishJob() with job failed ");
      return view("error");
   }
  }
 
  /**
   * Takes in a job id
   * Calls the business service to delete
   * If successful, return job table view page
   *
   * @param
   *            Job id to delete
   * @return View jobs table page with job data
   */
 
  public function terminateJob($id)
  {
      $this->logger->info("Entering JobPostingController.terminateJob()");
      try
      {
      //new instance of business service
      $jobBS = new JobPostingBusinessService();
      //call delete method passing in job id and storing result into new variable
      $job = $jobBS->terminateJob($id);
   
      //if statement checking if delete returns true
      if($job)
      {
          $this->logger->info("Exiting JobPostingController.terminateJob() with job passed");
          // attempt to readAll jobs
          $jobs = $jobBS->retrieveAllJobs();
          // store jobs information into variable
          // display jobs table page
          $data = [
              'model' => $jobs
          ];
          return view("jobs.jobTable")->with($data);
      }
      else {
          return view("home");
       }
      }
      catch (Exception $e2) {
          // display our Global Exception Handler page
          $this->logger->info("Exiting JobPostingController.terminateJob() with job failed ");
          return view("error");
      }
   
  }
  /**
   *
   * Calls the business service to read all
   * If successful, return user job table page
   * 
   * @return View jobs table page with job data
   */
  public function retrieveAllJobs(Request $request)
  {
      $this->logger->info("Entering JobPostingController.retrieveAllJobs()");
       try
       {
      // create new instance of JobPostingBusinessService
      $jobBS = new JobPostingBusinessService();
      
      // attempt to readAll jobs
      $jobs = $jobBS->retrieveAllJobs();
      
      $this->logger->info("Exiting JobPostingController.retrieveAllJobs() with job passed");
      // store jobs information into variable
      // display jobs table page
      $data = [
          'model' => $jobs
      ];
      return view("jobs.jobTable")->with($data);
      
  }
       catch (Exception $e2) {
  // display our Global Exception Handler page
           $this->logger->error("Exiting JobPostingController.retrieveAllJobs() with job failed " );
          return view("error");
          
      }
    }
    
   public function viewJobs(Request $request)
    {
        $this->logger->info("Entering JobPostingController.viewJobs()");
        try
        {
            // create new instance of JobPostingBusinessService
            $jobBS = new JobPostingBusinessService();
            
            // attempt to readAll jobs
            $jobs = $jobBS->retrieveAllJobs();
           
            // store jobs information into variable
            // display jobs table page
            $data = [
                'model' => $jobs
            ];
            return view("jobs.jobSearch")->with($data);
            
        }
        catch (Exception $e2) {
            // display our Global Exception Handler page
            $this->logger->error("Entering JobPostingController.viewJobs() failed ");
            return view("error");
        }
    }

    public function searchJobs(Request $request)
    {
        $this->logger->info("Entering JobPostingController.searchJobs()");
        try
       {
            $search = $request->input('search');
            // create new instance of JobPostingBusinessService
            $jobBS = new JobPostingBusinessService();
            
            // attempt to readAll jobs
            $jobs = $jobBS->searchJob($search);
            if($jobs){
            $this->logger->info("Exiting JobPostingController.searchJobs() with jobs");
            // store jobs information into variable
            // display jobs table page
          
            $data = [
                'model' => $jobs
            ];
            return view("jobs.jobSearchResults")->with($data);
            }
       }
       catch (Exception $e2) {
            // display our Global Exception Handler page
           $this->logger->error("Exiting JobPostingController.searchJobs() with jobs failed ");
            return view("error");
       }
 
    }

}

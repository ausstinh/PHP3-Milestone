<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Exception;
use App\Services\Business\JobPostingBusinessService;
use App\Models\JobPostingModel;


class AffinityGroupsController extends Controller
{

    /**
     * Takes in a job ID
     * Calls the business service to read
     * If successful, return job table page If not, return the home form
     *
     * @param
     *            Job Id
     * @return job update view page with job data
     */
    public function retrieve($id)
    {
        try {
            // create new instance of userBusinessService
        $jobBS = new JobPostingBusinessService();
           
            // attempt to findById user
            $job = $jobBS->retrieve($id);
            // if statement using read method from business service class passing job ID
            if ($job) {
              
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
     * @return jobs table view page with job data
     */
    public function refurbish(Request $request)
    {
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
         $job = $jobBS->refurbish($jobEdit);
        
        //if statement checking if update returns true
        if($job)
        {
            return Redirect::route('readJobs');
            
        }
        else {
            return view("home");
        }
       } catch (Exception $e2) {
            // display our Global Exception Handler page
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
     * @return jobs table view page with job data
     */
  

   public function insert(Request $request)
   {
      try{
      
           // new user entered information
           $n = $request->input('name');
           $desc = $request->input('description');
           $salary = $request->input('salary');
           $location = $request->input('location');
           
           
           // create new instance of JobPostingBusinessService
           $jobBS = new JobPostingBusinessService();
           
           
           // create new job using new variables
           $jobEdit = new JobPostingModel(null, $n, $desc, $salary, $location, null);
           $job = $jobBS->insert($jobEdit);
       
           //if statement checking if create returns true
           if($job)
           {
           return Redirect::route('readJobs');   
         }
       else {
           return view("home");
       }
   } catch (Exception $e2) {
       // display our Global Exception Handler page
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
   * @return jobs table view page with job data
   */
 
  public function terminate($id)
  {
      try
      {
      //new instance of business service
      $jobBS = new JobPostingBusinessService();
      //call delete method passing in job id and storing result into new variable
      $job = $jobBS->terminate($id);
   
      //if statement checking if delete returns true
      if($job)
      {
          return Redirect::route('readJobs');
      }
      else {
          return view("home");
       }
      }
      catch (Exception $e2) {
          // display our Global Exception Handler page
          return view("error");
      }
   
  }
  /**
   *
   * Calls the business service to read all
   * If successful, return user job table page
   * 
   * @return jobs table view page with job data
   */
  public function retrieveAll(Request $request)
  {
       try
       {
      // create new instance of JobPostingBusinessService
      $jobBS = new JobPostingBusinessService();
      
      // attempt to readAll jobs
      $jobs = $jobBS->retrieveAll();
      // store jobs information into variable
      // display jobs table page
      $data = [
          'model' => $jobs
      ];
      return view("jobs.jobTable")->with($data);
  }
       catch (Exception $e2) {
  // display our Global Exception Handler page
          return view("error");
      }
    }
  
 
  

}

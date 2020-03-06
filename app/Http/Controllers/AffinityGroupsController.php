<?php
namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Exception;
use App\Services\Business\JobPostingBusinessService;
use App\Models\JobPostingModel;
use App\Services\Business\AffinityGroupBusinessService;
use App\Models\GroupModel;


class AffinityGroupsController extends Controller
{

    /**
     * Takes in a group ID
     * Calls the business service to read
     * If successful, return job table page If not, return the home form
     *
     * @param
     *            Group Id
     * @return View group update view page with group data
     */
    public function retrieve($id)
    {
        try {
            // create new instance of userBusinessService
            $groupBS = new AffinityGroupBusinessService();
           
            // attempt to findById user
            $group = $groupBS->retrieve($id);
            // if statement using read method from business service class passing job ID
            if ($group) {
              
                // if job is successfully found, return view displaying job update table
                $data = [
                    'group' => $group,      
                ];
                return view("groups.groupUpdate")->with($data);
            } else {
                return view("home");
            }
       } catch (Exception $e2) {
            // display our Global Exception Handler page
           return view("error");
       }
    }

    /**
     * Takes in a request for group information
     * Calls the business service to update group
     * If successful, return to group table, return the home form
     *
     * @param
     *           Group information to edit
     * @return View groups table view page with group data
     */
    public function refurbish(Request $request)
    {
      try 
      {
        // update job entered information
        $id = $request->input('id');
        $n = $request->input('name');
        $desc = $request->input('description');
  
        
        // create new instance of JobPostingBusinessService
       $groupBS = new AffinityGroupBusinessService();
        
        
        // create new user using new variables
        $groupEdit = new GroupModel($id, $n, $desc);
        
        // call update method using service passing new Job
        $job = $groupBS->refurbish($groupEdit);
        
        //if statement checking if update returns true
        if($job)
        {
            // attempt to readAll groups
            $groups = $groupBS->retrieveAll();
            // store groups information into variable
            // display groups table page
            $data = [
                'model' => $groups
            ];
            return view("groups.groupTable")->with($data);
            
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
     * Takes in a group id
     * Calls the business service to create
     * If successful, return groups table view page
     *
     * @param
     *            Group information to create
     * @return View groups table page with job data
     */
  

   public function insert(Request $request)
   {
      try{
      
           // new user entered information
           $n = $request->input('name');
           $desc = $request->input('description');
          
           
           
           // create new instance of JobPostingBusinessService
           $groupBS = new AffinityGroupBusinessService();
           
           
           // create new job using new variables
           $groupEdit = new GroupModel(null, $n, $desc);
           $group = $groupBS->insert($groupEdit);
       
           //if statement checking if create returns true
           if($group)
           {
               // attempt to readAll groups
               $groups = $groupBS->retrieveAll();
               // store groups information into variable
               // display groups table page
               $data = [
                   'model' => $groups
               ];
               return view("groups.groupTable")->with($data);
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
   * Takes in a group id
   * Calls the business service to delete
   * If successful, return groups table view page
   *
   * @param
   *            Group id to delete
   * @return View groups table view page with grpu[ data
   */
 
  public function terminate($id)
  {
      try
      {
      //new instance of business service
          $groupBS = new AffinityGroupBusinessService();
      //call delete method passing in job id and storing result into new variable
          $group = $groupBS->terminate($id);
   
      //if statement checking if delete returns true
          if($group)
      {
          // attempt to readAll groups
          $groups = $groupBS->retrieveAll();
          // store groups information into variable
          // display groups table page
          $data = [
              'model' => $groups
          ];
          return view("groups.groupTable")->with($data);
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
   * @return View groups table view page with gropu data
   */
  public function retrieveAll(Request $request)
  {
       try
       {
      // create new instance of JobPostingBusinessService
           $groupBS = new AffinityGroupBusinessService();
      
      // attempt to readAll groups
      $groups = $groupBS->retrieveAll();
      // store groups information into variable
      // display groups table page
      $data = [
          'model' => $groups
      ];
      return view("groups.groupTable")->with($data);
  }
       catch (Exception $e2) {
  // display our Global Exception Handler page
          return view("error");
      }
    }
  
 
  

}

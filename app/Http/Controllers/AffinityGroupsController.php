<?php
namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Exception;
use App\Services\Business\AffinityGroupBusinessService;
use App\Models\GroupModel;
use App\Models\UserGroupModel;
use App\Services\Business\UserGroupBusinessService;
use App\Services\Business\UserBusinessService;
use App\Services\Utility\ILoggerService;
use App\Services\Utility\MyLogger2;



class AffinityGroupsController extends Controller
{
    protected $logger;
    
    public function __construct(ILoggerService $logger){
        $this->logger = $logger;
    }
    public function Group($id)
    {
        $this->logger->info("Entering AffinityGroupsController.Group()");
      //  try {
            // create new instance of AffinityGroupBusinessService and UserGroupBusinessSerivce
            $groupBS = new AffinityGroupBusinessService();
           
            // attempt to get  group
            $group = $groupBS->retrieveGroup($id);
            // attempt to  userGroup
            $userGroup = app('App\Http\Controllers\UserGroupController')->retrieveUserGroup($id);
            
            //set current user role in group
            if($userGroup != null)
            $group->setRole($userGroup->getRole());
            else
             $group->setRole(0);
            // all users in group
             $userGroup = app('App\Http\Controllers\UserGroupController')->retrieveAllUserGroup($id);
           
            if ($group) { 
                $this->logger->info("Exiting AffinityGroupsController.Group() with group passed");
                // if group is successfully found, return view displaying group information
                $data = [
                    'group' => $group,
                    'userGroup' => $userGroup
                ];
                return view("groups.groupView")->with($data);
            } 
      // } catch (Exception $e2) {
            // display our Global Exception Handler page
           $this->logger->error("Exiting AffinityGroupsController.Group() with group failed ");
          return view("error");
       //}
    }
    /**
     * Takes in a group ID
     * Calls the business service to read Edit View
     * If successful, return group Edit table page 
     *
     * @param
     *            Group Id
     * @return View group update view page with group data
     */
    public function GroupEdit($id)
    {
        $this->logger->info("Entering AffinityGroupsController.GroupEdit()");
        try {
            // create new instance of userBusinessService
            $groupBS = new AffinityGroupBusinessService();
           
            // attempt to findById user
            $group = $groupBS->retrieveGroup($id);
            // if statement using read method from business service class passing job ID
            if ($group) {
                $this->logger->info("Exiting AffinityGroupsController.GroupEdit() with group passed");
                // if job is successfully found, return view displaying job update table
                $data = [
                    'group' => $group,      
                ];
                return view("groups.groupUpdate")->with($data);
            }
       } catch (Exception $e2) {
            // display our Global Exception Handler page
           $this->logger->info("Exiting AffinityGroupsController.GroupEdit() with group failed");
           return view("error");
       }
    }

    /**
     * Takes in a request for group information
     * Calls the business service to update group
     * If successful, return to group table
     *
     * @param
     *           Group information to edit
     * @return View groups table view page with group data
     */
    public function refurbishGroup(Request $request)
    {
        $this->logger->info("Entering AffinityGroupsController.refurbishGroup()");
     try 
     {
        // update group entered information
        $id = $request->input('id');
        $n = $request->input('name');
        $desc = $request->input('description');
  
        
        // create new instance of AffinityGroupBusinessService and UserGroupBusinessService
       $groupBS = new AffinityGroupBusinessService();
       $userGroupBS = new UserGroupBusinessService();
        
        // create new group using new variables
        $groupEdit = new GroupModel($id, $n, $desc);
        
        // call update method using service passing new group
        $group = $groupBS->refurbishGroup($groupEdit);
        
        //if statement checking if update returns true
        if($group)
        {
            $this->logger->info("Exiting AffinityGroupsController.refurbishGroup() with group passed");
            // attempt to get userGroup
            $userGroup = $userGroupBS->retrieveUserGroup($id, session()->get('users_id'));
            //set current user role in group
            $group->setRole($userGroup->getRole());
            //attempt to  all users
            $userGroup = $userGroupBS->All($id);
            // if group is successfully found, return view displaying group information
            $data = [
                'group' => $group,
                'userGroup' => $userGroup
            ];
            return view("groups.groupView")->with($data);
            
        }
      
      } catch (Exception $e2) {
            // display our Global Exception Handler page
          $this->logger->error("Exiting AffinityGroupsController.refurbishGroup() with group failed ");
          return view("error");
    }
    }
    
   
    /**
     * Takes in a group model
     * Calls the business service to create
     * If successful, return groups table view page
     *
     * @param
     *            Group information to create
     * @return View groups table page with group data
     */
  

   public function createGroup(Request $request)
   {
       $this->logger->info("Entering AffinityGroupsController.insertGroup()");
      try{
      
           // new group entered information
           $n = $request->input('name');
           $desc = $request->input('description');
          
           
           
           // create new instance of AffinityGroupBusinessService and UserBusinessService
           $groupBS = new AffinityGroupBusinessService();
           $userBS = new UserBusinessService();
           
           //create group members array
           $members = array();
           //find user by users_id
           $user = $userBS->findById(session()->get('users_id'));
           //add user to members array
           array_push($members, $user);
            
           // create new group using new variables
           $group = new GroupModel(null, $n, $desc);
           
           //set group members
           $group->setMembers($members);
           
           //new instance of users in group
           $userGroup = new UserGroupModel(null, session()->get('username'), 1, session()->get('users_id'), null);
           //set current user group role
           $group->setRole($userGroup->getRole());
           
           //create new group 
           $createGroup = $groupBS->insertGroup($group, $userGroup);
            
           //if statement checking if create returns true
           if($createGroup)
           {
               $this->logger->info("Exiting AffinityGroupsController.insertGroup() with group passed");
               // attempt to readAll groups
               $groups = $groupBS->retrieveAllGroups();
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
      $this->logger->error("Exiting AffinityGroupsController.insertGroup() with group passed ");
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
   * @return View groups table view page with group data
   */
 
  public function deleteGroup($id)
  {
      $this->logger->info("Entering AffinityGroupsController.deleteGroup()");
     try
    {
      //new instance of business service
          $groupBS = new AffinityGroupBusinessService();
      //call delete method passing in job id and storing result into new variable
          $group = $groupBS->terminateGroup($id);
   
      //if statement checking if delete returns true
          if($group)
      {
          $this->logger->info("Exiting AffinityGroupsController.deleteGroup() with group passed");
          // attempt to readAll groups
          $groups = $groupBS->retrieveAllGroups();
          // store groups information into variable
          // display groups table page
          $data = [
              'model' => $groups
          ];
          return view("groups.groupTable")->with($data);
      }
    
    }
     catch (Exception $e2) {
          // display our Global Exception Handler page
         $this->logger->error("Exiting AffinityGroupsController.deleteGroup() with group passed ");
          return view("error");
          
     }
   
  }
  /**
   *
   * Calls the business service to read all
   * If successful, return group table page
   * 
   * @return View groups table view page with group data
   */
  public function AllGroups(Request $request)
  {
      $this->logger->info("Entering AffinityGroupsController.AllGroups()");
       try
       {
      // create new instance of AffinityGroupBusinessService
      $groupBS = new AffinityGroupBusinessService();
      
      // attempt to readAll groups
      $groups = $groupBS->retrieveAllGroups();
     
      $this->logger->info("Exiting AffinityGroupsController.AllGroups() with group passed");
      // store groups information into variable
      // display groups table page
      $data = [
          'model' => $groups
      ];
      return view("groups.groupTable")->with($data);
      
  }
       catch (Exception $e2) {
  // display our Global Exception Handler page
           $this->logger->error("Exiting AffinityGroupsController.AllGroups() with group failed ");
          return view("error");
      }
    }
}

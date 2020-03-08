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



class AffinityGroupsController extends Controller
{
    public function retrieve($id)
    {
        try {
            // create new instance of AffinityGroupBusinessService and UserGroupBusinessSerivce
            $groupBS = new AffinityGroupBusinessService();
            $userGroupBS = new UserGroupBusinessService();
         
            // attempt to retrieve group
            $group = $groupBS->retrieve($id);
            // attempt to retrieve userGroup
            $userGroup = $userGroupBS->retrieve($id, session()->get('users_id'));
            
            //set current user role in group
            $group->setRole($userGroup->getRole());
            //retrieve all users in group
            $userGroup = $userGroupBS->retrieveAll($id);
           
            if ($group) {           
                // if group is successfully found, return view displaying group information
                $data = [
                    'group' => $group,
                    'userGroup' => $userGroup
                ];
                return view("groups.groupView")->with($data);
            } 
       } catch (Exception $e2) {
            // display our Global Exception Handler page
           return view("error");
       }
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
    public function retrieveEdit($id)
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
            }
       } catch (Exception $e2) {
            // display our Global Exception Handler page
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
    public function refurbish(Request $request)
    {
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
        $group = $groupBS->refurbish($groupEdit);
        
        //if statement checking if update returns true
        if($group)
        {
            //attempt to retrieve all users
            $userGroup = $userGroupBS->retrieveAll($id);
            // if group is successfully found, return view displaying group information
            $data = [
                'group' => $group,
                'userGroup' => $userGroup
            ];
            return view("groups.groupView")->with($data);
            
        }
      
      } catch (Exception $e2) {
            // display our Global Exception Handler page
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
  

   public function insert(Request $request)
   {
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
           $createGroup = $groupBS->insert($group, $userGroup);
            
           //if statement checking if create returns true
           if($createGroup)
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
   * @return View groups table view page with group data
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
    
    }
     catch (Exception $e2) {
          // display our Global Exception Handler page
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
  public function retrieveAll(Request $request)
  {
       try
       {
      // create new instance of AffinityGroupBusinessService
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
  
    /**
     *
     * Calls the business service to join group
     * If successful, return group view
     *
     * @return View groups table view page with group data
     */
    public function joinGroup($groups_id)
    {
        try {
        // create new instance of userGroupBusinessService and AffinityGroupBusinessService
        $userGroupBS = new UserGroupBusinessService();
        $groupBS = new AffinityGroupBusinessService();
        
        //new instance of user in group
        $userGroup = new UserGroupModel(null, session()->get('username'), 0, session()->get('users_id'), $groups_id);
       
        //attempt to insert new user
        $success = $userGroupBS->insert($userGroup);
        
        // attempt to retieve group
        $group = $groupBS->retrieve($groups_id);
        
        //set current user group role
        $group->setRole($userGroup->getRole());
        
        //checks if user has been inserted into group
        if ($success) {
            
            //gets all users in group
            $userGroup = $userGroupBS->retrieveAll($groups_id);
            // if users in group are successfully found, return view displaying group 
            $data = [
                'group' => $group,
                'userGroup' => $userGroup
            ];
            return view("groups.groupView")->with($data);
        }
        } catch (Exception $e2) {
        // display our Global Exception Handler page
            return view("error");
          }
    }
      
    /**
     *
     * Calls the business service to leave group
     * If successful, return group view
     *
     * @return View groups table view page with group data
     */
    public function leaveGroup($groups_id)
    {
         try {
        // create new instance of userGroupBusinessService and AffinityGroupBusinessService
        $userGroupBS = new UserGroupBusinessService();
        $groupBS = new AffinityGroupBusinessService();
        
        //new instance of user in group
        $userGroup = new UserGroupModel(null, session()->get('username'), 0, session()->get('users_id'), $groups_id);
     
        //attempt to remove user from group
        $success = $userGroupBS->remove($userGroup);
        
        // attempt to retrieve group
        $group = $groupBS->retrieve($groups_id);
        
        //set current user group role
        $group->setRole($userGroup->getRole());
        
        //checks if user has been removed from group
        if ($success) {
            
            
            // if group is successfully found, return view displaying group
            $userGroup = $userGroupBS->retrieveAll($groups_id);
            $data = [
                'group' => $group,
                'userGroup' => $userGroup
            ];
            return view("groups.groupView")->with($data);
        }
        } catch (Exception $e2) {
        // display our Global Exception Handler page
             return view("error");
         }
    }
}

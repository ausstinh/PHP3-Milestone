<?php
namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Exception;
use App\Models\UserGroupModel;
use App\Services\Business\UserGroupBusinessService;
use App\Services\Utility\MyLogger2;



class UserGroupController extends Controller
{
    public function retrieveUserGroup($group_id)
    {
        MyLogger2::info("Entering AffinityGroupsController.retrieveGroup()");
        try {
            // create new instance of AffinityGroupBusinessService and UserGroupBusinessSerivce
     
            $userGroupBS = new UserGroupBusinessService();
         
          
            // attempt to retrieve userGroup
            $userGroup = $userGroupBS->retrieveUserGroup($group_id, session()->get('users_id'));
           
            if ($userGroup) { 
              return $userGroup;
            } 
       } catch (Exception $e2) {
            // display our Global Exception Handler page
           return view("error");
       }
    }
    public function retrieveAllUserGroup($group_id)
    {
        MyLogger2::info("Entering UserGroupsController.retrieveGroup()");
        try {
            // create new instance of AffinityGroupBusinessService and UserGroupBusinessSerivce
            
            $userGroupBS = new UserGroupBusinessService();
            
            
            $userGroups = $userGroupBS->retrieveAllUserGroups($group_id);
            
            if ($userGroups) {
              return $userGroups;
            }
        } catch (Exception $e2) {
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
    public function joinUserGroup($groups_id)
    {
        MyLogger2::info("Entering AffinityGroupsController.joinGroup()");
        try {
        // create new instance of userGroupBusinessService and AffinityGroupBusinessService
        $userGroupBS = new UserGroupBusinessService();
       
        
        //new instance of user in group
        $userGroup = new UserGroupModel(null, session()->get('username'), 0, session()->get('users_id'), $groups_id);
       
        //attempt to insert new user
        $success = $userGroupBS->joinUserGroup($userGroup);
      
        if ($success) {
           
        return app('App\Http\Controllers\AffinityGroupsController')->retrieveGroup($groups_id);
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
    public function leaveUserGroup($groups_id)
    {
         MyLogger2::info("Entering AffinityGroupsController.leaveGroup()");
         try {
        // create new instance of userGroupBusinessService and AffinityGroupBusinessService
        $userGroupBS = new UserGroupBusinessService();
      
       
        //new instance of user in group
        $userGroup = new UserGroupModel(null, session()->get('username'), 0, session()->get('users_id'), $groups_id);
     
        //attempt to remove user from group
        $success = $userGroupBS->leaveUserGroup($userGroup);
        
  
        //checks if user has been removed from group
        if ($success) {
                     
        return app('App\Http\Controllers\AffinityGroupsController')->retrieveGroup($groups_id);      
        }
        } catch (Exception $e2) {
        // display our Global Exception Handler page
             return view("error");
         }
    }
}

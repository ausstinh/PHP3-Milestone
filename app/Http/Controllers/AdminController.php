<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Exception;
use App\Services\Business\UserBusinessService;
use App\Services\Business\JobPostingBusinessService;
use App\Services\Utility\MyLogger2;
class AdminController extends Controller
{
    /**
     * Takes in a request
     * Calls the business service to getAllUsers
     * If successful, return the adminControl view or usersTable view
     * If not, return the home page
     *
     * @param Request
     * @return View AdminControl page
     */
    public function retrieveAllUsers(Request $request)
    {
        MyLogger2::info("Entering AdminController.retrieveAll()");
        try{
        //new instance of business service
        $userBS = new UserBusinessService();
        //call getAllUsers method from sevice and store in new users variable
        $users = $userBS->retrieveAllUsers();
        //if statement checking if $users returns true
        if($users)
        {
            MyLogger2::info("Exit AdminController.retrieveAllUsers() with user passed");
            //store value of users into new variable
            $data = ['model' => $users];
            //if statement checking if role of user is 2
            if(session('role') == 2)
                //if true, return adminControl view with data holding users
                return view("adminControl")->with($data);
            //else
            else
            //if role == 1
            //return userstable view with data holding users
            return view("usertable")->with($data);
        }
        else{
            MyLogger2::info("Exit AdminController.retrieveAllUsers() with user failed");
            $user = session('user');
            $data = ['model'=> $user];
            //if false, re-return register page so user can try again
            return view("home")->with($user);
        }
    }
    catch (Exception $e2) {
        // display our Global Exception Handler page
        return view("error");
    }
        
    }
    /**
     * Takes in a ID request
     * Calls the business service to terminateUser
     * If successful, return the adminControl view or usersTable view
     * If not, return the home page
     *
     * @param UserId
     * @return admincontrol/userstable view page
     */
    public function terminateUser($users_id)
    {
        MyLogger2::info("Entering AdminController.terminate()");
        try{
        //new instance of business service
        $userBS = new UserBusinessService();
        //call terminateUser method passing in user id and storing result into new variable
        $users = $userBS->terminateUser($users_id);
        //if statement checking if terminateUser returns true
        if($users)
        {
            MyLogger2::info("Exiting AdminController.terminate() with user passed");
            //if role == 2
            if(session('role') == 2)
                //return admincontrol view
                return Redirect::route('admincontrol');
                else
                    //else if (role == 1) 
                    //return userstable view
                    return Redirect::route('usertable');
        }
        else{
            MyLogger2::info("Exiting AdminController.terminate() with user failed");
            $user = session('user');
            $data = ['model'=> $user];
            //if false, re-return register page so user can try again
            return view("home")->with($data);
        }
        }
        catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }
    
    /**
     * Takes in a ID request
     * Calls the business service to suspendUser
     * If successful, return the adminControl view or usersTable view
     * If not, return the home page
     *
     * @param UserId
     * @return admincontrol/userstable view page
     */
        public function toggleSuspend($users_id)
        {
            MyLogger2::info("Entering AdminController.toggleSuspend()");
            try{
            //new instance of business service
            $userBS = new UserBusinessService();
             $user = $userBS->findById($users_id);
             if($user->getSuspend()== 0)
             {
                 $user->setSuspend(1);
             }
             else if($user->getSuspend() == 1){
                 $user->setSuspend(0);
             }
    
            //call reburbish method passing in user id and storing result into new variable
            $users = $userBS->refurbishUser($user);
            //if statement checking if suspendUser returns true
            if($users)
            {
                MyLogger2::info("Exiting AdminController.toggleSuspend() with user passed");
                //if role == 2
                if(session('role') == 2)
                    //return admincontrol view
                    return Redirect::route('admincontrol');
                    else
                        //else if return usertable
                        return Redirect::route('usertable');
            }
            else{
                MyLogger2::info("Exiting AdminController.toggleSuspend() with user failed");
                $user = session('user');
                // create new instance of JobPostingBusinessService
                $jobBS = new JobPostingBusinessService();
                
                // attempt to findById
                $jobs = $jobBS->retrieveAllJobs();
                // store user and jobs information into variable
                
                $data = [
                    'jobs' => $jobs,
                    'model' => $user
                ];
               
                //if false, re-return register page so user can try again
                return view("home")->with($data);
            }
            }
            catch (Exception $e2) {
                // display our Global Exception Handler page
                return view("error");
           }
        }
            
        
    
}

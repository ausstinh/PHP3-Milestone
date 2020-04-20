<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Models\UserModel;
use App\Services\Business\UserBusinessService;
use App\Services\Business\JobPostingBusinessService;
use App\Services\Utility\ILoggerService;
use App\Services\Utility\MyLogger2;
use App\Models\ValidationModel;
class AdminController extends Controller
{
    //logger variable
    protected $logger;
    //controller constructor with ILoggerService param
    public function __construct(ILoggerService $logger){
        $this->logger = $logger;
    }
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
        $this->logger->info("Entering AdminController.retrieveAll()");
        try{
        //new instance of business service
        $userBS = new UserBusinessService();
        //call getAllUsers method from sevice and store in new users variable
        $users = $userBS->retrieveAllUsers();
        //if statement checking if $users returns true
        if($users)
        {
            $this->logger->info("Exit AdminController.retrieveAllUsers() with user passed");
            //store value of users into new variable
            $data = ['model' => $users];
            //if statement checking if role of user is 2
            if(session('role') == 2)
                //if true, return adminControl view with data holding users
                return view("adminControl")->with($data);
        
            else
            
            //return userstable view with data holding users
            return view("usertable")->with($data);
        }
        else{
            $this->logger->error("Exit AdminController.retrieveAllUsers() with user failed");
            $user = session('user');
            $data = ['model'=> $user];
            //if false, re-return register page so user can try again
            return view("home")->with($user);
        }
    }
    catch (Exception $e2) {
        // display our Global Exception Handler page
        $this->logger->error("Exit AdminController.retrieveAllUsers() with user failed ");
        return view("error");
    }
        
    }
    /**
     * Takes in a user id
     * Calls the business service to findById
     * If successful, return user profile edit page
     *
     * @param
     *            user Id
     * @return View profileEdit page with user data
     */
    public function readEdit($users_id)
    {
        $this->logger->info("Entering AdminController.readEdit()");
        try
        {
            // create new instance of userBusinessService
            $userBS = new UserBusinessService();
            
            // attempt to findById
            $user = $userBS->findById($users_id);
            if($user){
                $this->logger->info("Exiting AdminController.readEdit() with user passed");
                // store user information into variable
                // display profileEdit page
                $data = [
                    'model' => $user
                ];
                //redirect to the readExperience method
                return view("adminProfileEdit")->with($data);
            }
        }
        catch (Exception $e2) {
            //  display our Global Exception Handler page
            $this->logger->info("Exiting AdminController.readEdit() with user failed ");
            return view("error");
        }
    }
    /**
     * Takes in a request for user information
     * Calls the business service to update
     * If successful, return user profile page If not, return the home form
     *
     * @param
     *            User information to update
     * @return View profile page with user data
     */
    public function updateProfile(Request $request)
    {
        $this->logger->info("Entering AdminController.updateProfile()");
        try
        {
            $va = new ValidationModel();
            // run data validation rules
            $this->validate($request, $va->validateEditProfile());
            // new user entered information
            $fn = $request->input('firstname');
            $ln = $request->input('lastname');
            $email = $request->input('email');
            $company = $request->input('company');
            $website = $request->input('website');
            $pn = $request->input('phonenumber');
            $bd = $request->input('birthdate');
            $gender = $request->input('gender');
            $bio = $request->input('bio');
            $role = $request->input('role');
            $users_id = $request->input('users_id');
            $suspend = $request->input('suspend');
           
            // create new instance of userBusinessService
            $userBS = new UserBusinessService();
            
            $this->logger->info(" Parameters: ", array("FirstName" => $fn,"LastName" => $ln, "Email" => $email, "Company" => $company, "Website" => $website, "PhoneNumber" => $pn, "Birthdate" => $bd, "Gender" => $gender, "Bio" => $bio, "Role" => $role));
            
            // create new user using new variables
            $userEdit = new UserModel(null, $fn, $ln, $email, null, $role, $company, $website, $pn, $bd, $gender, $bio, $suspend, $users_id);
             
           
            // call update method using service passing new User
            $user = $userBS->refurbishUser($userEdit);
            
            // if user information is not empty
            if ($user) {
                //call getAllUsers method from sevice and store in new users variable
                $users = $userBS->retrieveAllUsers();
                //if statement checking if $users returns true
                if($users)
                {
                    $this->logger->info("Exit AdminController.retrieveAllUsers() with user passed");
                    //store value of users into new variable
                    $data = ['model' => $users];
                    //if statement checking if role of user is 2
                    if(session('role') == 2)
                        //if true, return adminControl view with data holding users
                        return view("adminControl")->with($data);
                        
                        else
                            
                            //return userstable view with data holding users
                            return view("usertable")->with($data);
            }
        } 
        } catch (ValidationException $e1) {
            throw $e1;
        } catch (Exception $e2) {
            // display our Global Exception Handler page
            $this->logger->error("Exiting ProfileController.updateProfile() with user failed");
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
        $this->logger->info("Entering AdminController.terminate()");
        try{
        //new instance of business service
        $userBS = new UserBusinessService();
        //call terminateUser method passing in user id and storing result into new variable
        $users = $userBS->terminateUser($users_id);
        //if statement checking if terminateUser returns true
        if($users)
        {
            $this->logger->info("Exiting AdminController.terminate() with user passed");
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
            $this->logger->error("Exiting AdminController.terminate() with user failed");
            $user = session('user');
            $data = ['model'=> $user];
            //if false, re-return register page so user can try again
            return view("home")->with($data);
        }
        }
        catch (Exception $e2) {
            // display our Global Exception Handler page
            $this->logger->error("Exiting AdminController.terminate() with user failed ");
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
            $this->logger->info("Entering AdminController.toggleSuspend()");
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
                $this->logger->info("Exiting AdminController.toggleSuspend() with user passed");
                //if role == 2
                if(session('role') == 2)
                    //return admincontrol view
                    return Redirect::route('admincontrol');
                    else
                        //else if return usertable
                        return Redirect::route('usertable');
            }
            else{
                $this->logger->error("Exiting AdminController.toggleSuspend() with user failed");
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
                $this->logger->error("Exiting AdminController.toggleSuspend() with user failed ");
                return view("error");
           }
        }
            
        
    
}

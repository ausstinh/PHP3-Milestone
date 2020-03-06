<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Services\Business\UserBusinessService;
use App\Services\Business\JobPostingBusinessService;
use App\Models\UserModel;
use App\Models\CredentialsModel;
use Illuminate\Contracts\View\View;

class AccountController extends Controller
{

    /**
     * Takes in a new user
     * Calls the business service to register
     * If successful, return the login form
     * If not, return the register form
     *
     * @param
     *            newUser user to register
     * @return View login page
     */
    public function register(Request $request)
    {
        try {
            $this->validateRegisterForm($request);
            // variables to store user input
            $firstName = $request->input('firstname');
            $lastName = $request->input('lastname');
            $email = $request->input('email');
            $password = $request->input('password');
            $gender = $request->input('gender');
            // new instance of business service
            $userBS = new UserBusinessService();
            // create new user and with variables holding user input
            
            $user = new UserModel(null, $firstName, $lastName, $email, $password, 0, null, null, null, null, $gender, null, 0, null);
            // if statement checking if createNewUser returns true
            if ($userBS->insert($user)) {
                // if true, return login view
                return view("login");
            } else {
                // if false, re-return register page so user can try again
                return view("register");
            }
        } catch (ValidationException $e1) {
            throw $e1;
        }
        catch (Exception $e2) {
            // display our Global Exception Handler page
          //  return view("error");
          return $e2->getMessage();
        }
    }
    

    /**
     * Calls the business service to findById
     * If successful, return the home page
     *
     * @return View home page
     */
    public function showHome()
    {
        try {
            // create new instance of userBusinessService
            $userBS = new UserBusinessService();

            // attempt to find user using ID
            $user = $userBS->findById(session('users_id'));
            // if statement using findById method from business service class is true
            if ($user) {
                // create new instance of jobPostingBusinessService
                $jobBS = new JobPostingBusinessService();
                
                // attempt to readAll
                $jobs = $jobBS->retrieveAll();
              
                // if user and jobs is successfully found, return view displaying home
                $data = [
                    'model' => $user,
                    'jobs' => $jobs
                    
                ];
                //return home page with data
                return view("home")->with($data);
            }
        } 
        catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }

    /**
     * Takes in a user to log in with
     * Calls the business service to login
     * If successful, return index page If not, return the login form
     *
     * @param
     *            attemptedLogin user to log in with
     * @return View home page with user data
     */
    public function login(Request $request)
    {
        try {
            $this->validateLoginForm($request);
            // two variables to store user email and password
            $email = $request->input('email');
            $password = $request->input('password');
            // create new instance of userBusinessService
            $userBS = new UserBusinessService();

            // create new user with variables storing user input
            $attemptedUser = new CredentialsModel(null, $email, $password);

            // attempt to authenticate user
            $user = $userBS->authenticateUser($attemptedUser);
            // if statement using authenticate method from business service class passing new user created
            if ($user) {
                if ($user->getSuspend() == 1) {
                    session([
                        'suspended' => $user->getSuspend()
                    ]);
                    return view("suspended");
                }
                //create session variables
                session(['users_id' => $user->getUsers_id()]);
                session(['role' => $user->getRole() ]);
                session([ 'user' => $user]);
            
                // create new instance of JobPostingBusinessService
                $jobBS = new JobPostingBusinessService();
                
                // attempt to findById
                $jobs = $jobBS->retrieveAll();
                // store user and jobs information into variable
         
                $data = [
                    'jobs' => $jobs,
                    'model' => $user
                ];
                // if user is successfully authenticated, return view displaying success
                return view("home")->with($data);
            } else
                // if user is not authenticated successfully, return login view so user can attempt to login again
                return view("login");
        } // this exception MUST be caught before Exception because ValidaitonException extends from Exception
        // youmust rethrow this exception
        catch (ValidationException $e1) {
            throw $e1;
        } 
       catch (Exception $e2) {
            // display our Global Exception Handler page
           return view("error");
       }
    }
        
    

    /**
     * Takes in a user to loggout with
     * returns a redirect to destroy session and login view page
     * @return redirect to login view page with session destroyed
     */
    public function logout(Request $request)
    {
        $request->session()->forget('users_id');
        Auth::logout();
        return redirect('/login');
    }

    public function validateLoginForm(Request $request)
    {
        try {
            // BEST practice: centralize your rules so you have a consistent architecture
            // and even reuse your rules

            // BAD practice: not using a defined Data Validation Framework, putting rules
            // all over your code, doing only on Client Side or Database
            // Setup Data Validation Rules for Login Form
            $rules = [
                'email' => 'Required | Between:4,25',
                'password' => 'Required | Between:4,10'
            ];
            // run data validation rules
            $this->validate($request, $rules);
        } catch (ValidationException $e1) {
            throw $e1;
        } 
        catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }

    public function validateRegisterForm(Request $request)
    {
        try{
        // BEST practice: centralize your rules so you have a consistent architecture
        // and even reuse your rules

        // BAD practice: not using a defined Data Validation Framework, putting rules
        // all over your code, doing only on Client Side or Database
        // Setup Data Validation Rules for Login Form
        $rules = [
            'firstname' => 'Required | Between:4,10',
            'lastname' => 'Required | Between:4,10',
            'email' => 'Required | Between:4,25',
            'password' => 'Required | Between:4,10',
            'gender' => 'Required'
        ];
        // run data validation rules
        $this->validate($request, $rules);
        }
        catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }
}

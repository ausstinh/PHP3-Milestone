<?php
namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Exception;
use App\Services\Business\UserBusinessService;
use App\Services\Business\EducationBusinessService;
use App\Services\Business\ExperienceBusinessService;
use App\Services\Business\SkillBusinessService;
use App\Services\Utility\MyLogger2;
use App\Models\UserModel;
use App\Models\EducationModel;
use App\Models\ExperienceModel;
use App\Models\SkillsModel;
use Dotenv\Exception\ValidationException;

class ProfileController extends Controller
{

    /**
     * Takes in a user ID
     * Calls the business service to findById
     * If successful, return user profile page If not, return the home form
     *
     * @param
     *           User users_Id
     * @return View profile page with user data
     */
    public function readProfile($users_id)
    {
        MyLogger2::info("Entering ProfileController.readProfile()");
        try {
        // create new instance of userBusinessService
        $userBS = new UserBusinessService();
        
        // attempt to findById user
        $user = $userBS->findById($users_id);
        // if statement using findById method from business service class passing user ID
        if ($user) {
            MyLogger2::info("Exiting ProfileController.readProfile() with user passed");
            // if user is successfully found, return view displaying profile
            $data = [
                'model' => $user,
            ];
            return view("profile")->with($data);
        } else {
            MyLogger2::info("Exiting ProfileController.readProfile() with user failed");
            return view("home");
        }
         } catch (Exception $e2) {
        // display our Global Exception Handler page
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
        MyLogger2::info("Entering ProfileController.updateProfile()");
         try
         {
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
        // create new instance of userBusinessService
        $userBS = new UserBusinessService();
        
        MyLogger2::info(" Parameters: ", array("FirstName" => $fn,"LastName" => $ln, "Email" => $email, "Company" => $company, "Website" => $website, "PhoneNumber" => $pn, "Birthdate" => $bd, "Gender" => $gender, "Bio" => $bio, "Role" => $role));
        
        // create new user using new variables
        $userEdit = new UserModel(null, $fn, $ln, $email, null, $role, $company, $website, $pn, $bd, $gender, $bio, null,  session()->get('users_id'),  session()->get('users_id'));
        
        
        // call update method using service passing new User
        $user = $userBS->refurbishUser($userEdit);
        
        
        
        // if user information is not empty
        if ($user) {
            MyLogger2::info("Exiting ProfileController.updateProfile() with user passed");
            // store user values into new variable passing user
            $data = [
                'model' => $user,
            ];
            // return profile page displaying $data
            return view("profile")->with($data);
        }
         } catch (Exception $e2) {
        // display our Global Exception Handler page
            return view("error");
       }
    }
    /**
     * Takes in a request for experience information
     * Calls the business service to update
     * If successful, return experience profile page If not, return the home form
     *
     * @param
     *           Experience information to update
     * @return View experience page with experience data
     */
    public function updateExperience(Request $request)
    {
        MyLogger2::info("Entering ProfileController.updateExperience()");
        try{
        // new experience entered information
        $exId = $request->input('id');
        $exCompany = $request->input('company');
        $exDesc = $request->input('description');
        $exLocation = $request->input('location');
        $exTitle = $request->input('title');
        $exStartDate = $request->input('startdate');
        $exEndDate = $request->input('enddate');
        
        // new instance of profileBusinessServerice
        $profileBS = new ExperienceBusinessService();
        MyLogger2::info(" Parameters: ", array("id" => $exId,"Company" => $exCompany, "Description" => $exDesc, "Location" => $exLocation, "Title" => $exTitle, "StartDate" => $exStartDate, "EndDate" => $exEndDate));
        //create new experience using new variables
        $experienceEdit = new ExperienceModel($exId, $exCompany, $exDesc, $exLocation, $exTitle,$exStartDate, $exEndDate,  session()->get('users_id'));
        
        //execute update method 
        $experiences = $profileBS->refurbishExperience($experienceEdit);
        
        //checks experience information
        if($experiences)
        {
            MyLogger2::info("Exiting ProfileController.updateExperience() with experiences passed");
            //call get all experience method from sevice and store in new experiences variable
            $experiences= $profileBS->retrieveAllExperiences(session()->get('users_id'));
            //if statement checking if $users returns true
            
            
            //store value of experience into new variable
            $data = ['model' => $experiences];
            //if role == 1
            //return experience table view with data holding experiences
            return view("experience.experienceTable")->with($data);
        }
           } catch (Exception $e2) {
        // display our Global Exception Handler page
              return view("error");
           }
    }
    
    /**
     * Takes in a request for education information
     * Calls the business service to update
     * If successful, return education profile page If not, return the home form
     *
     * @param
     *           Educaton information to update
     * @return View education page with user data
     */
    public function updateEducation(Request $request)
    {
        MyLogger2::info("Entering ProfileController.updateEducation()");
          try{
        //get education information
        $edId = $request->input("id");
        $edSchool = $request->input('school');
        $edDesc = $request->input('description');
        //new instance of business servic
        $profileBS = new EducationBusinessService();
        MyLogger2::info(" Parameters: ", array("id" => $edId,"School" => $edSchool, "Description" => $edDesc));
        
        //new education model with inserted variables
        $educationEdit = new EducationModel($edId, $edSchool, $edDesc,  session()->get('users_id'));
        
       //execute update method
        $educationUpdate = $profileBS->refurbishEducation($educationEdit);
        
        //checks if update variable has information
        if($educationUpdate)
        {
            MyLogger2::info("Exiting ProfileController.updateEducation() with education passed");
            //call getAllUsers method from sevice and store in new users variable
            $educations = $profileBS->retrieveAllEducations(session()->get('users_id'));
            //if statement checking if $users returns true
            
            //store value of users into new variable
            $data = ['model' => $educations];
            //if role == 1
            //return userstable view with data holding users
            return view("education.educationTable")->with($data);
        }
        } catch (Exception $e2) {
        // display our Global Exception Handler page
            return view("error");
          }
    }
    /**
     * Takes in a request for skill information
     * Calls the business service to update
     * If successful, return skill profile page If not, return the home form
     *
     * @param
     *           Skill information to update
     * @return View skill page with user data
     */
    public function updateSkill(Request $request)
    {
        MyLogger2::info("Entering ProfileController.updateSkill()");
        try{
            //get skill information
        $skillId = $request->input("id");
        $skillDesc = $request->input('description');
        $skillRating = $request->input('rating');
        //new instance of business servic
        $profileBS = new SkillBusinessService();
        MyLogger2::info(" Parameters: ", array("id" => $skillId,"Description" => $skillDesc, "Rating" => $skillRating));
        //new education model with inserted variables
        $skillEdit = new SkillsModel($skillId, $skillDesc, $skillRating, session()->get('users_id'));
        $skillUpdate = $profileBS->refurbishSkill($skillEdit);
        //checks if update variable has information
        if($skillUpdate)
        {
            MyLogger2::info("Exiting ProfileController.updateSkill() with skill passed");
            //call get all skill method from sevice and store in new skills variable
            $skills = $profileBS->retrieveAllSkills(session()->get('users_id'));
            //if statement checking if $users returns true
            
            //store value of skills into new variable
            $data = ['skills' => $skills];
            //if role == 1
            //return skilltable view with data holding skills
            return view("skills.skillTable")->with($data);
        }
        } catch (Exception $e2) {
        // display our Global Exception Handler page
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
        MyLogger2::info("Entering ProfileController.readEdit()");
        try
         {
        // create new instance of userBusinessService
        $userBS = new UserBusinessService();
        
        // attempt to findById
        $user = $userBS->findById($users_id);
        if($user){
            MyLogger2::info("Exiting ProfileController.readEdit() with user passed");
        // store user information into variable
        // display profileEdit page
        $data = [
            'model' => $user
        ];
        //redirect to the readExperience method
        return view("profileEdit")->with($data);
        }
    }
          catch (Exception $e2) {
   //  display our Global Exception Handler page
            return view("error");
         }
      }
    /**
     * Takes in a request for education information
     * Calls the business service to create
     * If successful, return education profile page If not, return the home form
     *
     * @param
     *            Education information to create
     * @return View education page with user data
     */
    public function createEducation(Request $request)
    {
        MyLogger2::info("Entering ProfileController.createEducation()");
        try{
            
            $edSchool = $request->input('school');
            $edDesc = $request->input('description');
            //new instance of business servic
            $profileBS = new EducationBusinessService();
            MyLogger2::info(" Parameters: ", array("School" => $edSchool, "Description" => $edDesc));
            $education = new EducationModel(null, $edSchool, $edDesc, session()->get('users_id'));
            $userEducation = $profileBS->insertEducation($education);
            //checks if education variable has information
            if($userEducation)
            {
                MyLogger2::info("Exiting ProfileController.createEducation() with education passed");
                //call getAllUsers method from sevice and store in new users variable
                $educations = $profileBS->retrieveAllEducations(session()->get('users_id'));
                //if statement checking if $users returns true
                
                //store value of users into new variable
                $data = ['model' => $educations];
                //if role == 1
                //return userstable view with data holding users
                return view("education.educationTable")->with($data);
                
            }
        } catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }
    /**
     * Takes in a request for skill information
     * Calls the business service to create
     * If successful, return skill profile page If not, return the home form
     *
     * @param
     *           Skill information to create
     * @return View skill page with user data
     */
    public function createSkill(Request $request)
    {
        MyLogger2::info("Entering ProfileController.createSkill()");
        try{
            
            $skillDesc = $request->input('description');
            $skillRating = $request->input('rating');
            //new instance of business servic
            $profileBS = new SkillBusinessService();
            MyLogger2::info(" Parameters: ", array("Rating" => $skillRating, "Description" => $skillDesc));
            //new skill model with inserted variables
            $skill = new SkillsModel(null, $skillDesc, $skillRating, session()->get('users_id'));
            //execute skill method
            $userSkill = $profileBS->insertSkill($skill);
            
            if($userSkill)
            {
                MyLogger2::info("Exiting ProfileController.createSkill() with skill passed");
                //call get all skill method from sevice and store in new skills variable
                $skills = $profileBS->retrieveAllSkills(session()->get('users_id'));
                //if statement checking if $users returns true
                
                //store value of skills into new variable
                $data = ['skills' => $skills];
                //if role == 1
                //return skilltable view with data holding skills
                return view("skills.skillTable")->with($data);
                
            }
        } catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }
    /**
     * Takes in a request for experience information
     * Calls the business service to create
     * If successful, return experience profile page If not, return the home form
     *
     * @param
     *            Experience information to create
     * @return View experience page with user data
     */
    public function createExperience(Request $request)
    {
        MyLogger2::info("Entering ProfileController.createExperience()");
          try{
        
        //get new experience information
        $exCompany = $request->input('company');
        $exDesc = $request->input('description');
        $exLocation = $request->input('location');
        $exTitle = $request->input('title');
        $exStartDate = $request->input('startdate');
        $exEndDate = $request->input('enddate');
        
        //new instance of business servic
        $profileBS = new ExperienceBusinessService();
        MyLogger2::info(" Parameters: ", array("Company" => $exCompany,"Location" => $exLocation, "Description" => $exDesc, "Title" => $exTitle, "StartDate" => $exStartDate,"EndDate" => $exEndDate));
        //new experiemce model with inserted variables
        $experience = new ExperienceModel(null, $exCompany, $exDesc, $exLocation, $exTitle, $exStartDate, $exEndDate,  session()->get('users_id'));
        //execute create method
        $create = $profileBS->insertExperience($experience);
        //check if experience information
        if($create){
            MyLogger2::info("Entering ProfileController.createExperience() with experience passed");
            //execute read all Experience
            $experiences = $profileBS->retrieveAllExperiences(session()->get('users_id'));
            if($experiences)
                //store value of experience into new variable
                $data = ['model' => $experiences];
                //if role == 1
                //return experience table view with data holding experience
                return view("experience.experienceTable")->with($data);
        }
        
          } catch (Exception $e2) {
        // display our Global Exception Handler page
        return view("error");
           }
    }
    /**
     * Takes in a request for skill information
     * Calls the business service to read
     * If successful, return skill profile page If not, return the home form
     *
     * @param
     *            user Id
     * @return View skill page with user data
     */
    public function readSkill(Request $request)
    {
        MyLogger2::info("Entering ProfileController.readSkill()");
        try{
        //new instance of business service
            $profileBS = new SkillBusinessService();
        //call get all skill method from sevice and store in new skills variable
        $skills = $profileBS->retrieveAllSkills(session()->get('users_id'));
        //if statement checking if $users returns true
        if($skills){
            MyLogger2::info("Entering ProfileController.readSkill() with skills passed");
        //store value of skills into new variable
        $data = ['skills' => $skills];
        //if role == 1
        //return skilltable view with data holding skills
        return view("skills.skillTable")->with($data);
        }
        else{
            MyLogger2::info("Entering ProfileController.readSkill() with no skills passed");
            //store value of skills into new variable
            $data = ['skills' => $skills];
            //if role == 1
            //return skilltable view with data holding skills
            return view("skills.skillTable")->with($data);
        }
           } catch (Exception $e2) {
        // display our Global Exception Handler page
                return view("error");
             }
        
    }
    /**
     * Takes in a request for experience information
     * Calls the business service to read
     * If successful, return experience profile page If not, return the home form
     *
     * @param
     *            user Id
     * @return View experience page with user data
     */
    public function readExperience(Request $request)
    {
        MyLogger2::info("Entering ProfileController.readExperience()");
          try{
        //new instance of business service
              $profileBS = new ExperienceBusinessService();
        //call get all experience method from sevice and store in new experiences variable
        $experiences= $profileBS->retrieveAllExperiences(session()->get('users_id'));
        //if statement checking if $users returns true
        if($experiences){
            MyLogger2::info("Entering ProfileController.readExperience() with experience passed");
        //store value of experience into new variable
        $data = ['model' => $experiences];
        //if role == 1
        //return experience table view with data holding experiences
        return view("experience.experienceTable")->with($data);
        }
        else{
            MyLogger2::info("Exiting ProfileController.readExperience() with no experience passed");
            //store value of experience into new variable
            $data = ['model' => $experiences];
            //if role == 1
            //return experience table view with data holding experiences
            return view("experience.experienceTable")->with($data);
        }
          } catch (Exception $e2) {
        // display our Global Exception Handler page
               return view("error");
           }
        
    }
    /**
     * Takes in a request for education information
     * Calls the business service to read
     * If successful, return education profile page If not, return the home form
     *
     * @param
     *            user Id
     * @return View education page with user data
     */
    public function readEducation(Request $request)
    {
        MyLogger2::info("Entering ProfileController.readEducation()");
          try{
        //new instance of business service
              $profileBS = new EducationBusinessService();
        //call getAllUsers method from sevice and store in new users variable
        $educations = $profileBS->retrieveAllEducations(session()->get('users_id'));
        //if statement checking if $users returns true
        if($educations){
            MyLogger2::info("Exiting ProfileController.readEducation() with education passed");
        //store value of users into new variable
        $data = ['model' => $educations];
     
        //return userstable view with data holding users
        return view("education.educationTable")->with($data);
        }
        else{
            MyLogger2::info("Exiting ProfileController.readEducation() with  no education passed");
            //store value of users into new variable
            $data = ['model' => $educations];
            
            //return userstable view with data holding users
            return view("education.educationTable")->with($data);
        }
           } catch (Exception $e2) {
        // display our Global Exception Handler page
              return view("error");
          }
        
    }
    /**
     * Takes in a request for education id
     * Calls the business service to delete
     * If successful, return education profile page If not, return the home form
     *
     * @param
     *            user Id
     * @return View education page with user data
     */
    public function deleteEducation($id)
    {
        MyLogger2::info("Entering ProfileController.deleteEducation()");
        try{
        //new instance of business service
            $profileBS = new EducationBusinessService();
        //call delete education method passing in education id and storing result into new variable
        $education = $profileBS->terminateEducation($id);
        //if statement checking if delete education returns true
        if($education)
        {
            MyLogger2::info("Exiting ProfileController.deleteEducation() with education passed");
           //call getAllUsers method from sevice and store in new users variable
            $educations = $profileBS->retrieveAllEducations(session()->get('users_id'));
            //if statement checking if $users returns true
            
            //store value of users into new variable
            $data = ['model' => $educations];
            //if role == 1
            //return userstable view with data holding users
            return view("education.educationTable")->with($data);
        }
    }
    catch (Exception $e2) {
        // display our Global Exception Handler page
        return view("error");
    }
    }
    /**
     * Takes in a request for experience id
     * Calls the business service to delete
     * If successful, return experience profile page If not, return the home form
     *
     * @param
     *            user Id
     * @return View experience page with user data
     */
    public function deleteExperience($id)
    {
        MyLogger2::info("Entering ProfileController.deleteExperience()");
        try{
            $profileBS = new ExperienceBusinessService();
        //call delete method passing in user id and storing result into new variable
        $experiences = $profileBS->terminateExperience($id);
        //if statement checking if delete experience returns true
        if($experiences)
        {
            MyLogger2::info("Exiting ProfileController.deleteExperience() with experience passed");
            //call get all experience method from sevice and store in new experiences variable
            $experiences= $profileBS->retrieveAllExperiences(session()->get('users_id'));
            //if statement checking if $users returns true
            
            
            //store value of experience into new variable
            $data = ['model' => $experiences];
            //if role == 1
            //return experience table view with data holding experiences
            return view("experience.experienceTable")->with($data);
            
        }
    }
    catch (Exception $e2) {
        // display our Global Exception Handler page
        return view("error");
    }
    }
    /**
     * Takes in a request for skill id
     * Calls the business service to delete
     * If successful, return skill profile page If not, return the home form
     *
     * @param
     *            user Id
     * @return View skill page with user data
     */
    public function deleteSkill($id)
    {
        MyLogger2::info("Entering ProfileController.deleteSkill()");
        try
        {
        $profileBS = new SkillBusinessService();
        //call terminateUser method passing in user id and storing result into new variable
        $skills = $profileBS->terminateSkill($id);
        //if statement checking if delete skill returns true
         if($skills)
         {
             MyLogger2::info("Exiting ProfileController.deleteSkill() with skill passed");
            //call get all skill method from sevice and store in new skills variable
            $skills = $profileBS->retrieveAllSkills(session()->get('users_id'));
            //if statement checking if $users returns true
            
            //store value of skills into new variable
            $data = ['skills' => $skills];
            //if role == 1
            //return skilltable view with data holding skills
            return view("skills.skillTable")->with($data);
         }
        }
        catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }
    /**
     * Takes in a request for education id
     * Calls the business service to read
     * If successful, return education profile page If not, return the home form
     *
     * @param
     *            user Id
     * @return View educationUpdate page with user data
     */
    public function readEducationEdit($id)
    {
        MyLogger2::info("Entering ProfileController.readEducationEdit()");
         try
        {
            // create new instance of profileBusinessService
            $profileBS = new EducationBusinessService();
        
        // attempt to read education
        $education = $profileBS->retrieveEducation($id);
        // store user information into variable
        $data = [
            'education' => $education
        ];
        return view("education.educationUpdate")->with($data);
    }
         catch (Exception $e2) {
    // display our Global Exception Handler page
             return view("error");
         }
       }
    
    /**
     * Takes in a request for experience id
     * Calls the business service to read
     * If successful, return experience profile page If not, return the home form
     *
     * @param
     *            user Id
     * @return View experienceUpdate page with user data
     */
    public function readExperienceEdit($id)
    {
        MyLogger2::info("Entering ProfileController.readExperienceEdit()");
        try
         {
        // create new instance of profileBusinessService
        $profileBS = new ExperienceBusinessService();
        
        // attempt to read experience
        $profile = $profileBS->retrieveExperience($id);
        
        // store experience information into variable
        $data = [
            'experience' => $profile
        ];
        return view("experience.experienceUpdate")->with($data);
    }
       catch (Exception $e2) {
    // display our Global Exception Handler page
           return view("error");
        }
      }
    /**
     * Takes in a request for skill id
     * Calls the business service to read
     * If successful, return skill profile page If not, return the home form
     *
     * @param
     *            user Id
     * @return View skillUpdate page with user data
     */
    public function readSkillEdit($id)
    {
        MyLogger2::info("Entering ProfileController.readSkillEdit()");
        try
         {
        // create new instance of profileBusinessService
        $profileBS = new SkillBusinessService();
        
        // attempt to read Skill
        $skills = $profileBS->retrieveSkill($id);
        
        // store skill information into variable
     
        $data = [
            'skill' => $skills
        ];
        
        return view("skills.skillUpdate")->with($data);
    }
         catch (Exception $e2) {
    // display our Global Exception Handler page
            return view("error");
        }
      }
  public function validateEducationForm(Request $request)
  {
      try {
          // BEST practice: centralize your rules so you have a consistent architecture
          // and even reuse your rules
          
          // BAD practice: not using a defined Data Validation Framework, putting rules
          // all over your code, doing only on Client Side or Database
          // Setup Data Validation Rules for Login Form
          $rules = [
              'school' => 'Required | Between:4,25',
              'description' => 'Required | Between:4,10'
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
  
  public function validateSkillForm(Request $request)
  {
      try {
          // BEST practice: centralize your rules so you have a consistent architecture
          // and even reuse your rules
          
          // BAD practice: not using a defined Data Validation Framework, putting rules
          // all over your code, doing only on Client Side or Database
          // Setup Data Validation Rules for Login Form
          $rules = [
              'description' => 'Required | Between:4,25'
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
  
  public function validateExperienceForm(Request $request)
  {
      try {
          // BEST practice: centralize your rules so you have a consistent architecture
          // and even reuse your rules
          
          // BAD practice: not using a defined Data Validation Framework, putting rules
          // all over your code, doing only on Client Side or Database
          // Setup Data Validation Rules for Login Form
          $rules = [
              'company' => 'Required | Between:4,25',
              'description' => 'Required | Between:4,25',
              'location' => 'Required | Between:4,25',
              'title' => 'Required | Between:4,25',
              'startdate' => 'Required | Between:4,10',
              'enddate' => 'Required | Between:4,10'
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
  
}

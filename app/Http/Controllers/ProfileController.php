<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Exception;
use App\Services\Business\UserBusinessService;
use App\Services\Business\EducationBusinessService;
use App\Services\Business\ExperienceBusinessService;
use App\Services\Business\SkillBusinessService;
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
     * @return profile view page with user data
     */
    public function readProfile($users_id)
    {
        try {
        // create new instance of userBusinessService
        $userBS = new UserBusinessService();
        
        // attempt to findById user
        $user = $userBS->findById($users_id);
        // if statement using findById method from business service class passing user ID
        if ($user) {
            
            // if user is successfully found, return view displaying profile
            $data = [
                'model' => $user,
            ];
            return view("profile")->with($data);
        } else {
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
     * @return profile view page with user data
     */
    public function updateProfile(Request $request)
    {
         //try
        //  {
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
        
        
        // create new user using new variables
        $userEdit = new UserModel(null, $fn, $ln, $email, null, $role, $company, $website, $pn, $bd, $gender, $bio, null,  session()->get('users_id'),  session()->get('users_id'));
        
        
        // call update method using service passing new User
        $user = $userBS->refurbish($userEdit);
        
        
        
        // if user information is not empty
        if ($user != null) {
            
            // store user values into new variable passing user
            $data = [
                'model' => $user,
            ];
            // return profile page displaying $data
            return view("profile")->with($data);
        }
       //  } catch (Exception $e2) {
        // display our Global Exception Handler page
     //       return view("error");
      //  }
    }
    /**
     * Takes in a request for experience information
     * Calls the business service to update
     * If successful, return experience profile page If not, return the home form
     *
     * @param
     *           Experience information to update
     * @return experience view page with experience data
     */
    public function updateExperience(Request $request)
    {
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
        
        //create new experience using new variables
        $experienceEdit = new ExperienceModel($exId, $exCompany, $exDesc, $exLocation, $exTitle,$exStartDate, $exEndDate,  session()->get('users_id'));
        
        //execute update method 
        $experiences = $profileBS->refurbish($experienceEdit);
        
        //checks experience information
        if($experiences)
        {
            //call get all experience method from sevice and store in new experiences variable
            $experiences= $profileBS->retrieveAll(session()->get('users_id'));
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
     * @return education view page with user data
     */
    public function updateEducation(Request $request)
    {
          try{
        //get education information
        $edId = $request->input("id");
        $edSchool = $request->input('school');
        $edDesc = $request->input('description');
        //new instance of business servic
        $profileBS = new EducationBusinessService();
        //new education model with inserted variables
        $educationEdit = new EducationModel($edId, $edSchool, $edDesc,  session()->get('users_id'));
        
       //execute update method
        $educationUpdate = $profileBS->refurbish($educationEdit);
        
        //checks if update variable has information
        if($educationUpdate)
        {
            //call getAllUsers method from sevice and store in new users variable
            $educations = $profileBS->retrieveAll(session()->get('users_id'));
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
     * @return skill view page with user data
     */
    public function updateSkill(Request $request)
    {
        try{
            //get skill information
        $skillId = $request->input("id");
        $skillDesc = $request->input('description');
        $skillRating = $request->input('rating');
        //new instance of business servic
        $profileBS = new SkillBusinessService();
        //new education model with inserted variables
        $skillEdit = new SkillsModel($skillId, $skillDesc, $skillRating, session()->get('users_id'));
        $skillUpdate = $profileBS->refurbish($skillEdit);
        //checks if update variable has information
        if($skillUpdate)
        {
            //call get all skill method from sevice and store in new skills variable
            $skills = $profileBS->retrieveAll(session()->get('users_id'));
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
     * @return profileEdit view page with user data
     */
    public function readEdit($users_id)
    {
        try
         {
        // create new instance of userBusinessService
        $userBS = new UserBusinessService();
        
        // attempt to findById
        $user = $userBS->findById($users_id);
        
        // store user information into variable
        // display profileEdit page
        $data = [
            'model' => $user
        ];
        //redirect to the readExperience method
        return view("profileEdit")->with($data);
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
     * @return education view page with user data
     */
    public function createEducation(Request $request)
    {
        try{
            
            $edSchool = $request->input('school');
            $edDesc = $request->input('description');
            //new instance of business servic
            $profileBS = new EducationBusinessService();
            
            $education = new EducationModel(null, $edSchool, $edDesc, session()->get('users_id'));
            $userEducation = $profileBS->insert($education);
            //checks if education variable has information
            if($userEducation)
            {
                //call getAllUsers method from sevice and store in new users variable
                $educations = $profileBS->retrieveAll(session()->get('users_id'));
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
     * @return skill view page with user data
     */
    public function createSkill(Request $request)
    {
        try{
            
            $skillDesc = $request->input('description');
            $skillRating = $request->input('rating');
            //new instance of business servic
            $profileBS = new SkillBusinessService();
            //new skill model with inserted variables
            $skill = new SkillsModel(null, $skillDesc, $skillRating, session()->get('users_id'));
            //execute skill method
            $userSkill = $profileBS->insert($skill);
            
            if($userSkill)
            {
                //call get all skill method from sevice and store in new skills variable
                $skills = $profileBS->retrieveAll(session()->get('users_id'));
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
     * @return experience view page with user data
     */
    public function createExperience(Request $request)
    {
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
        
        //new experiemce model with inserted variables
        $experience = new ExperienceModel(null, $exCompany, $exDesc, $exLocation, $exTitle, $exStartDate, $exEndDate,  session()->get('users_id'));
        //execute create method
        $create = $profileBS->insert($experience);
        //check if experience information
        if($create){
            //execute read all Experience
            $experiences = $profileBS->readAllExperience(session()->get('users_id'));
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
     * @return skill view page with user data
     */
    public function readSkill(Request $request)
    {
        
        try{
        //new instance of business service
            $profileBS = new SkillBusinessService();
        //call get all skill method from sevice and store in new skills variable
        $skills = $profileBS->retrieveAll(session()->get('users_id'));
        //if statement checking if $users returns true
        
        //store value of skills into new variable
        $data = ['skills' => $skills];
        //if role == 1
        //return skilltable view with data holding skills
        return view("skills.skillTable")->with($data);
        
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
     * @return experience view page with user data
     */
    public function readExperience(Request $request)
    {
        
          try{
        //new instance of business service
              $profileBS = new ExperienceBusinessService();
        //call get all experience method from sevice and store in new experiences variable
        $experiences= $profileBS->retrieveAll(session()->get('users_id'));
        //if statement checking if $users returns true
        
        
        //store value of experience into new variable
        $data = ['model' => $experiences];
        //if role == 1
        //return experience table view with data holding experiences
        return view("experience.experienceTable")->with($data);
        
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
     * @return education view page with user data
     */
    public function readEducation(Request $request)
    {
        
          try{
        //new instance of business service
              $profileBS = new EducationBusinessService();
        //call getAllUsers method from sevice and store in new users variable
        $educations = $profileBS->retrieveAll(session()->get('users_id'));
        //if statement checking if $users returns true
        
        //store value of users into new variable
        $data = ['model' => $educations];
        //if role == 1
        //return userstable view with data holding users
        return view("education.educationTable")->with($data);
        
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
     * @return education view page with user data
     */
    public function deleteEducation($id)
    {
        try{
        //new instance of business service
            $profileBS = new EducationBusinessService();
        //call delete education method passing in education id and storing result into new variable
        $education = $profileBS->terminate($id);
        //if statement checking if delete education returns true
        if($education)
        {
           //call getAllUsers method from sevice and store in new users variable
            $educations = $profileBS->retrieveAll(session()->get('users_id'));
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
     * @return experience view page with user data
     */
    public function deleteExperience($id)
    {
        try{
            $profileBS = new ExperienceBusinessService();
        //call delete method passing in user id and storing result into new variable
        $experiences = $profileBS->terminate($id);
        //if statement checking if delete experience returns true
        if($experiences)
        {
            //call get all experience method from sevice and store in new experiences variable
            $experiences= $profileBS->retrieveAll(session()->get('users_id'));
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
     * @return skill view page with user data
     */
    public function deleteSkill($id)
    {
        try
        {
        $profileBS = new SkillBusinessService();
        //call terminateUser method passing in user id and storing result into new variable
        $skills = $profileBS->terminate($id);
        //if statement checking if delete skill returns true
         if($skills)
         {
            //call get all skill method from sevice and store in new skills variable
            $skills = $profileBS->retrieveAll(session()->get('users_id'));
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
     * @return educationUpdate view page with user data
     */
    public function readEducationEdit($id)
    {
         try
        {
            // create new instance of profileBusinessService
            $profileBS = new EducationBusinessService();
        
        // attempt to read education
        $education = $profileBS->retrieve($id);
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
     * @return experienceUpdate view page with user data
     */
    public function readExperienceEdit($id)
    {
        try
         {
        // create new instance of profileBusinessService
        $profileBS = new ExperienceBusinessService();
        
        // attempt to read experience
        $profile = $profileBS->retrieve($id);
        
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
     * @return skillUpdate view page with user data
     */
    public function readSkillEdit($id)
    {
        try
         {
        // create new instance of profileBusinessService
        $profileBS = new SkillBusinessService();
        
        // attempt to read Skill
        $skills = $profileBS->retrieve($id);
        
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

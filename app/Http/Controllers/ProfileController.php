<?php
namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Exception;
use App\Services\Business\UserBusinessService;
use App\Services\Business\EducationBusinessService;
use App\Services\Business\ExperienceBusinessService;
use App\Services\Business\SkillBusinessService;
use App\Services\Utility\ILoggerService;
use App\Models\UserModel;
use App\Models\EducationModel;
use App\Models\ExperienceModel;
use App\Models\SkillsModel;
use Illuminate\Validation\ValidationException;
use App\Models\ValidationModel;

class ProfileController extends Controller
{
    //logger variable
    protected $logger;
    //controller constructor with ILoggerService param
    public function __construct(ILoggerService $logger){
        $this->logger = $logger;
    }
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
        $this->logger->info("Entering ProfileController.readProfile()");
        try {
        // create new instance of userBusinessService
        $userBS = new UserBusinessService();
        
        // attempt to findById user
        $user = $userBS->findById($users_id);
        // if statement using findById method from business service class passing user ID
        if ($user) {
            $this->logger->info("Exiting ProfileController.readProfile() with user passed");
            // if user is successfully found, return view displaying profile
            $data = [
                'model' => $user,
            ];
            return view("profile")->with($data);
        } else {
            $this->logger->error("Exiting ProfileController.readProfile() with user failed");
            return view("home");
        }
         } catch (Exception $e2) {
        // display our Global Exception Handler page
             $this->logger->error("Exiting ProfileController.readProfile() with user failed ");
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
        $this->logger->info("Entering ProfileController.updateProfile()");
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
        $userEdit = new UserModel(null, $fn, $ln, $email, null, $role, $company, $website, $pn, $bd, $gender, $bio, $suspend,  $users_id);
        
        
        // call update method using service passing new User
        $user = $userBS->refurbishUser($userEdit);
        
   
        // if user information is not empty
        if ($user) {
            $this->logger->info("Exiting ProfileController.updateProfile() with user passed");
            // store user values into new variable passing user
            $data = [
                'model' => $user,
            ];
            // return profile page displaying $data
            return view("profile")->with($data);
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
        $this->logger->info("Entering ProfileController.updateExperience()");
        try{
            $va = new ValidationModel();
            // run data validation rules
            $this->validate($request, $va->validateExperience());
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
        $this->logger->info(" Parameters: ", array("id" => $exId,"Company" => $exCompany, "Description" => $exDesc, "Location" => $exLocation, "Title" => $exTitle, "StartDate" => $exStartDate, "EndDate" => $exEndDate));
        //create new experience using new variables
        $experienceEdit = new ExperienceModel($exId, $exCompany, $exDesc, $exLocation, $exTitle,$exStartDate, $exEndDate,  session()->get('users_id'));
        
        //execute update method 
        $experiences = $profileBS->refurbishExperience($experienceEdit);
        
        //checks experience information
        if($experiences)
        {
            $this->logger->info("Exiting ProfileController.updateExperience() with experiences passed");
            //call get all experience method from sevice and store in new experiences variable
            $experiences= $profileBS->retrieveAllExperiences(session()->get('users_id'));
            //if statement checking if $users returns true
            
            
            //store value of experience into new variable
            $data = ['model' => $experiences];
            //if role == 1
            //return experience table view with data holding experiences
            return view("experience.experienceTable")->with($data);
        }
        }  catch (ValidationException $e1) {
            throw $e1;
        } catch (Exception $e2) {
        // display our Global Exception Handler page
               $this->logger->info("Exiting ProfileController.updateExperience() with experiences failed ");
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
        $this->logger->info("Entering ProfileController.updateEducation()");
          try{
              $va = new ValidationModel();
              // run data validation rules
              $this->validate($request, $va->validateEducation());
        //get education information
        $edId = $request->input("id");
        $edSchool = $request->input('school');
        $edDesc = $request->input('description');
        //new instance of business servic
        $profileBS = new EducationBusinessService();
        $this->logger->info(" Parameters: ", array("id" => $edId,"School" => $edSchool, "Description" => $edDesc));
        
        //new education model with inserted variables
        $educationEdit = new EducationModel($edId, $edSchool, $edDesc,  session()->get('users_id'));
        
       //execute update method
        $educationUpdate = $profileBS->refurbishEducation($educationEdit);
        
        //checks if update variable has information
        if($educationUpdate)
        {
            $this->logger->info("Exiting ProfileController.updateEducation() with education passed");
            //call getAllUsers method from sevice and store in new users variable
            $educations = $profileBS->retrieveAllEducations(session()->get('users_id'));
            //if statement checking if $users returns true
            
            //store value of users into new variable
            $data = ['model' => $educations];
            //if role == 1
            //return userstable view with data holding users
            return view("education.educationTable")->with($data);
        }
          }  catch (ValidationException $e1) {
              throw $e1;
          } catch (Exception $e2) {
        // display our Global Exception Handler page
            $this->logger->error("Exiting ProfileController.updateEducation() with education failed ");
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
        $this->logger->info("Entering ProfileController.updateSkill()");
        try{
            $va = new ValidationModel();
            // run data validation rules
            $this->validate($request, $va->validateSkill());
            //get skill information
        $skillId = $request->input("id");
        $skillDesc = $request->input('description');
        $skillRating = $request->input('rating');
        //new instance of business servic
        $profileBS = new SkillBusinessService();
        $this->logger->info(" Parameters: ", array("id" => $skillId,"Description" => $skillDesc, "Rating" => $skillRating));
        //new education model with inserted variables
        $skillEdit = new SkillsModel($skillId, $skillDesc, $skillRating, session()->get('users_id'));
        $skillUpdate = $profileBS->refurbishSkill($skillEdit);
        //checks if update variable has information
        if($skillUpdate)
        {
            $this->logger->info("Exiting ProfileController.updateSkill() with skill passed");
            //call get all skill method from sevice and store in new skills variable
            $skills = $profileBS->retrieveAllSkills(session()->get('users_id'));
            //if statement checking if $users returns true
            
            //store value of skills into new variable
            $data = ['skills' => $skills];
            //if role == 1
            //return skilltable view with data holding skills
            return view("skills.skillTable")->with($data);
        }
        }  catch (ValidationException $e1) {
            throw $e1;
        } catch (Exception $e2) {
        // display our Global Exception Handler page
            $this->logger->error("Exiting ProfileController.updateSkill() with skill failed ");
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
        $this->logger->info("Entering ProfileController.readEdit()");
        try
         {
        // create new instance of userBusinessService
        $userBS = new UserBusinessService();
        
        // attempt to findById
        $user = $userBS->findById($users_id);
        if($user){
            $this->logger->info("Exiting ProfileController.readEdit() with user passed");
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
             $this->logger->info("Exiting ProfileController.readEdit() with user failed ");
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
        $this->logger->info("Entering ProfileController.createEducation()");
        try{
            $va = new ValidationModel();
            // run data validation rules
            $this->validate($request, $va->validateEducation());
            $edSchool = $request->input('school');
            $edDesc = $request->input('description');
            //new instance of business servic
            $profileBS = new EducationBusinessService();
            $this->logger->info(" Parameters: ", array("School" => $edSchool, "Description" => $edDesc));
            $education = new EducationModel(null, $edSchool, $edDesc, session()->get('users_id'));
            $userEducation = $profileBS->insertEducation($education);
            //checks if education variable has information
            if($userEducation)
            {
                $this->logger->info("Exiting ProfileController.createEducation() with education passed");
                //call getAllUsers method from sevice and store in new users variable
                $educations = $profileBS->retrieveAllEducations(session()->get('users_id'));
                //if statement checking if $users returns true
                
                //store value of users into new variable
                $data = ['model' => $educations];
                //if role == 1
                //return userstable view with data holding users
                return view("education.educationTable")->with($data);
                
            }
        }  catch (ValidationException $e1) {
            throw $e1;
        } catch (Exception $e2) {
            // display our Global Exception Handler page
            $this->logger->error("Exiting ProfileController.createEducation() with education failed ");
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
        $this->logger->info("Entering ProfileController.createSkill()");
        try{
            $va = new ValidationModel();
            // run data validation rules
            $this->validate($request, $va->validateSkill());
            $skillDesc = $request->input('description');
            $skillRating = $request->input('rating');
            //new instance of business servic
            $profileBS = new SkillBusinessService();
            $this->logger->info(" Parameters: ", array("Rating" => $skillRating, "Description" => $skillDesc));
            //new skill model with inserted variables
            $skill = new SkillsModel(null, $skillDesc, $skillRating, session()->get('users_id'));
            //execute skill method
            $userSkill = $profileBS->insertSkill($skill);
            
            if($userSkill)
            {
                $this->logger->info("Exiting ProfileController.createSkill() with skill passed");
                //call get all skill method from sevice and store in new skills variable
                $skills = $profileBS->retrieveAllSkills(session()->get('users_id'));
                //if statement checking if $users returns true
                
                //store value of skills into new variable
                $data = ['skills' => $skills];
                //if role == 1
                //return skilltable view with data holding skills
                return view("skills.skillTable")->with($data);
                
            }
        }  catch (ValidationException $e1) {
            throw $e1;
        } catch (Exception $e2) {
            // display our Global Exception Handler page
            $this->logger->error("Exiting ProfileController.createSkill() with skill failed ");
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
        $this->logger->info("Entering ProfileController.createExperience()");
          try{
              $va = new ValidationModel();
              // run data validation rules
              $this->validate($request, $va->validateExperience());
        //get new experience information
        $exCompany = $request->input('company');
        $exDesc = $request->input('description');
        $exLocation = $request->input('location');
        $exTitle = $request->input('title');
        $exStartDate = $request->input('startdate');
        $exEndDate = $request->input('enddate');
        
        //new instance of business servic
        $profileBS = new ExperienceBusinessService();
        $this->logger->info(" Parameters: ", array("Company" => $exCompany,"Location" => $exLocation, "Description" => $exDesc, "Title" => $exTitle, "StartDate" => $exStartDate,"EndDate" => $exEndDate));
        //new experiemce model with inserted variables
        $experience = new ExperienceModel(null, $exCompany, $exDesc, $exLocation, $exTitle, $exStartDate, $exEndDate,  session()->get('users_id'));
        //execute create method
        $create = $profileBS->insertExperience($experience);
        //check if experience information
        if($create){
            $this->logger->info("Entering ProfileController.createExperience() with experience passed");
            //execute read all Experience
            $experiences = $profileBS->retrieveAllExperiences(session()->get('users_id'));
            if($experiences)
                //store value of experience into new variable
                $data = ['model' => $experiences];
                //if role == 1
                //return experience table view with data holding experience
                return view("experience.experienceTable")->with($data);
        }
        
          } catch (ValidationException $e1) {
              throw $e1;
          } catch (Exception $e2) {
        // display our Global Exception Handler page
              $this->logger->error("Entering ProfileController.createExperience() with experience passed ");
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
        $this->logger->info("Entering ProfileController.readSkill()");
        try{
        //new instance of business service
            $profileBS = new SkillBusinessService();
        //call get all skill method from sevice and store in new skills variable
        $skills = $profileBS->retrieveAllSkills(session()->get('users_id'));
        //if statement checking if $users returns true
        if($skills){
            $this->logger->info("Entering ProfileController.readSkill() with skills passed");
        //store value of skills into new variable
        $data = ['skills' => $skills];
        //if role == 1
        //return skilltable view with data holding skills
        return view("skills.skillTable")->with($data);
        }
        else{
            $this->logger->info("Entering ProfileController.readSkill() with no skills passed");
            //store value of skills into new variable
            $data = ['skills' => $skills];
            //if role == 1
            //return skilltable view with data holding skills
            return view("skills.skillTable")->with($data);
        }
           } catch (Exception $e2) {
        // display our Global Exception Handler page
               $this->logger->error("Entering ProfileController.readSkill() with no skills failed ");
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
        $this->logger->info("Entering ProfileController.readExperience()");
          try{
        //new instance of business service
              $profileBS = new ExperienceBusinessService();
        //call get all experience method from sevice and store in new experiences variable
        $experiences= $profileBS->retrieveAllExperiences(session()->get('users_id'));
        //if statement checking if $users returns true
        if($experiences){
            $this->logger->info("Entering ProfileController.readExperience() with experience passed");
        //store value of experience into new variable
        $data = ['model' => $experiences];
        //if role == 1
        //return experience table view with data holding experiences
        return view("experience.experienceTable")->with($data);
        }
        else{
            $this->logger->info("Exiting ProfileController.readExperience() with no experience passed");
            //store value of experience into new variable
            $data = ['model' => $experiences];
            //if role == 1
            //return experience table view with data holding experiences
            return view("experience.experienceTable")->with($data);
        }
          } catch (Exception $e2) {
        // display our Global Exception Handler page
              $this->logger->error("Exiting ProfileController.readExperience() with no experience failed ");
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
        $this->logger->info("Entering ProfileController.readEducation()");
          try{
        //new instance of business service
              $profileBS = new EducationBusinessService();
        //call getAllUsers method from sevice and store in new users variable
        $educations = $profileBS->retrieveAllEducations(session()->get('users_id'));
        //if statement checking if $users returns true
        if($educations){
            $this->logger->info("Exiting ProfileController.readEducation() with education passed");
        //store value of users into new variable
        $data = ['model' => $educations];
     
        //return userstable view with data holding users
        return view("education.educationTable")->with($data);
        }
        else{
            $this->logger->info("Exiting ProfileController.readEducation() with  no education passed");
            //store value of users into new variable
            $data = ['model' => $educations];
            
            //return userstable view with data holding users
            return view("education.educationTable")->with($data);
        }
           } catch (Exception $e2) {
        // display our Global Exception Handler page
               $this->logger->error("Exiting ProfileController.readEducation() with  no education failed ");
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
        $this->logger->info("Entering ProfileController.deleteEducation()");
        try{
        //new instance of business service
            $profileBS = new EducationBusinessService();
        //call delete education method passing in education id and storing result into new variable
        $education = $profileBS->terminateEducation($id);
        //if statement checking if delete education returns true
        if($education)
        {
            $this->logger->info("Exiting ProfileController.deleteEducation() with education passed");
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
        $this->logger->info("Entering ProfileController.deleteExperience()");
        try{
            $profileBS = new ExperienceBusinessService();
        //call delete method passing in user id and storing result into new variable
        $experiences = $profileBS->terminateExperience($id);
        //if statement checking if delete experience returns true
        if($experiences)
        {
            $this->logger->info("Exiting ProfileController.deleteExperience() with experience passed");
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
        $this->logger->info("Entering ProfileController.deleteSkill()");
        try
        {
        $profileBS = new SkillBusinessService();
        //call terminateUser method passing in user id and storing result into new variable
        $skills = $profileBS->terminateSkill($id);
        //if statement checking if delete skill returns true
         if($skills)
         {
             $this->logger->info("Exiting ProfileController.deleteSkill() with skill passed");
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
            $this->logger->info("Exiting ProfileController.deleteSkill() with skill failed ");
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
        $this->logger->info("Entering ProfileController.readEducationEdit()");
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
        $this->logger->info("Entering ProfileController.readExperienceEdit()");
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
        $this->logger->info("Entering ProfileController.readSkillEdit()");
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
}

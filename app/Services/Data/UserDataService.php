<?php
namespace App\Services\Data;

use App\Interfaces\Data\UserDataInterface;
use App\Models\UserModel;
use App\Services\Utility\MyLogger2;
use Exception;
use PDO;
session_start();

class UserDataService implements UserDataInterface
{

    private $db = NULL;

    // BEST practice: Do not create Database Connections in a
    public function __construct($db)
    {
        $this->db = $db;
    }

    /*
     * Refer to UserDataInterface
     */
    public function create($user)
    {
        MyLogger2::info("Entering UserDataService.create()");
        try{
        if (!$this->read($user)) {

            // create varibales to retrieve properties of user
            $email = $user->getEmail();
            $password = $user->getPassword();
            $fn = $user->getFirstName();
            $ln = $user->getLastName();
            $role = $user->getRole();
            $website = $user->getWebsite();
            $company = $user->getCompany();
            $phonenumber = $user->getPhonenumber();
            $birthdate = $user->getBirthdate();
            $gender = $user->getGender();
            $bio = $user->getBio();
            $suspend = $user->getSuspend();

            $stmt = $this->db->prepare("INSERT INTO CREDENTIALS (email, password) VALUES (:email,:password)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            // if number of affected rows within the database is greater than 0, meaning user got successfully entered
            if ($stmt->rowCount() == 1) {
                
                // create sql statement to insert user into database
                $stmt = $this->db->prepare("INSERT INTO USERS (FIRSTNAME, LASTNAME, EMAIL, PASSWORD, ROLE, WEBSITE, COMPANY, PHONENUMBER, BIRTHDATE, GENDER, BIO, SUSPEND, USERS_ID) VALUES (:fn, :ln,:email,:password,:role,:website,:company,:phonenumber,:birthdate,:gender,:bio,:suspend,LAST_INSERT_ID())");

                // if sql statement fails. display error message
                if (!$stmt) {
                    echo "Something went wrong in the users binding process. sql error?";
                    exit();
                }

                // insert sql statement with variables storing user information
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':fn', $fn);
                $stmt->bindParam(':ln', $ln);
                $stmt->bindParam(':role', $role);
                $stmt->bindParam(':website', $website);
                $stmt->bindParam(':company', $company);
                $stmt->bindParam(':phonenumber', $phonenumber);
                $stmt->bindParam(':birthdate', $birthdate);
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':bio', $bio);
                $stmt->bindParam(':suspend', $suspend);
                $stmt->execute();

                // if number of affected rows within the database is greater than 0, meaning user got successfully entered
                if ($stmt->rowCount() == 1) {
                    // return true
                    MyLogger2::info("Exiting UserDataService.create() with user passed");
                    return true;
                } // else return false
                else {
                    MyLogger2::info("Exiting UserDataService.create() with user failed");
                    return false;
                }
            } // else return false
            else
                return false;
        }
        }  catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }

    /*
     * Refer to UserDataInterface
     */
    public function authenticateUser($user)
    {
        MyLogger2::info("Entering UserDataService.authenticateUser()");
        try{
        // variables to retrieve email and password from $user
        $attemptedLoginEmail = $user->getEmail();
        $attemptedPassword = $user->getPassword();
        // Select sql statement to look through database using user entered email and password
        $stmt = $this->db->prepare("SELECT * FROM CREDENTIALS WHERE EMAIL = :email AND PASSWORD = :password LIMIT 1");
        // variable to store sql statment and connection to database
        $stmt->bindParam(':email', $attemptedLoginEmail);
        $stmt->bindParam(':password', $attemptedPassword);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            $stmt = $this->db->prepare("SELECT * FROM USERS WHERE EMAIL = :email AND PASSWORD = :password LIMIT 1");
            $stmt->bindParam(':email', $attemptedLoginEmail);
            $stmt->bindParam(':password', $attemptedPassword);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $p = new UserModel($row['id'], $row['FIRSTNAME'], $row['LASTNAME'], $row['EMAIL'], $row['PASSWORD'], $row['ROLE'], $row['WEBSITE'], $row['COMPANY'], $row['PHONENUMBER'], $row['BIRTHDATE'], $row['GENDER'], $row['BIO'], $row['SUSPEND'], $row['USERS_ID']);
        } else {
            return null;
        }
        MyLogger2::info("Exiting UserDataService.authenticateUser()");
        // return user
        return $p;
        }catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }

    /*
     * Refer to UserDataInterface
     */
    public function findbyId($users_id)
    {
        MyLogger2::info("Entering UserDataService.findbyId()");
        try{
          
        // select statement to search through database using ID passed in
        $stmt = $this->db->prepare("SELECT * FROM USERS WHERE USERS_ID = :users_id LIMIT 1");
        // variable to store sql statment and connection to database
        $stmt->bindParam(':users_id', $users_id);
        $stmt->execute();

        // if rowCount == 1
        if ($stmt->rowCount() == 1) {

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // create new user with found ID
            $p = new UserModel($row['id'], $row['FIRSTNAME'], $row['LASTNAME'], $row['EMAIL'], $row['PASSWORD'], $row['ROLE'], $row['WEBSITE'], $row['COMPANY'], $row['PHONENUMBER'], $row['BIRTHDATE'], $row['GENDER'], $row['BIO'], $row['SUSPEND'], $users_id);   
        }
        MyLogger2::info("Exiting UserDataService.findbyId()");
        // return user
        return $p;
        }catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }

    /*
     * Refer to UserDataInterface
     */
    public function read($user)
    {
        MyLogger2::info("Entering UserDataService.read()");
        try{
        // variables to retrieve email and password from $user
        $attemptedLoginEmail = $user->getEmail();
        $attemptedPassword = $user->getPassword();
        // Select sql statement to look through database using user entered email and password
        $stmt = $this->db->prepare("SELECT id, PASSWORD, EMAIL FROM CREDENTIALS WHERE EMAIL = :email AND PASSWORD = :password LIMIT 1");
        // variable to store sql statment and connection to database
        $stmt->bindParam(':email', $attemptedLoginEmail);
        $stmt->bindParam(':password', $attemptedPassword);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            MyLogger2::info("Exiting UserDataService.read()");
            return true;
        } else {
            // return false
            return false;
        }
        }catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }

    /*
     * Refer to UserDataInterface
     */
    public function delete($users_id)
    {
       
        MyLogger2::info("Entering UserDataService.delete()");
        try{
        // Delete statement where user ID is ID passed in
        $stmt = $this->db->prepare("DELETE FROM `USERS` WHERE USERS_ID = :users_id");
        $stmt->bindParam(':users_id', $users_id);
        $stmt->execute();

        // if result == 1
        if ($stmt->rowCount() == 1){
            MyLogger2::info("Exiting UserDataService.delete()");
            return true;
        }

        // if result vaiable doesn't find user with entered credentials
        else
            return false;
        } catch (Exception $e2) {
                // display our Global Exception Handler page
                return view("error");
            }
    }

    /*
     * Refer to UserDataInterface
     */
    public function update($user)
    {
        
        MyLogger2::info("Entering UserDataService.update()");
        //try{
        // variables to retrieve new information from $user
        $users_id = $user->getUsers_id();
        $emailEdit = $user->getEmail();
        $pnEdit = $user->getPhonenumber();
        $fnEdit = $user->getFirstName();
        $lnEdit = $user->getLastName();
        $companyEdit = $user->getCompany();
        $websiteEdit = $user->getWebsite();
        $bnEdit = $user->getBirthdate();
        $genderEdit = $user->getGender();
        $bioEdit = $user->getBio();
        $roleEdit = $user->getRole();
        $suspendEdit = $user->getSuspend();

        // Select sql statement to look through database using user entered information
        $stmt = $this->db->prepare("UPDATE `USERS` SET `FIRSTNAME`= :fn, `LASTNAME`= :ln, `EMAIl` = :email, `PHONENUMBER` = :pn, `COMPANY` = :company, `WEBSITE` = :website, `BIRTHDATE` = :bd, `GENDER` = :gender, `BIO` = :bio, `ROLE` = :role, `SUSPEND` = :sus WHERE USERS_ID = :users_id Limit 1");

        $stmt->bindParam(':fn', $fnEdit);
        $stmt->bindParam(':ln', $lnEdit);
        $stmt->bindParam(':email', $emailEdit);
        $stmt->bindParam(':pn', $pnEdit);
        $stmt->bindParam(':company', $companyEdit);
        $stmt->bindParam(':website', $websiteEdit);
        $stmt->bindParam(':bd', $bnEdit);
        $stmt->bindParam(':gender', $genderEdit);
        $stmt->bindParam(':bio', $bioEdit);
        $stmt->bindParam(':role', $roleEdit);
        $stmt->bindParam(':users_id', $users_id);
        $stmt->bindParam(':sus', $suspendEdit);
        $stmt->execute();
        
        // if result has information
        if ($stmt->rowCount() == 1) {
            
                // Select sql statement to look through database using user entered information
            $stmt = $this->db->prepare("UPDATE `CREDENTIALS` SET `EMAIl` = :email WHERE id = :users_id Limit 1");
            $stmt->bindParam(':email', $emailEdit);
            $stmt->bindParam(':users_id', $users_id);
            $stmt->execute();
            
           
            $p = new UserModel($user->getId(), $fnEdit, $lnEdit, $emailEdit, $user->getPassword(), $roleEdit, $companyEdit, $websiteEdit, $pnEdit, $bnEdit, $genderEdit, $bioEdit, $suspendEdit, $users_id);        
        }
        else 
            $p = new UserModel($user->getId(), $fnEdit, $lnEdit, $emailEdit, $user->getPassword(), $roleEdit, $companyEdit, $websiteEdit, $pnEdit, $bnEdit, $genderEdit, $bioEdit, $suspendEdit, $users_id);  
            // return user
            MyLogger2::info("Exiting UserDataService.update()");
            
            return $p;
       // } catch (Exception $e2) {
            // display our Global Exception Handler page
       //     return view("error");
      //  }
    }

    /*
     * Refer to UserDataInterface
     */
    public function readAll()
    {
        MyLogger2::info("Entering UserDataService.readAll()");
        try{
        // select statement for all information in users
        $stmt = $this->db->prepare("SELECT * FROM USERS");

        $stmt->execute();
        // create new user array
        $user_array = array();
        // if result has information

        // while loop to continue to fetch information until no more information can be fetched
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // create new person for each time a person is found
            $p = new UserModel($row['id'], $row['FIRSTNAME'], $row['LASTNAME'], $row['EMAIL'], $row['PASSWORD'], $row['ROLE'], $row['COMPANY'], $row['WEBSITE'], $row['PHONENUMBER'], $row['BIRTHDATE'], $row['GENDER'], $row['BIO'], $row['SUSPEND'], $row['USERS_ID']);
            array_push($user_array, $p);
        }
        // return user array
        MyLogger2::info("Exiting UserDataService.readAll()");
        return $user_array;
        }catch (Exception $e2) {
            // display our Global Exception Handler page
            return view("error");
        }
    }


}

?>
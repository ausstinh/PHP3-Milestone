<?php
namespace App\Services\Business;
use App\Interfaces\Business\UserBusinessInterface;
use App\Services\Data\UserDataService;
use App\Models\DatabaseModel;
use PDO;
class UserBusinessService implements UserBusinessInterface{
    
    //Refer to UserBusinessInterface
   public function authenticateUser($user) {
       $servername = DatabaseModel::$servername;
       $username = DatabaseModel::$username;
       $password = DatabaseModel::$password;
       $dbname = DatabaseModel::$dbname;
       
       $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
       $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
       $dbService = new UserDataService($db);
       $person = $dbService->authenticateUser($user);
       //in PDO you "close" the database connection by setting the PDO object to null
       $db = null;
        return $person;
    }
    //Refer to UserBusinessInterface
    public function insert($user) {
        $servername = DatabaseModel::$servername;
        $username = DatabaseModel::$username;
        $password = DatabaseModel::$password;
        $dbname = DatabaseModel::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new UserDataService($db);
        $persons = $dbService->create($user);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $persons;
    }
    //Refer to UserBusinessInterface
    public function terminate($users_id)
    {
        $servername = DatabaseModel::$servername;
        $username = DatabaseModel::$username;
        $password = DatabaseModel::$password;
        $dbname = DatabaseModel::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbService = new UserDataService($db);
        $person = $dbService->delete($users_id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $person;
    }
    //Refer to UserBusinessInterface
    public function refurbish($user)
    {  
        $servername = DatabaseModel::$servername;
        $username = DatabaseModel::$username;
        $password = DatabaseModel::$password;
        $dbname = DatabaseModel::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new UserDataService($db);
        $person = $dbService->update($user);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $person;
    }
    //Refer to UserBusinessInterface
    public function findById($users_id)
    {
        $servername = DatabaseModel::$servername;
        $username = DatabaseModel::$username;
        $password = DatabaseModel::$password;
        $dbname = DatabaseModel::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new UserDataService($db);
        $person = $dbService->findbyId($users_id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $person;
    }
    //Refer to UserBusinessInterface
    public function retrieveAll()
    {
        $servername = DatabaseModel::$servername;
        $username = DatabaseModel::$username;
        $password = DatabaseModel::$password;
        $dbname = DatabaseModel::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new UserDataService($db);
        $persons = $dbService->readAll();
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $persons;
    }

}



?>
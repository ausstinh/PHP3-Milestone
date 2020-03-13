<?php
namespace App\Services\Business;
use App\Interfaces\Business\UserBusinessInterface;
use App\Services\Data\UserDataService;
use App\Models\DatabaseModel;
use PDO;
class UserBusinessService implements UserBusinessInterface{
    
    /*
     * Refer to UserBusinessInterface
     */
   public function authenticateUser($user) {
       $servername = config("database.connections.mysql.host");
       $port = config("database.connections.mysql.port");
       $username = config("database.connections.mysql.username");
       $password = config("database.connections.mysql.password");
       $dbname = config("database.connections.mysql.database");
       
       $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
       $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
       $dbService = new UserDataService($db);
       $person = $dbService->authenticateUser($user);
       //in PDO you "close" the database connection by setting the PDO object to null
       $db = null;
        return $person;
    }
    /*
     * Refer to UserBusinessInterface
     */
    public function insertUser($user) {
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new UserDataService($db);
        $persons = $dbService->create($user);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $persons;
    }
    /*
     * Refer to UserBusinessInterface
     */
    public function terminateUser($users_id)
    {
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbService = new UserDataService($db);
        $person = $dbService->delete($users_id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $person;
    }
    /*
     * Refer to UserBusinessInterface
     */
    public function refurbishUser($user)
    {  
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new UserDataService($db);
        $person = $dbService->update($user);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $person;
    }
    /*
     * Refer to UserBusinessInterface
     */
    public function findById($users_id)
    {
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new UserDataService($db);
        $person = $dbService->findbyId($users_id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $person;
    }
    /*
     * Refer to UserBusinessInterface
     */
    public function retrieveAllUsers()
    {
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new UserDataService($db);
        $persons = $dbService->readAll();
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $persons;
    }

}



?>
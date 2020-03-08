<?php
namespace App\Services\Business;
use App\Interfaces\Business\UserGroupBusinessInterface;

use App\Services\Data\UserGroupDataService;
use PDO;

class UserGroupBusinessService implements UserGroupBusinessInterface
{
 
  
    public function insert($userGroup)
    {
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new UserGroupDataService($db);
        $profileInfo = $dbService->create($userGroup);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }


    public function remove($userGroup)
    {
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new UserGroupDataService($db);
        $profileInfo = $dbService->delete($userGroup);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }

    public function retrieveAll($group_id)
    {
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new UserGroupDataService($db);
        $profileInfo = $dbService->readAll($group_id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }
    public function retrieve($group_id, $users_id)
    {
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new UserGroupDataService($db);
        $profileInfo = $dbService->read($group_id, $users_id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }

   


 


}
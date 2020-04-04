<?php
namespace App\Services\Business;
use App\Interfaces\Business\UserGroupBusinessInterface;

use App\Services\Data\UserGroupDataService;
use App\Services\Utility\MyLogger2;
use PDO;

class UserGroupBusinessService implements UserGroupBusinessInterface
{
 
    /*
     * Refer to UserGroupBusinessInterface
     */
    public function joinUserGroup($userGroup)
    {
        MyLogger2::info("Entering UserGroupBusinessService.joinUserGroup()");
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
        MyLogger2::info("Exiting UserGroupBusinessService.joinUserGroup()");
        return $profileInfo;
    }

    /*
     * Refer to UserGroupBusinessInterface
     */
    public function leaveUserGroup($userGroup)
    {
        MyLogger2::info("Entering UserGroupBusinessService.leaveUserGroup()");
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
        MyLogger2::info("Exiting UserGroupBusinessService.leaveUserGroup()");
        return $profileInfo;
    }
    /*
     * Refer to UserGroupBusinessInterface
     */
    public function retrieveAllUserGroups($group_id)
    {
        MyLogger2::info("Entering UserGroupBusinessService.retrieveAllUserGroups()");
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
        $db = null;s
        MyLogger2::info("Exiting UserGroupBusinessService.retrieveAllUserGroups()");
        return $profileInfo;
    }
    /*
     * Refer to UserGroupBusinessInterface
     */
    public function retrieveUserGroup($group_id, $users_id)
    {
        MyLogger2::info("Entering UserGroupBusinessService.retrieveUserGroup()");
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
        MyLogger2::info("Exiting UserGroupBusinessService.retrieveUserGroup()");
        return $profileInfo;
    }

   


 


}
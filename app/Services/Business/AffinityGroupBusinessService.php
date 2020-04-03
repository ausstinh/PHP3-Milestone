<?php
namespace App\Services\Business;
use App\Interfaces\Business\AffinityGroupBusinessInterface;

use App\Services\Data\AffinityGroupDataService;
use App\Services\Data\UserGroupDataService;
use PDO;

use App\Services\Data\UserDataService;
use App\Services\Utility\MyLogger3;
use App\Models\GroupModel;

class AffinityGroupBusinessService implements AffinityGroupBusinessInterface
{
    /*
     * Refer to AffinityGroupBusinessInterface
     */
    public function retrieveGroup($id)
    {
        MyLogger3::info("Entering AfffinityGroupBusinessService.retrieveGroup()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new AffinityGroupDataService($db);
        $groupInfo = $dbService->read($id);
        if($groupInfo){
        $users = $dbService->readAllUsers($groupInfo->getId());
        $userDS = new UserDataService($db);
    
        if($users)
        {
            $newMembers = array();
             foreach($users as $user)
            {
                $newUser = $userDS->findById($user['USERS_ID']);
            
                array_push($newMembers, $newUser);
                }
                $groupInfo->setMembers($newMembers);
                
          
        }
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger3::info("Exiting AfffinityGroupBusinessService.retrieveGroup() with users passed");
        return $groupInfo;
        }
        else{
            MyLogger3::info("Exiting AfffinityGroupBusinessService.retrieveGroup() with users failed");
            return new GroupModel(null, null, null);
        }
    }
    /*
     * Refer to AffinityGroupBusinessInterface
     */
    public function insertGroup($group, $userGroup)
    {
        MyLogger3::info("Entering AfffinityGroupBusinessService.insertGroup()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new AffinityGroupDataService($db);
        $profileInfo = $dbService->create($group, $userGroup);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger3::info("Exiting AfffinityGroupBusinessService.insertGroup()");
        return $profileInfo;
    }
    /*
     * Refer to AffinityGroupBusinessInterface
     */
    public function refurbishGroup($group)
    {
        MyLogger3::info("Entering AfffinityGroupBusinessService.refurbishGroup()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new AffinityGroupDataService($db);
        $profileInfo = $dbService->update($group);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger3::info("Exiting AfffinityGroupBusinessService.refurbishGroup()");
        return $profileInfo;
    }
    /*
     * Refer to AffinityGroupBusinessInterface
     */
    public function terminateGroup($id)
    {
        MyLogger3::info("Entering AfffinityGroupBusinessService.terminateGroup()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new AffinityGroupDataService($db);
        $profileInfo = $dbService->delete($id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger3::info("Exiting AfffinityGroupBusinessService.terminateGroup()");
        return $profileInfo;
    }
    /*
     * Refer to AffinityGroupBusinessInterface
     */
    public function retrieveAllGroups()
    {
        MyLogger3::info("Entering AfffinityGroupBusinessService.retrieveAllGroups()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new AffinityGroupDataService($db);
        $profileInfo = $dbService->readall();
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger3::info("Exiting AfffinityGroupBusinessService.retrieveAllGroups()");
        return $profileInfo;
    }

 


}
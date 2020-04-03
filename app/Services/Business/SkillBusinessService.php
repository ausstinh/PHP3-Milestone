<?php
namespace App\Services\Business;

use App\Interfaces\Business\SkillBusinessInterface;
use App\Models\DatabaseModel;
use App\Services\Data\SkillDataService;
use App\Services\Utility\MyLogger2;
use PDO;

class SkillBusinessService implements SkillBusinessInterface
{
    /*
     * Refer to SkillBusinessInterface
     */
    public function insertSkill($skill)
    {
        MyLogger2::info("Entering SkillBusinessService.insertSkill()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new SkillDataService($db);
        $profileInfo = $dbService->create($skill);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger2::info("Exiting SkillBusinessService.insertSkill()");
        return $profileInfo;
    }
    /*
     * Refer to SkillBusinessInterface
     */
    public function retrieveSkill($id)
    {
        MyLogger2::info("Entering SkillBusinessService.retrieveSkill()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new SkillDataService($db);
        $profileInfo = $dbService->read($id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger2::info("Exiting SkillBusinessService.retrieveSkill()");
        return $profileInfo;
    }
    /*
     * Refer to SkillBusinessInterface
     */
    public function retrieveAllSkills($users_id)
    {
        MyLogger2::info("Entering SkillBusinessService.retrieveAllSkills()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new SkillDataService($db);
        $profileInfo = $dbService->readall($users_id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger2::info("Exiting SkillBusinessService.retrieveAllSkills()");
        return $profileInfo;
    }
    /*
     * Refer to SkillBusinessInterface
     */
    public function refurbishSkill($skill)
    {
        MyLogger2::info("Entering SkillBusinessService.refurbishSkill()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new SkillDataService($db);
        $profileInfo = $dbService->update($skill);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger2::info("Exiting SkillBusinessService.refurbishSkill()");
        return $profileInfo;
    }
    /*
     * Refer to SkillBusinessInterface
     */
    public function terminateSkill($id)
    {
        MyLogger2::info("Entering SkillBusinessService.terminateSkill()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new SkillDataService($db);
        $profileInfo = $dbService->delete($id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger2::info("Exiting SkillBusinessService.terminateSkill()");
        return $profileInfo;
    }

}


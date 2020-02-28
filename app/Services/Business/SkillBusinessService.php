<?php
namespace App\Services\Business;

use App\Interfaces\Business\SkillBusinessInterface;
use App\Models\DatabaseModel;
use App\Services\Data\SkillDataService;
use PDO;

class SkillBusinessService implements SkillBusinessInterface
{
    public function insert($skill)
    {
        $servername = DatabaseModel::$servername;
        $username = DatabaseModel::$username;
        $password = DatabaseModel::$password;
        $dbname = DatabaseModel::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new SkillDataService($db);
        $profileInfo = $dbService->create($skill);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }

    public function retrieve($id)
    {
        $servername = DatabaseModel::$servername;
        $username = DatabaseModel::$username;
        $password = DatabaseModel::$password;
        $dbname = DatabaseModel::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new SkillDataService($db);
        $profileInfo = $dbService->read($id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }

    public function retrieveAll($users_id)
    {
        $servername = DatabaseModel::$servername;
        $username = DatabaseModel::$username;
        $password = DatabaseModel::$password;
        $dbname = DatabaseModel::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new SkillDataService($db);
        $profileInfo = $dbService->readall($users_id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }

    public function refurbish($skill)
    {
        $servername = DatabaseModel::$servername;
        $username = DatabaseModel::$username;
        $password = DatabaseModel::$password;
        $dbname = DatabaseModel::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new SkillDataService($db);
        $profileInfo = $dbService->update($skill);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }

    public function terminate($id)
    {
        $servername = DatabaseModel::$servername;
        $username = DatabaseModel::$username;
        $password = DatabaseModel::$password;
        $dbname = DatabaseModel::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new SkillDataService($db);
        $profileInfo = $dbService->delete($id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }

}


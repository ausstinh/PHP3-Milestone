<?php
namespace App\Services\Business;

use App\Interfaces\Business\ExperienceBusinessInterface;
use App\Models\DatabaseModel;
use App\Services\Data\ExperienceDataService;
use PDO;

class ExperienceBusinessService implements ExperienceBusinessInterface
{
    public function insert($experience)
    {
        $servername = DatabaseModel::$servername;
        $username = DatabaseModel::$username;
        $password = DatabaseModel::$password;
        $dbname = DatabaseModel::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new ExperienceDataService($db);
        $profileInfo = $dbService->create($experience);
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
        
        $dbService = new ExperienceDataService($db);
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
        
        $dbService = new ExperienceDataService($db);
        $profileInfo = $dbService->readall($users_id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }

    public function refurbish($experience)
    {
        $servername = DatabaseModel::$servername;
        $username = DatabaseModel::$username;
        $password = DatabaseModel::$password;
        $dbname = DatabaseModel::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new ExperienceDataService($db);
        $profileInfo = $dbService->update($experience);
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
        
        $dbService = new ExperienceDataService($db);
        $profileInfo = $dbService->delete($id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }

}


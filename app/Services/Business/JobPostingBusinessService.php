<?php
namespace App\Services\Business;
use App\Interfaces\Business\JobPostingBusinessInterface;
use App\Models\DatabaseModel;
use App\Services\Data\JobPostingDataService;
use PDO;

class JobPostingBusinessService implements JobPostingBusinessInterface
{
 
    public function retrieve($id)
    {
        $servername = DatabaseModel::$servername;
        $username = DatabaseModel::$username;
        $password = DatabaseModel::$password;
        $dbname = DatabaseModel::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new JobPostingDataService($db);
        $profileInfo = $dbService->read($id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }

    public function insert($job)
    {
        $servername = DatabaseModel::$servername;
        $username = DatabaseModel::$username;
        $password = DatabaseModel::$password;
        $dbname = DatabaseModel::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new JobPostingDataService($db);
        $profileInfo = $dbService->create($job);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }

    public function refurbish($job)
    {
        $servername = DatabaseModel::$servername;
        $username = DatabaseModel::$username;
        $password = DatabaseModel::$password;
        $dbname = DatabaseModel::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new JobPostingDataService($db);
        $profileInfo = $dbService->update($job);
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
        
        $dbService = new JobPostingDataService($db);
        $profileInfo = $dbService->delete($id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }

    public function retrieveAll()
    {
        $servername = DatabaseModel::$servername;
        $username = DatabaseModel::$username;
        $password = DatabaseModel::$password;
        $dbname = DatabaseModel::$dbname;
        
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new JobPostingDataService($db);
        $profileInfo = $dbService->readall();
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }

 


}
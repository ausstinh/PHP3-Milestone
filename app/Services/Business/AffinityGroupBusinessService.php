<?php
namespace App\Services\Business;
use App\Interfaces\Business\AffinityGroupBusinessInterface;

use App\Services\Data\AffinityGroupDataService;
use PDO;

class AffinityGroupBusinessService implements AffinityGroupBusinessInterface
{
 
    public function retrieve($id)
    {
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new AffinityGroupDataService($db);
        $profileInfo = $dbService->read($id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }

    public function insert($job)
    {
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new AffinityGroupDataService($db);
        $profileInfo = $dbService->create($job);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }

    public function refurbish($job)
    {
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new AffinityGroupDataService($db);
        $profileInfo = $dbService->update($job);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        return $profileInfo;
    }

    public function terminate($id)
    {
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
        return $profileInfo;
    }

    public function retrieveAll()
    {
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
        return $profileInfo;
    }

 


}
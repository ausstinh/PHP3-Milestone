<?php
namespace App\Services\Business;
use App\Interfaces\Business\JobPostingBusinessInterface;
use App\Models\DatabaseModel;
use App\Services\Data\JobPostingDataService;
use App\Services\Utility\MyLogger3;
use PDO;

class JobPostingBusinessService implements JobPostingBusinessInterface
{
    /*
     * Refer to JobPostingBusinessInterface
     */
    public function retrieveJob($id)
    {
        MyLogger3::info("Entering JobPostingBusinessService.retrieveJob()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new JobPostingDataService($db);
        $profileInfo = $dbService->read($id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger3::info("Exiting JobPostingBusinessService.retrieveJob()");
        return $profileInfo;
    }
    /*
     * Refer to JobPostingBusinessInterface
     */
    public function insertJob($job)
    {
        MyLogger3::info("Entering JobPostingBusinessService.insertJob()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new JobPostingDataService($db);
        $profileInfo = $dbService->create($job);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger3::info("Exiting JobPostingBusinessService.insertJob()");
        return $profileInfo;
    }
    /*
     * Refer to JobPostingBusinessInterface
     */
    public function refurbishJob($job)
    {
        MyLogger3::info("Entering JobPostingBusinessService.refurbishJob()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new JobPostingDataService($db);
        $profileInfo = $dbService->update($job);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger3::info("Exiting JobPostingBusinessService.refurbishJob()");
        return $profileInfo;
    }
    /*
     * Refer to JobPostingBusinessInterface
     */
    public function terminateJob($id)
    {
        MyLogger3::info("Entering JobPostingBusinessService.terminateJob()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new JobPostingDataService($db);
        $profileInfo = $dbService->delete($id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger3::info("Exiting JobPostingBusinessService.terminateJob()");
        return $profileInfo;
    }
    /*
     * Refer to JobPostingBusinessInterface
     */
    public function retrieveAllJobs()
    {
        MyLogger3::info("Entering JobPostingBusinessService.retrieveAllJobs()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new JobPostingDataService($db);
        $profileInfo = $dbService->readall();
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger3::info("Exiting JobPostingBusinessService.retrieveAllJobs()");
        return $profileInfo;
    }
    /*
     * Refer to JobPostingBusinessInterface
     */
    public function searchJob($search)
    {
        MyLogger3::info("Entering JobPostingBusinessService.searchJobs()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new JobPostingDataService($db);
        $profileInfo = $dbService->read($search);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger3::info("Exiting JobPostingBusinessService.searchJobs()");
        return $profileInfo;
    }


 


}
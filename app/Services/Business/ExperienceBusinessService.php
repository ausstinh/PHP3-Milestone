<?php
namespace App\Services\Business;

use App\Interfaces\Business\ExperienceBusinessInterface;
use App\Models\DatabaseModel;
use App\Services\Data\ExperienceDataService;
use App\Services\Utility\MyLogger2;
use PDO;

class ExperienceBusinessService implements ExperienceBusinessInterface
{
    /*
     * Refer to ExperienceBusinessInterface
     */
    public function insertExperience($experience)
    {
        MyLogger2::info("Entering ExperienceBusinessService.insertExperience()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new ExperienceDataService($db);
        $profileInfo = $dbService->create($experience);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger2::info("Exiting ExperienceBusinessService.insertExperience()");
        return $profileInfo;
    }
    /*
     * Refer to ExperienceBusinessInterface
     */
    public function retrieveExperience($id)
    {
        MyLogger2::info("Entering ExperienceBusinessService.retrieveExperience()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new ExperienceDataService($db);
        $profileInfo = $dbService->read($id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger2::info("Exiting ExperienceBusinessService.retrieveExperience()");
        return $profileInfo;
    }
    /*
     * Refer to ExperienceBusinessInterface
     */
    public function retrieveAllExperiences($users_id)
    {
        MyLogger2::info("Entering ExperienceBusinessService.retrieveAllExperiences()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new ExperienceDataService($db);
        $profileInfo = $dbService->readall($users_id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger2::info("Exiting ExperienceBusinessService.retrieveAllExperiences()");
        return $profileInfo;
    }
    /*
     * Refer to ExperienceBusinessInterface
     */
    public function refurbishExperience($experience)
    {
        MyLogger2::info("Entering ExperienceBusinessService.refurbishExperience()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new ExperienceDataService($db);
        $profileInfo = $dbService->update($experience);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger2::info("Exiting ExperienceBusinessService.refurbishExperience()");
        return $profileInfo;
    }
    /*
     * Refer to ExperienceBusinessInterface
     */
    public function terminateExperience($id)
    {
        MyLogger2::info("Entering ExperienceBusinessService.terminateExperience()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new ExperienceDataService($db);
        $profileInfo = $dbService->delete($id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger2::info("Exiting ExperienceBusinessService.terminateExperience()");
        return $profileInfo;
    }

}


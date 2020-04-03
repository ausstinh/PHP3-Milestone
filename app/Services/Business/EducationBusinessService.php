<?php
namespace App\Services\Business;

use App\Interfaces\Business\EducationBusinessInterface;
use App\Models\DatabaseModel;
use App\Services\Data\EducationDataService;
use App\Services\Utility\MyLogger2;
use PDO;

class EducationBusinessService implements EducationBusinessInterface
{
    /*
     * Refer to EducationBusinessInterface
     */
    public function insertEducation($education)
    {
        MyLogger2::info("Entering EducationBusinessService.insertEducation()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new EducationDataService($db);
        $profileInfo = $dbService->create($education);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger2::info("Exiting EducationBusinessService.insertEducation()");
        return $profileInfo;
    }
    /*
     * Refer to EducationBusinessInterface
     */
    public function retrieveEducation($id)
    {
        MyLogger2::info("Entering EducationBusinessService.retrieveEducation()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new EducationDataService($db);
        $profileInfo = $dbService->read($id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger2::info("Exiting EducationBusinessService.retrieveEducation()");
        return $profileInfo;
    }
    /*
     * Refer to EducationBusinessInterface
     */
    public function retrieveAllEducations($users_id)
    {
        MyLogger2::info("Entering EducationBusinessService.retrieveAllEducation()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new EducationDataService($db);
        $profileInfo = $dbService->readall($users_id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger2::info("Exiting EducationBusinessService.retrieveAllEducation()");
        return $profileInfo;
    }
    /*
     * Refer to EducationBusinessInterface
     */
    public function refurbishEducation($experience)
    {
        MyLogger2::info("Entering EducationBusinessService.refurbishEducation()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new EducationDataService($db);
        $profileInfo = $dbService->update($experience);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger2::info("Exiting EducationBusinessService.refurbishEducation()");
        return $profileInfo;
    }
    /*
     * Refer to EducationBusinessInterface
     */
    public function terminateEducation($id)
    {
        MyLogger2::info("Entering EducationBusinessService.terminateEducation()");
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbService = new EducationDataService($db);
        $profileInfo = $dbService->delete($id);
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        MyLogger2::info("Exiting EducationBusinessService.terminateEducation()");
        return $profileInfo;
    }

}


<?php

namespace App\Http\Controllers;

use Exception;
use App\Services\Business\UserBusinessService;
use App\Services\Utility\ILoggerService;
use App\Services\Utility\MyLogger2;
use App\Models\DTO;

class UserRestController extends Controller
{
    //logger variable
    protected $logger;
    
    //controller constructor with ILoggerService param
    public function __construct(ILoggerService $logger){
        $this->logger = $logger;
    }
    /**
     * Display the specified  user object array resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->logger->info("Entering UserRestController.index()");
        try{
            //new instance of business service
            $service = new UserBusinessService();
            //attempts to retrieve all users
            $users = $service->retrieveAllUsers();
            //create a new DTO from found users
            $dto = new DTO(0, "OK", $users);
            //places DTO in a json list
            $json = json_encode($dto);
            //returns json list
            return $json;
        } catch (Exception $e1){
            $this->logger->error("Exception: ", array("message" => $e1->getMessage()));
            
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }
    
    /**
     * Display the specified user object resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->logger->info("Entering UserRestController.show()");
        try{
            //new instance of business service
            $service = new UserBusinessService();
            //attempts to retrieve one user by id
            $user = $service->findById($id);
            //checks if no found user
            if ($user == null){
                //create a new DTO from no users
                $dto = new DTO(-1, "User Not Found", "");
               //return dto as json list
                return json_encode($dto);
            }
                else{
                    //create a new DTO from found user
                    $dto = new DTO(0, "OK", $user);
                    //return dto as json list
                    return json_encode($dto);
                }
                
            
        } catch (Exception $e1){
            $this->logger->error("Exception: ", array("message" => $e1->getMessage()));
            
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }

}

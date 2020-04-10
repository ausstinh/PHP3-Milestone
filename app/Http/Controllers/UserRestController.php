<?php

namespace App\Http\Controllers;

use Exception;
use App\Services\Business\UserBusinessService;
use App\Services\Utility\ILoggerService;
use App\Services\Utility\MyLogger2;
use App\Models\DTO;

class UserRestController extends Controller
{
    protected $logger;
    
    public function __construct(ILoggerService $logger){
        $this->logger = $logger;
    }
    public function index()
    {
        $this->logger->info("Entering UserRestController.index()");
        try{
            $service = new UserBusinessService();
            $users = $service->retrieveAllUsers();
            
            $dto = new DTO(0, "OK", $users);
            
            $json = json_encode($dto);
            
            return $json;
        } catch (Exception $e1){
            $this->logger->error("Exception: ", array("message" => $e1->getMessage()));
            
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->logger->info("Entering UserRestController.show()");
        try{
            $service = new UserBusinessService();
            $user = $service->findById($id);
            if ($user == null){
                $dto = new DTO(-1, "User Not Found", "");
                return json_encode($dto);
            }
                else{
                    $dto = new DTO(0, "OK", $user);
 
                    return json_encode($dto);
                }
                
            
        } catch (Exception $e1){
            $this->logger->error("Exception: ", array("message" => $e1->getMessage()));
            
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }

}

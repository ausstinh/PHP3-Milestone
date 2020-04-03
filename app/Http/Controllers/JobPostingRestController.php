<?php

namespace App\Http\Controllers;

use Exception;
use App\Services\Utility\ILoggerService;
use App\Models\DTO;
use App\Services\Business\JobPostingBusinessService;

class JobPostingRestController extends Controller
{
    protected $logger;
    
    public function __construct(ILoggerService $logger){
        $this->logger = $logger;
    }
    public function index()
    {
        $this->logger->info("Entering JobPostingRestController.index()");
        try{
            $service = new JobPostingBusinessService();
            $jobs = $service->retrieveAllJobs();
            
            $dto = new DTO(0, "OK", $jobs);
            
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
            $service = new JobPostingBusinessService();
            $job = $service->retrieveJob($id);
          
            if ($job == null){
                $dto = new DTO(-1, "Job Not Found", "");
                return json_encode($dto);
            }
            else{
               
                $dto = new DTO(0, "OK",  $job);
 
                    return json_encode($dto);
                }
                
            
        } catch (Exception $e1){
            $this->logger->error("Exception: ", array("message" => $e1->getMessage()));
            
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }

}

<?php

namespace App\Http\Controllers;

use Exception;
use App\Services\Utility\ILoggerService;
use App\Models\DTO;
use App\Services\Business\JobPostingBusinessService;

class JobPostingRestController extends Controller
{
    //ilogger variable
    protected $logger;
    //controller constructor with ILoggerService param
    public function __construct(ILoggerService $logger){
        $this->logger = $logger;
    }
    /**
     * Display the specified job object array resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->logger->info("Entering JobPostingRestController.index()");
        try{
            //new instance of business service
            $service = new JobPostingBusinessService();
            //attempts to retrieve all jobs
            $jobs = $service->retrieveAllJobs();
            //create a new DTO from found jobs
            $dto = new DTO(0, "OK", $jobs);
            //places dto in json list
            $json = json_encode($dto);
            //return json list
            return $json;
        } catch (Exception $e1){
            $this->logger->error("Exception: ", array("message" => $e1->getMessage()));
            
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }
    
    /**
     * Display the specified job object resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->logger->info("Entering UserRestController.show()");
        try{
            //new instance of business service
            $service = new JobPostingBusinessService();
            //attempts to retrieve all jobs
            $job = $service->retrieveJob($id);
          //checks if job is null
            if ($job == null){
                //create a new DTO for error
                $dto = new DTO(-1, "Job Not Found", "");
              //return as json list
                return json_encode($dto);
            }
            else{
                //create a new DTO from found job
                $dto = new DTO(0, "OK",  $job);
                ///places dto in json list
                    return json_encode($dto);
                }
                
            
        } catch (Exception $e1){
            $this->logger->error("Exception: ", array("message" => $e1->getMessage()));
            
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }

}

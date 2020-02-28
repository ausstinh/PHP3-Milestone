<?php
namespace App\Interfaces\Business;


interface JobPostingBusinessInterface{
       
    public function insert($job);
    
    public function refurbish($job);
    
    public function retrieveAll();
    
    public function terminate($id);

    public function retrieve($id);
    
}

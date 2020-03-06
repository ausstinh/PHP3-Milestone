<?php
namespace App\Interfaces\Business;


interface AffinityGroupBusinessInterface{
       
    public function insert($group);
    
    public function refurbish($group);
    
    public function retrieveAll();
    
    public function terminate($id);

    public function retrieve($id);
    
}

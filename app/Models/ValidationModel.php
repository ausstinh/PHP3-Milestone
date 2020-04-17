<?php
namespace App\Models;

class ValidationModel
{
    public function validateEditProfile(){
        $rules = [
            'firstname' => 'Required | Between:4,10',
            'lastname' => 'Required | Between:4,10',
            'email' => 'Required | Between:4,30',
            'gender' => 'Required'
        ];
        return $rules;
    }
    public function validateEducation(){
        $rules = [
            'school' => 'Required | Between:4,25',
            'description' => 'Required | Between:4,50'
        ];
        return $rules;
    }
    public function validateExperience(){
        $rules = [
            'company' => 'Required | Between:4,25',
            'description' => 'Required | Between:4,50',
            'location' => 'Required | Between:4,40',
            'title' => 'Required | Between:4,30',
            'startdate' => 'Required | Between:4,20',
            'enddate' => 'Required | Between:4,20'
        ];
        return $rules;
    }
    public function validateSkill(){
        $rules = [
            'description' => 'Required | Between:4,50'
        ];
        return $rules;
    }
    public function validateLoginForm(){
        $rules = [
            'email' => 'Required | Between:4,30',
            'password' => 'Required | Between:4,10'
        ];
        return $rules;
    }
    public function validateRegisterForm(){
        $rules = [
            'firstname' => 'Required | Between:4,10',
            'lastname' => 'Required | Between:4,10',
            'email' => 'Required | Between:4,30',
            'gender' => 'Required'
        ];
        return $rules;
    }
    public function validateGroup(){
        $rules = [
            'name' => 'Required | Between:4,10',
            'description' => 'Required | Between:4,50',     
        ];
        return $rules;
    }
    public function validateSearchJob(){
        $rules = [
            'search' => 'Required',
        ];
        return $rules;
    }
    public function validateJob(){
        $rules = [
            'name' => 'Required | Between:4,25',
            'description' => 'Required | Between:4,25',
            'location' => 'Required | Between:4,25',
            'salary' => 'Required | Between:4,25',
        ];
        return $rules;
    }
}


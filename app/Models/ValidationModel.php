<?php
namespace App\Models;

class ValidationModel
{
    /**
     * @return array
     */
    public function validateEditProfile(){
        $rules = [
            'firstname' => 'Required | Between:4,20',
            'lastname' => 'Required | Between:4,20',
            'email' => 'Required | Between:4,30',
            'gender' => 'Required'
        ];
        return $rules;
    }
    /**
     * @return array
     */
    public function validateEducation(){
        $rules = [
            'school' => 'Required | Between:4,25',
            'description' => 'Required | Between:4,50'
        ];
        return $rules;
    }
    /**
     * @return array
     */
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
    /**
     * @return array
     */
    public function validateSkill(){
        $rules = [
            'description' => 'Required | Between:4,50'
        ];
        return $rules;
    }
    /**
     * @return array
     */
    public function validateLoginForm(){
        $rules = [
            'email' => 'Required | Between:4,30',
            'password' => 'Required | Between:4,30'
        ];
        return $rules;
    }
    /**
     * @return array
     */
    public function validateRegisterForm(){
        $rules = [
            'firstname' => 'Required | Between:4,20',
            'lastname' => 'Required | Between:4,20',
            'email' => 'Required | Between:4,30',
            'password' => 'Required | Between:4,30',
            'gender' => 'Required'
        ];
        return $rules;
    }
    /**
     * @return array
     */
    public function validateGroup(){
        $rules = [
            'name' => 'Required | Between:4,30',
            'description' => 'Required | Between:4,50',     
        ];
        return $rules;
    }
    /**
     * @return array
     */
    public function validateSearchJob(){
        $rules = [
            'search' => 'Required',
        ];
        return $rules;
    }
    /**
     * @return array
     */
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


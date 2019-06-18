<?php

namespace App;



class PasswordValidator 
{
    public function check($password ,$admin=false){

        if($admin && strlen($password)<10){
            return false;
        }
        if(strlen($password)<8){
            return false;
        }
        if(!(preg_match_all('/[A-Z]/',$password) >=1)){
            return false;
        }
        if(!(preg_match_all('/[a-z]/',$password) >=1)){
            return false;
        }
        return true;
        
    }
}

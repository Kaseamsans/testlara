<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\ValidationException;

class Hospital extends Model
{
    public $table = "hospitals";
    public $timestamps = true;

    static function create($name,$address,$numberOfBeds,$numberOfDoctors)
    {
        if(is_null($name) || strlen($name) == 0){
            throw new ValidationException("Invalid Name");
        }
        $model = new Hospital();
        $model->name = $name;
        $model->address = $address;
        $model->numberOfBeds = is_numeric($numberOfBeds) && $numberOfBeds >0 ? intval($numberOfBeds) : 0;
        $model->numberOfDoctors = is_numeric($numberOfDoctors) && $numberOfDoctors >0 ? intval($numberOfDoctors) : 0;
        return $model;
    }
}

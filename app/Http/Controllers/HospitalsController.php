<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use Carbon\Carbon;
use DateTime;
use App\Hospital;

class HospitalsController extends Controller
{
    
    public function findAll(){
        //$hospitals = DB::table("hospitals")->get();
        $hospitals = Hospital::all();
        //$result=["hosptials"=>$hospitals];
        $result = $hospitals;
        return response()->json($result);
    }

    public function findById($id){
        //$hospitals = DB::table("hospitals")->where('id',$id)->get();
        $hospitals = Hospital::find($id);
        if(empty($hospitals)){
            abort(404, 'Not found');
        }
        $result = $hospitals;
        return response()->json($result);
    }

    public function addHospital(Request $req){
        try{
        
        $name = $req->input("name");
        $address = $req->input("address");
        $numberOfBeds = $req->input("numberOfBeds");
        $numberOfDoctors = $req->input("numberOfDoctors");
        $created_at = new DateTime();
        $updated_at = new DateTime();
        
        $id = DB::table("hospitals")
            ->insertGetId([
                      "name"=>$name,
                      "address"=>$address,
                      "numberOfBeds"=>$numberOfBeds,
                      "numberOfDoctors"=>$numberOfDoctors,
                      "created_at"=>$created_at,
                      "updated_at"=>$updated_at
                      ]);
        return response()->json(["status"=>"Insert Sucesses ","id"=>$id]);
        }
        catch(Exception $e){
            return response("Datebase Connectino Error","500");
        }
    }

    public function deleteHospital($id){
        try{
            $user = Hospital::find($id);

            $user->delete();

            return response()->json(["status"=>"Delete Sucesses ",]);
        }
        catch(Exception $e){
            return response("Datebase Connectino Error","500");
        }
    }

    public function updateHospital($id,Request $req){
        try{
            $name = $req->input("name");
            $address = $req->input("address");
            $numberOfBeds = $req->input("numberOfBeds");
            $numberOfDoctors = $req->input("numberOfDoctors");
            $user = Hospital::find($id);
            
            if(isset($name)){
                $user->name = $name;
            }
            if(!isset($address)){
                $user->address = $address;
            }
            if(isset($numberOfBeds)){
                $user->numberOfBeds = $numberOfBeds;
            }
            if(isset($numberOfDoctors)){
                $user->numberOfDoctors = $numberOfDoctors;
            }

           
            $user->save();

            return response()->json(["status"=>"Update Sucess ",]);
        }
        catch(Exception $e){
            return response("Datebase Connectino Error","500");
        }
    }
}

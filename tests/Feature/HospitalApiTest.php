<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Hospital;

use Illuminate\Http\Request;
use GuzzleHttp\Client as Client;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HospitalApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testGetAllHospital()
    {   
        factory(Hospital::class,10)->create();
        
        $url = "http://127.0.0.1/api/hospitals";
        //$client = new Client();

        $res = $this->get($url);

        $res->assertStatus(200);
        $res->assertJsonCount(10);


        
    }
    public function testWhenHospitalNotFound(){
        factory(Hospital::class,10)->create();

        $not_found_index = 11;
        $url = "http://127.0.0.1/api/hospitals/".$not_found_index;
        $res = $this->get($url);

        $res->assertStatus(404);
    }

    public function testGetOneHospital(){
        $expected = factory(Hospital::class)->create();
        factory(Hospital::class,10)->create();

        $url = "http://127.0.0.1/api/hospitals/".$expected->id;
        $res = $this->get($url);

        $res->assertStatus(200);
        $res->assertJson(["id"=>$expected->id]);


    }
}

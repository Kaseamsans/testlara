<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Hospital;
use App\Exceptions\ValidationException;

class HospitalModelTest extends TestCase{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;

    protected function setUp() : void {
        parent::setUp();

    } 
    public function testCreateModel()
{
        $name = "My Hospital";
        $address = "Somewhere";
        $numberOfBads = 20;
        $numberOfDoctors = 2000;

        $hospital =  Hospital::create($name,$address,$numberOfBads,$numberOfDoctors);

        $this->assertEquals($name,$hospital->name,"Incorrect Hospital Name");
        $this->assertEquals($address,$hospital->address,"Incorrect Hospital Address");
        $this->assertEquals($numberOfBads,$hospital->numberOfBeds,"Incorrect Hospital numberOfBads");
        $this->assertEquals($numberOfDoctors,$hospital->numberOfDoctors,"Incorrect Hospital numberOfDocters");

    }


    public function testEmptyNameThrows(){
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid Name');

        $hospital = Hospital::create("","TEST ADDRESS",100,100);
        
        
    }
}

<?php

namespace Tests\Unit;

use App\Hospital;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HosptisalDatabaseTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;

    protected function setUp() :void{
        parent::setUp();
        factory(Hospital::class,10)->create();
    }

    public function testSaveModel()
    {
        $name = "Thammasat Hospitals";
        $address = "Phahonyothin Rd, Khlong Nueng, Khlong Luang District, Pathum Thani 12120";
        $numberOfBeds = 100000;
        $numberOfDoctors = 1000;
        $hospital = Hospital::create($name,$address,$numberOfBeds,$numberOfDoctors);

        $hospital->save();

        $this->assertDatabaseHas("hospitals",[
            'name' => $name,
            'address' => $address,
            "numberOfBeds" => $numberOfBeds,
            "numberOfDoctors" => $numberOfDoctors
        ]);
    }
    public function testUpdateModel(){
        $name = "Thammasat Hospitals";
        $address = "Phahonyothin Rd, Khlong Nueng, Khlong Luang District, Pathum Thani 12120";
        $numberOfBeds = 100000;
        $numberOfDoctors = 1000;
        $hospital = Hospital::create($name,$address,$numberOfBeds,$numberOfDoctors);
        $hospital->save();

        $new_name = "TU Hospitals";
        $hospital->name = $new_name ;
        $hospital->save();

        $this->assertDatabaseHas("hospitals",[
            'name' => $new_name
        ]);

        $this->assertDatabaseMissing("hospitals",[
            'name' => $name
        ]);
    }

    public function testGetModel(){
        $expected = factory(Hospital::class)->create();

        $actual = Hospital::find($expected->id);

        $this->assertEquals($expected->id,$actual->id);
        $this->assertEquals($expected->name,$actual->name);

    }
    public function testSaveIncrementRowCount(){
        $numberBeforeSave = Hospital::count();
        $hospital = factory(Hospital::class)->make();

        $hospital->save();

        $number = Hospital::count();
        $this->assertEquals($numberBeforeSave+1 , $number);
    }
}

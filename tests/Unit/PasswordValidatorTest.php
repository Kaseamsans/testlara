<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\PasswordValidator;

class PasswordValidatorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $validator ;

    public function setUp(): void {
        parent::setUp();
        $this->validator = new PasswordValidator;
    }

    public function testValidatorPassword()
    {
        $result = $this->validator->check("12345678");
        $this->assertFalse($result);
    }

    public function testLess8ValidatorPassword(){
        $result = $this->validator->check("Test12345"); // more than 8
        $result2 = $this->validator->check("Test"); // less than 8

        $this->assertTrue($result);
        $this->assertFalse($result2);

    }

    public function testUperValidaterPassword()
    {
        $result = $this->validator->check("test1234");
        $result2 = $this->validator->check("Test1234");

        $this->assertTrue($result2);
        $this->assertFalse($result);
    }
    public function testLowerValidaterPassword()
    {
        $result = $this->validator->check("TEST1234");
        $result2 = $this->validator->check("TESt1234");

        $this->assertTrue($result2);
        $this->assertFalse($result);
    }
    public function testAdminValidatorPassword()
    {
        $result = $this->validator->check("Test56789",true);
        $result2 = $this->validator->check("Test567891",true);

        $this->assertTrue($result2);
        $this->assertFalse($result);
    }
}

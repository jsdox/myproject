<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ExampleTest extends TestCase
{
    /********************** SESSION 5 ENDS*************************************************/
    use WithFaker, RefreshDatabase;
    private $data;
    public function setUp(): void {
        parent::setUp();
        $this->data = ['name' => $this->faker->name, 'email' => $this->faker->email, 'password' => $this->faker->password];
    }
    /**
     * A basic test example.
     *
     * @return void
     */    
    public function testBasicTest()
    {
        $this->get('api/')->assertSee("Laravel")->assertStatus(200);
    }

    public function testEmail()
    {
        $this->withExceptionHandling();
        $this->post('api/save', $this->data)->assertSee("data_saved")->assertStatus(200);
    }
    
    public function testEmailEmpty()
    {
        $this->data['email'] = '';
        $this->post('api/save', $this->data)->assertSee("The email field is required")->assertStatus(200);
    }

    public function testEmailValid()
    {
        $this->data['email'] = 'testmailintor.com';
        $this->post('api/save', $this->data)->assertSee("The email format is invalid")->assertStatus(200);
    }
    
    public function testNameEmpty()
    {
        $this->data['name'] = '';
        $this->post('api/save', $this->data)->assertSee("The name field is required")->assertStatus(200);
    }

    public function testPasswordEmpty()
    {
        $this->data['password'] = '';
        $this->post('api/save', $this->data)->assertSee("The password field is required")->assertStatus(200);
    }

    public function testLoginRoute()
    {
        $this->get('api/login')->assertRedirect('api/dashboard');
    }
    /********************** SESSION 5 ENDS*************************************************/
    /********************** SESSION 3 STARTS*************************************************/
    public function testHelloWorld() {
        $this->assertTrue(true);
        $this->assertFalse(false);
        $this->assertEquals(10, 10);
    }

    public function testProducer()
    {
        $this->assertTrue(true);
        return 'nike';
    }
    
    /**
     * @depends testProducer
     */
    public function testConsumer($product)
    {
        $this->assertEquals('nike', $product );
    }
    
    /**
     * @dataProvider additionalProvider
     */
    public function testAdd($a, $b, $expected)
    {
       $this->assertEquals($expected, $a + $b);
    }

    public function additionalProvider()
    {
        return [[1, 1, 2], [2, 2, 4]];
    }

//    public function testException()
//    {
//        $this->expectException(InvalidArgumentException::class);
//    }
//    /**
//     * @expectedException InvalidArgumentException
//     */
//    public function testAnotherException()
//    {
//
//    }

    /********************** SESSION 3 ENDS*************************************************/

}


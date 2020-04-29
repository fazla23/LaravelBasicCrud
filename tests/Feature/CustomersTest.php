<?php

namespace Tests\Feature;

use App\User;
use App\Customer;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp():void {
        parent::setUp();
        Event::fake();
    }

    private function actingAsAdmin(){
        $this->actingAs(factory(User::class)->create([
            'email'=>'xcellofer@gmail.com',
        ]));
    }
    
    /** @test */
    public function only_logged_in_users_can_see_customers_list(){
        $response= $this->get('/customers')->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_users_can_see_customers_list(){
        $this->actingAs(factory(User::class)->create());

        $response= $this->get('/customers')->assertOk();
    }
    
    /** @test */
    public function a_customer_can_be_added_through_the_form(){

        
        //$this->withoutExceptionHandling(); //it shows us the problem

        $this->actingAsAdmin();

        $response= $this->post('/customers',$this->data());
        $this->assertCount(1,Customer::all());
    }

    /** @test */
    public function a_name_is_required(){
        
        //$this->withoutExceptionHandling(); //it shows us the problem

        $this->actingAsAdmin();

        $response= $this->post('/customers',array_merge($this->data(),['name'=>'']));

        $response ->assertSessionHasErrors('name');

        $this->assertCount(0,Customer::all());
    }

    /** @test */
    public function a_name_at_least_has_3_characters(){
        //Event::fake(); //this line is replaced by the setup function
        //$this->withoutExceptionHandling(); //it shows us the problem

        $this->actingAsAdmin();

        $response= $this->post('/customers',array_merge($this->data(),['name'=>'a']));

        $response ->assertSessionHasErrors('name');

        $this->assertCount(0,Customer::all());
    }

    /** @test */
    public function a_email_is_required(){
        
        //$this->withoutExceptionHandling(); //it shows us the problem

        $this->actingAsAdmin();

        $response= $this->post('/customers',array_merge($this->data(),['email'=>'']));

        $response ->assertSessionHasErrors('email');

        $this->assertCount(0,Customer::all());
    }

    /** @test */
    public function valid_email_is_required(){
        
        //$this->withoutExceptionHandling(); //it shows us the problem

        $this->actingAsAdmin();

        $response= $this->post('/customers',array_merge($this->data(),['email'=>'testtest.com']));

        $response ->assertSessionHasErrors('email');

        $this->assertCount(0,Customer::all());
    }


    private function data(){
        return [
            'name'=>'test-user',
            'email'=>'test@test.com',
            'active'=>1,
            'company_id'=>1,
        ];
    }
}

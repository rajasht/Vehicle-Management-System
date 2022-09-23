<?php

namespace Tests\Feature;

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    

    /**
     * A test to check redirection of register button
     *  @test
     *
     * @return void
     */
    public function rendering_user_register_screen()
    {
        $response = $this->get('/register');
        $response-> assertStatus(200);
    }
    /**
     * A test to check redirection of login button
     *  @test
     *
     * @return void
     */
    public function rendering_login_screen()
    {
        $response = $this->get('/login');
        $response-> assertStatus(200);
    }
    
     /**
     * A test to check redirection of register button
     *  @test
     *
     * @return void
     */
    public function rendering_order_page()
    {
        $response = $this->get('/order');
        $response-> assertStatus(200);
    }


    /**
     * A test to create user and add it into the user table as record
     *  A test to check database element contaings
     *  @test
     *
     * @return void
     */
    public function user_creation()
    {
    
        $payload = [
            "first_name" => "Rajam",
            "last_name" => "patidar",
            "phone" => "9123880010",
            "address" => "BD-14, Street No. 2, AC City Peru",
            "email" => "rajaan@example.com",
            "password" => "1200334",
            "user_type" => 2,
            "interest" => 1,
            "car_id" => 10
        ];
        $this->json('post', 'api/users', $payload)
             ->assertStatus(Response::HTTP_CREATED)
             ->assertJsonStructure(
                 [
                     'data' => [
                         'id',
                         'first_name',
                         'last_name',
                         'phone',
                         'address',
                         'email',
                         'password',
                         'user_type',
                         'interest',
                         'car_id',
                         ]
                 ]
             );
        $this->assertDatabaseHas('users', $payload);
        $this->assertDatabaseMissing('users', ["first_name" => "Sanjay"]);
    }

    /**
     * A test to check to new user duplicacy
     *
     *  @test
     *
     * @return void
     */

    public function new_user_duplicacy()
    {
        $user1 = User::make([
           "first_name" => "Rajat",
           "last_name" => "patidar",
           "phone" => "9123880010",
           "address" => "BD-14, Street No. 2, AC City Peru",
           "email" => "rajatpa@example.com",
           "password" => "1200334",
           "user_type" => 2,
           "interst" => 1,
           "car_id" => 17

        ]);
        $user2 = User::make([
           "first_name" => "Rani",
           "last_name" => "Lali",
           "phone" => "9120003334",
           "address" => "BZ-13, Street No. 20, ABC City Sumeru",
           "email" => "rani@example.com",
           "password" => "117733",
           "user_type" => 2,
           "interst" => 1,
           "car_id" => 19
        ]);
        $this->assertTrue($user1->email != $user2->email);
    }

     /**
     * A test to delete user from the user table
     *
     *  @test
     *
     * @return void
     */
    
    public function delete_user()
    {
            $user = User::factory()->count(1)->make();
            $user = User::first(); // for deleting very first user details
        if ($user) {
                $user->delete();
        }
            $this->assertTrue(true);
    }

     /**
    * A test to password repeatition during user from the user table
    *
    *  @test
    *
    * @return void
    */
    public function test_Repeat_Password_insertion()
    {
                $userData = [
                "first_name" => "John",
                "last_name" => "Doe",
                "phone" => 9988776655,
                "email" => "doe@example.com",
                "address" => "A52, Sainik Vihar, New delhi",
                "password" => "demo12345",
                ];
                $this->json('POST', '/register', $userData, ['Accept' => 'application/json'])
                ->assertStatus(422);
    }


    public function test_get_all_users_route()
    {
        
        $this->post('api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => "9988123450" ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
        ])->assertCreated();
        $this->post('api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => "9988123459" ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
        ])->assertCreated();
        
        $this->get('api/users')->assertStatus(200);
    }

    public function test_get_user_by_id_route()
    {
        
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
        ]);
        
        $this->call('GET', 'api/users/1')
            ->assertStatus(200);
    }
    
    
    public function test_get_customer()
    {
        
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
        ]);
        
        $this->call('GET', 'api/users')
            ->assertStatus(200);
    }

    public function test_dealer_presense_in_database()
    {
        
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
        ]);
        
        $this->post('/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 3,
            'interest' => 1
        ]);
        
        $this
            ->call('GET', 'api/users?type=dealer')
            ->assertStatus(400)
            ->assertJsonCount(3);
    }
}

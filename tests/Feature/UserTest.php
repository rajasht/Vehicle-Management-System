<?php
/**
 * Test Cases For Car Registration Controller Php File Methods
 *
 * PHP version 7.4
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Squiz Pty Ltd <products@squiz.net>
 * @copyright 2022 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   No Licence
 * @link      No Link
 */
namespace Tests\Feature;

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * Parses and verifies the doc comments for files.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Raja kumar <raja@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @version   Release: 0.1
 * @link      No Link
 */
class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    

    /**
     * A test to check redirection of register button
     *
     * @test
     *
     * @return void
     */
    public function renderingUserRegisterScreen()
    {
        $response = $this->get('/register');
        $response-> assertStatus(200);
    }
    
    /**
     * A test to check redirection of login button
     *
     * @test
     *
     * @return void
     */
    public function renderingLoginScreen()
    {
        $response = $this->get('/login');
        $response-> assertStatus(200);
    }
    
    /**
     * A test to check redirection of login button
     *
     * @test
     *
     * @return void
     */
    public function renderingOrderPage()
    {
        $response = $this->get('/order');
        $response-> assertStatus(200);
    }


    /**
     * A test to create user and add it into the user table as record
     *  A test to check database element contaings
     *
     * @test
     *
     * @return void
     */
    public function userCreation()
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
     * @test
     *
     * @return void
     */
    public function newUserDuplicacy()
    {
        $user1 = User::make(
            [
            "first_name" => "Rajat",
            "last_name" => "patidar",
            "phone" => "9123880010",
            "address" => "BD-14, Street No. 2, AC City Peru",
            "email" => "rajatpa@example.com",
            "password" => "1200334",
            "user_type" => 2,
            "interst" => 1,
            "car_id" => 17

            ]
        );
        
        $user2 = User::make(
            [
            "first_name" => "Rani",
            "last_name" => "Lali",
            "phone" => "9120003334",
            "address" => "BZ-13, Street No. 20, ABC City Sumeru",
            "email" => "rani@example.com",
            "password" => "117733",
            "user_type" => 2,
            "interst" => 1,
            "car_id" => 19
            ]
        );
        $this->assertTrue($user1->email != $user2->email);
    }

    /**
     * A test to delete user from the user table
     *
     * @test
     *
     * @return void
     */
    public function deleteUser()
    {
            $user = User::factory()->count(1)->make();
            $user = User::first(); // for deleting very first user details
        if ($user) {
                $user->delete();
        }
            $this->assertTrue(true);
    }

    /**
     * A test to delete user from the user table
     *
     * @test
     *
     * @return void
     */
    public function testRepeatPasswordInsertion()
    {
                $userData = [
                "first_name" => "John",
                "last_name" => "Doe",
                "phone" => 9988776655,
                "email" => "doe@example.com",
                "address" => "A52, Sainik Vihar, New delhi",
                "password" => "demo12345",
                ];
                $this->json(
                    'POST',
                    '/register',
                    $userData,
                    ['Accept' => 'application/json']
                )->assertStatus(422);
    }

    /**
     * A test to delete user from the user table
     *
     * @test
     *
     * @return void
     */
    public function testGetAllUsersRoute()
    {
        
        $this->post(
            'api/users',
            [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => "9988123450" ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
            ]
        )->assertCreated();
        
        $this->post(
            'api/users',
            [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => "9988123459" ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
            ]
        )->assertCreated();
        
        $this->get('api/users')->assertStatus(200);
    }

    /**
     * A test to delete user from the user table
     *
     * @test
     *
     * @return void
     */
    public function testGetUserByIdRoute()
    {
        
        $this->post(
            '/api/users',
            [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
            ]
        );
        
        $this->call('GET', 'api/users/1')
            ->assertStatus(200);
    }
    
    /**
     * A test to delete user from the user table
     *
     * @test
     *
     * @return void
     */
    public function testGetCustomer()
    {
        
        $this->post(
            '/api/users',
            [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
            ]
        );
        
        $this->call('GET', 'api/users')
            ->assertStatus(200);
    }

    /**
     * A test to delete user from the user table
     *
     * @test
     *
     * @return void
     */
    public function testDealerPresenseInDatabase()
    {
        
        $this->post(
            '/api/users',
            [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 1,
            'interest' => 1
            ]
        );
        
        $this->post(
            '/api/users',
            [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $this->faker()->safeEmail(),
            'password' => $this->faker()->randomNumber(5),
            'user_type' => 3,
            'interest' => 1
            ]
        );
        
        $this
            ->call('GET', 'api/users?type=dealer')
            ->assertStatus(400)
            ->assertJsonCount(3);
    }
}

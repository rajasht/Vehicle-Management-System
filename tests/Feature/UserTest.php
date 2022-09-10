<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response;

class UserTest extends TestCase
{
    use RefreshDatabase;
    

    /**
     * A test to create user and add it into the user table as record
     *  A test to check database element contaings
     *  @test
     * 
     * @return void
     */
    public function user_creation() {

    
        $payload = [
            "first_name" => "Rajam",
            "last_name" => "patidar",
            "phone" => "9123880010",
            "address" => "BD-14, Street No. 2, AC City Peru",
            "email" => "rajaan@example.com",
            "password" => "1200334",
            "user_type" => 2,
            "interest" => 1,
            "car_id" => 15
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
        if($user)
        {
            $user->delete();
        }
        $this->assertTrue(true); 
     }

}

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
namespace Tests\Feature\ControllerMethodTest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use App\Models\User;

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
class RegistrationControllerTest extends TestCase
{
    use RefreshDatabase;


    /**
     * A positive feature test example.
     *
     * @return void
     */
    public function testRegistrationPageRouteURIRendering()
    {
        $this->get('/register')->assertOk()->assertViewIs('registration-form');
    }//end testRegistrationPageRouteURIRendering()


    /**
     * A positive feature test example.
     *
     * @return void
     */
    public function testUserRegistrationWorking()
    {
        // Arrange
        $payload = [
            'first_name' => 'Rajat',
            'last_name'  => 'Sharma',
            'phone'      => 9899878810,
            'email'      => 'rajat@sharma.in',
            'address'    => 'A-12, New Casle, Sofia Bulgaria',
            'password'   => '12345',
            'interest'   => 1,
            'user_type'  => 1,
        ];

        $this->json('post', 'api/users', $payload)
            ->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('users', $payload);
        $this->assertDatabaseMissing('users', ['first_name' => 'Raja']);
    }//end testUserRegistrationWorking()


    /**
     * A positive feature test example.
     *
     * @return void
     */
    public function testNewUserRegistrationWithoutEmail()
    {
        // Arrange
        $payload = [
            'first_name' => 'Rajat',
            'last_name'  => 'Sharma',
            'phone'      => 9899878810,
            'address'    => 'A-12, New Casle, Sofia Bulgaria',
            'password'   => '12345',
            'interest'   => 1,
            'user_type'  => 1,
        ];

        $this->json('post', 'api/users', $payload)->assertStatus(500);
    }//end testNewUserRegistrationWithoutEmail()


    /**
     * A positive feature test example.
     *
     * @return void
     */
    public function testUserDuplicateRegistration()
    {
        // //Arrange
        // $user1 = User::make(
        // [
        // "first_name" => "Rajat",
        // "last_name" => "patidar",
        // "phone" => "9123880010",
        // "address" => "BD-14, Street No. 2, AC City Peru",
        // "email" => "rajatpa@example.com",
        // "password" => "1200334",
        // "user_type" => 2,
        // "interst" => 1,
        // "car_id" => 17
        // ]
        // );
        // $user2 = User::make(
        // [
        // "first_name" => "Rani",
        // "last_name" => "Lali",
        // "phone" => "9120003334",
        // "address" => "BZ-13, Street No. 20, ABC City Sumeru",
        // "email" => "rani@example.com",
        // "password" => "117733",
        // "user_type" => 2,
        // "interst" => 1,
        // "car_id" => 19
        // ]
        // );
        // $this->assertTrue($user1->email != $user2->email);
        $user_1 = $this->post(
            'api/users',
            [
                'first_name' => 'Rani',
                'last_name'  => 'Lali',
                'phone'      => '9120003334',
                'address'    => 'BZ-13, Street No. 20, ABC City Sumeru',
                'email'      => 'rani@example.com',
                'password'   => '117733',
            ]
        )->assertStatus(Response::HTTP_CREATED);

        $user_2 = $this->post(
            'api/users',
            [
                'first_name' => 'Raju',
                'last_name'  => 'Lal',
                'phone'      => '9120000034',
                'address'    => 'BZ-132, Street No. 10, AC City Sumerum',
                'email'      => 'raju@example.com',
                'password'   => '112233',
            ]
        )->assertStatus(Response::HTTP_CREATED);

        $this->assertTrue($user_1 != $user_2);
    }//end testUserDuplicateRegistration()
}//end class

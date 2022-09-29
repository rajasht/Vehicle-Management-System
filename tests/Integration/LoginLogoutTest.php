<?php
/**
 * Integration Test Cases For User Login Logout
 *
 * PHP version 7.4
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Raja kumar <raja@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @link      No Link
 */
namespace Tests\Integration;

use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;

/**
 * Test cases for login logout
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Raja kumar <raja@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @version   Release: 0.1
 * @link      No Link
 */
class LoginLogoutTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    private function setUpCarDatabase()
    {

        $this->post('/api/cars', [
            "car_name" => "Verna",
            "price_rs" => 1245000,
            "brand" => "Hyundai",
            "model" => "SX",
            "model_year" => 2022,
            "colors_available" => 6,
            "wheel_count" => 4,
            "fuel_type" => "Diesel",
            "record_status" => 1,
            "first_production_year" => 2006,
            "transmission" => "Manual",
            "engine_displacement_cc" => 1493,
            "seating_capacity" => 5,
            "fuel_tank_capacity_litres" => 45,
            "body_type" => "Sedan",
            "mileage_kmpl" => 25,
            "rpm" => 4000,
            "max_power_bhp" => 113,
            "max_torque_nm" => 250,
            "length_mm" => 4440,
            "width_mm" => 1729,
            "height_mm" => 1475,
            "wheel_base_mm" => 2600,
            "vin" => "1ABCD23EFGH456789",
            "engine_number" => "12ABC34567",
            "user_id" => 2
        ]); 
       
    }

    private function user_login_as_customer_user()
    {

        $email1 = $this->faker()->safeEmail();
        $password1 = $this->faker()->randomNumber(5);

        $user1 = $this->post(
            '/api/users', [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => '9988123450' ,
            'address' => $this->faker()->address(),
            'email' => $email1,
            'password' => $password1,
            'user_type' => 1,
            'interest' => 1
            ]
        )->assertCreated();

        $this->get('/login')->assertViewIs('login');
        
        Session::start();
        $this->call(
            'POST', 'user_login', [
            'email' => $email1,
            'password' => $password1,
            '_token' => csrf_token()
            ]
        )->assertRedirect('profile/customer');
    }
    

    public function testBuyNowLinksToOrderPage () 
    {

        $this->setUpCarDatabase();

        $cars = Car::all();
        $data = compact('cars');
        $this->view('dashboard', $data)->assertSee('Reset');

        $this->user_login_as_customer_user();
        $this->view('profile/customer', $data)->assertSee('Buy Now');
        $this->get('/profile/customer');
        



    }

    

}

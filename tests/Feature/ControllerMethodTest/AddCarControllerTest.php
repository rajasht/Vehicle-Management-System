<?php
/**
 * Test Cases For Add Car Controller Php File Methods
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
namespace Tests\Feature\ControllerMethodTest;

use Tests\TestCase;

/**
 * Test cases for :
 * Rediect to addcar view (positve and negative)
 * Redirection to addcarresponse view with data (positve and negative)
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Raja kumar <raja@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @version   Release: 0.1
 * @link      No Link
 */
class AddCarControllerTest extends TestCase
{
    /**
     * A positive feature test for Rediect to addcar view
     *
     * @test
     * @return response
     */
    public function rediectToAddcarviewPositive()
    {

        //Act
        // $response = $this->get(route('addcar'));
        $response = $this->get(url('/addcar'))->assertOk();

        //Assert
        $response->assertViewIs('addcar');
    }

    /**
     * A negative feature test for Rediect to addcar view
     *
     * @test
     * @return $this
     */
    public function rediectToAddcarviewNegative()
    {
        $this->get(url('/addcar'))->assertViewMissing('addcar');
    }

    /**
     * A positive feature test for Rediect to addcarresponse view with data
     *
     * @test
     * @return $this
     */
    public function redirectionToAddcarresponseViewWithDataPositive()
    {
        $this->post(
            '/addcar',
            [
            "car_details"=>
                ["car_name" => "Dzire",
                "brand" => "Maruti Suzuki",
                "transmission" => "Manual",
                "model"=> "VXI",
                "model_year"=> 2022,
                "seating_capacity"=> 5,
                "fuel_type"=> "Petrol",
                "fuel_tank_capacity_litres"=> 37,
                "mileage_kmpl"=> 23,
                "engine_displacement_cc"=> 1197,
                "body_type"=> "Sedan",
                "wheel_base_mm"=> 2450,
                "rpm"=> 6000,
                "max_power_bhp"=> 89,
                "max_torque_nm"=> 113,
                "length_mm"=> 3995,
                "width_mm"=> 1735,
                "height_mm"=> 1515,
                "vin"=> "4ABCD56EFGH789012",
                "engine_number"=> "45ABC67890",
                "price_rs"=> 728000,
                "colors_available"=> 6,
                "wheel_count"=> 4,
                "record_status"=> 1],
            "user_id"=> 2,
            "listing_status" => "Pending"
            ]
        )->assertViewIs('addcarresponse');
    }
    
    /**
     * A positive feature test for Rediect to addcarresponse view with data
     *
     * @test
     * @return $this
     */
    public function redirectionToAddcarresponseViewWithDataNegative()
    {
        $this->post(
            '/addcar',
            [
            "car_details"=>
                ["car_name" => "Dzire",
                "brand" => "Maruti Suzuki",
                "transmission" => "Manual",
                "model"=> "VXI",
                "model_year"=> 2022,
                "seating_capacity"=> 5,
                "fuel_type"=> "Petrol",
                "fuel_tank_capacity_litres"=> 37,
                "mileage_kmpl"=> 23,
                "engine_displacement_cc"=> 1197,
                "body_type"=> "Sedan",
                "wheel_base_mm"=> 2450,
                "rpm"=> 6000,
                "max_power_bhp"=> 89,
                "max_torque_nm"=> 113,
                "length_mm"=> 3995,
                "width_mm"=> 1735,
                "height_mm"=> 1515,
                "vin"=> "4ABCD56EFGH789012",
                "engine_number"=> "45ABC67890",
                "price_rs"=> 728000,
                "colors_available"=> 6,
                "wheel_count"=> 4,
                "record_status"=> 1],
            "user_id"=> 2,
            "listing_status" => "Pending"
            ]
        )->assertViewMissing('addcarresponse');
    }
}

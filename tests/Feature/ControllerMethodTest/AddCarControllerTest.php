<?php

namespace Tests\Feature\ControllerMethodTest;

use Tests\TestCase;

class AddCarControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    

    public function test_of_rediect_to_addcar_view_positive()
    {
        // $response = $this->get(route('addcar'));
        $response = $this->get(url('/addcar'));
        $response->assertOk();
        $response->assertViewIs('addcar');
    }

    public function test_of_rediect_to_addcar_view_negative()
    {
        $response = $this->get(url('/addcar'))->assertOk();
        $response->assertViewIs('login');
    }

    public function test_redirection_to_addcarresponse_view_with_data_positive()
    {
        $response = $this->post('/addcar',[
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
        ]);

        $response->assertOk();
        $response->assertViewIs('addcarresponse');
    }
    
    public function test_redirection_to_addcarresponse_view_with_data_negative()
    {
        $response = $this->post('/addcar',[
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
        ]);

        $response->assertOk();
        $response->assertViewIs('login');
    }

}
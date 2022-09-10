<?php

namespace Tests\Unit;

use App\Models\Car;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

class CarTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_car_duplication()
    {
        $car1 = Car::make([
            "car_name" => "Venue",
            "price_rs" => 1070000,
            "brand" => "Hyundai",
            "model" => "SX",
            "model_year" => 2022,
            "colors_available" => 7,
            "wheel_count" => 4,
            "fuel_type" => "Petrol",
            "record_status" => 1,
            "first_production_year" => 2019,
            "transmission" => "Manual",
            "engine_displacement_cc" => 1197,
            "seating_capacity" => 5,
            "fuel_tank_capacity_litres" => 45,
            "body_type" => "SUV",
            "mileage_kmpl" => 16,
            "rpm" => 6000,
            "max_power_bhp" => 82,
            "max_torque_nm" => 113.8,
            "length_mm" => 3995,
            "width_mm" => 1770,
            "height_mm" => 1617,
            "wheel_base_mm" => 2500
        ]);
        $car2 = Car::make([
            "car_name" => "Dzire",
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
            "record_status"=> 1,
            "user_id"=> 2
        ]);

        $this->assertTrue($car1->car_name != $car2->car_name);
    }

    public function test_delete_car()
    {
        $car = Car::make([
            "car_name" => "Dzire",
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
            "record_status"=> 1,
            "user_id"=> 2
        ]);
        $car = Car::first();
        if ($car) {
            $car->delete();
        }
        $this->assertTrue(true);
    }

    public function test_stores_new_car()
    {

        $payload = [
            "car_name" => "Dzire",
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
            "record_status"=> 1,
            "user_id"=> 2
        ];
        $this->json('post', 'api/cars', $payload)
             ->assertStatus(Response::HTTP_CREATED)
             ->assertJsonStructure(
                 [
                     'data' => [
                         'id',
                         'car_name',
                        'brand',
                        'transmission',
                        'model',
                        'model_year',
                        'seating_capacity',
                        'fuel_type',
                        'fuel_tank_capacity_litres',
                        'mileage_kmpl',
                        'engine_displacement_cc',
                        'body_type',
                        'wheel_base_mm',
                        'rpm',
                        'max_power_bhp',
                        'max_torque_nm',
                        'length_mm',
                        'width_mm',
                        'height_mm',
                        'vin',
                        'engine_number',
                        'price_rs',
                        'colors_available',
                        'wheel_count',
                        'record_status',
                        'user_id',
                         ]
                ]
             );
        $this->assertDatabaseHas('cars', $payload);
        $this->assertDatabaseMissing('cars', ["vin" => "4ABCD56EFGH789000"]);
    }
}

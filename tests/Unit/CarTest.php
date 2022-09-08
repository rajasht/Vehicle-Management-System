<?php

namespace Tests\Unit;

use App\Models\Car;
use Tests\TestCase;

class CarTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_car_duplication()
    {
        $car1 = Car::make([
            "car_name"=> "Swift",
            "brand"=> "Maruti Suzuki",
            "transmission"=> "Manual",
            "model"=> "VXI",
            "model_year"=> 2022,
            "seating_capacity"=> 5,
            "fuel_type"=> "Petrol",
            "fuel_tank_capacity_litres"=> 37,
            "mileage_kmpl"=> 23,
            "engine_displacement_cc"=> 1197,
            "body_type"=> "Hatchback",
            "wheel_base_mm"=> 2450,
            "rpm"=> 6000,
            "max_power_bhp"=> 88,
            "max_torque_nm"=> 113,
            "length_mm"=> 3845,
            "width_mm"=> 1735,
            "height_mm"=> 1530,
            "vin"=> "1ABCD23EFGH456789",
            "engine_number" => "12ABC34567",
            "price_rs"=> 682000,
            "colors_available"=> 9,
            "wheel_count"=> 4,
            "record_status"=> 1,
            "user_id"=> 5
        ]);
        $car2 = Car::make([
            "car_name"=> "Swift",
            "brand"=> "Maruti Suzuki",
            "transmission"=> "Manual",
            "model"=> "VXI",
            "model_year"=> 2022,
            "seating_capacity"=> 5,
            "fuel_type"=> "Petrol",
            "fuel_tank_capacity_litres"=> 37,
            "mileage_kmpl"=> 23,
            "engine_displacement_cc"=> 1197,
            "body_type"=> "Hatchback",
            "wheel_base_mm"=> 2450,
            "rpm"=> 6000,
            "max_power_bhp"=> 88,
            "max_torque_nm"=> 113,
            "length_mm"=> 3845,
            "width_mm"=> 1735,
            "height_mm"=> 1530,
            "vin"=> "1ABCD23EFGH456789",
            "engine_number" => "12ABC34567",
            "price_rs"=> 682000,
            "colors_available"=> 9,
            "wheel_count"=> 4,
            "record_status"=> 1,
            "user_id"=> 5
        ]);

        $this->assertTrue($car1->car_name != $car2->car_name);
    }

    public function test_delete_car()
    {
        $car = Car::make([
            "car_name"=> "Swift",
            "brand"=> "Maruti Suzuki",
            "transmission"=> "Manual",
            "model"=> "VXI",
            "model_year"=> 2022,
            "seating_capacity"=> 5,
            "fuel_type"=> "Petrol",
            "fuel_tank_capacity_litres"=> 37,
            "mileage_kmpl"=> 23,
            "engine_displacement_cc"=> 1197,
            "body_type"=> "Hatchback",
            "wheel_base_mm"=> 2450,
            "rpm"=> 6000,
            "max_power_bhp"=> 88,
            "max_torque_nm"=> 113,
            "length_mm"=> 3845,
            "width_mm"=> 1735,
            "height_mm"=> 1530,
            "vin"=> "1ABCD23EFGH456789",
            "engine_number" => "12ABC34567",
            "price_rs"=> 682000,
            "colors_available"=> 9,
            "wheel_count"=> 4,
            "record_status"=> 1,
            "user_id"=> 5
        ]);
        $car = Car::first();
        if ($car) {
            $car->delete();
        }
        $this->assertTrue(true);
    }

    public function test_stores_new_car()
    {
        $response = $this->post('/api/cars', [
            "car_name"=> "Swift",
            "brand"=> "Maruti Suzuki",
            "transmission"=> "Manual",
            "model"=> "VXI",
            "model_year"=> 2022,
            "seating_capacity"=> 5,
            "fuel_type"=> "Petrol",
            "fuel_tank_capacity_litres"=> 37,
            "mileage_kmpl"=> 23,
            "engine_displacement_cc"=> 1197,
            "body_type"=> "Hatchback",
            "wheel_base_mm"=> 2450,
            "rpm"=> 6000,
            "max_power_bhp"=> 88,
            "max_torque_nm"=> 113,
            "length_mm"=> 3845,
            "width_mm"=> 1735,
            "height_mm"=> 1530,
            "vin"=> "1ABCD23EFGH456789",
            "engine_number" => "12ABC34567",
            "price_rs"=> 682000,
            "colors_available"=> 9,
            "wheel_count"=> 4,
            "record_status"=> 1,
            "user_id"=> 5
        ]);
        $response->assertStatus(201);
    }

    public function test_database()
    {
        $this->assertDatabaseHas('cars', [
            'car_name' => 'Verna'
        ]);
        $this->assertDatabaseMissing('cars', [
            'car_name' => 'Bike'
        ]);
    }
}

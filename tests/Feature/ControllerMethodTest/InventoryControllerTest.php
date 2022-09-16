<?php

namespace Tests\Feature\ControllerMethodTest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\Inventory;
use PHPUnit\Framework\Constraint\Count;

class InventoryControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_whether_inventory_get_added_positive()
    {
        $response = $this->post('api/add-inventory',[
                        "vehicle_type"=>1,
                        "vehicle_type_id"=>7,
                        "added_by"=>1003,
                        "added_on"=>"2020-05-01",
                        "sold_to"=>1007,
                        "status"=>1
                    ]
                );
    
            $response->assertStatus(Response::HTTP_CREATED);
    }
    
    public function test_whether_inventory_get_added_negative()
    {
        $response = $this->post('api/add-inventory',[
                        "vehicle_type"=>1,
                        "vehicle_type_id"=>7,
                        // "added_by"=>1003,
                        "added_on"=>"2020-05-01",
                        "sold_to"=>1007,
                        "status"=>1
                    ]
                );
    
            $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_get_all_inventory_positive() {
        $this->post('api/add-inventory',[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2020-05-01",
            "sold_to"=>1007,
            "status"=>1
        ])->assertCreated();
        $this->post('api/add-inventory',[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2020-05-01",
            "sold_to"=>1007,
            "status"=>2
        ])->assertCreated();
        
        $response = $this->get('api/inventory-data');
        $this->assertEquals(2,count($response->json()['data']));
    }

    public function test_get_all_inventory_negative() {
        $this->post('api/add-inventory',[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2020-05-01",
            "sold_to"=>1007,
            "status"=>1
        ])->assertCreated();
        $this->post('api/add-inventory',[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2020-05-01",
            "sold_to"=>1007,
            "status"=>2
        ])->assertCreated();
        
        $response = $this->get('api/inventory-data');
        $this->assertEquals(1,count($response->json()['data']));
    }
    
    public function test_valid_argument_type_passed_to_method_positive() {
        $this->post('api/add-inventory',[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2020-05-01",
            "sold_to"=>1007,
            "status"=>1
        ])->assertStatus(Response::HTTP_CREATED);
        
        $this->get('api/inventory-data/1')->assertJsonFragment(["status"=>"1"]);
    }
    
    public function test_valid_argument_type_passed_to_method_negative() {
        $this->post('api/add-inventory',[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2020-05-01",
            "sold_to"=>1007,
            "status"=>1
        ])->assertStatus(Response::HTTP_CREATED);
        
        $this->get('api/inventory-data/1a')->assertJsonFragment(["status"=>"1"]);
    }


    public function test_get_inventory_by_id_positive() {
        $this->post('api/add-inventory',[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2020-05-01",
            "sold_to"=>1007,
            "status"=>1
        ])->assertStatus(Response::HTTP_CREATED);
        $this->post('api/add-inventory',[
            "vehicle_type"=>1,
            "vehicle_type_id"=>8,
            "added_by"=>1002,
            "added_on"=>"2020-12-01",
            "sold_to"=>1008,
            "status"=>1
        ])->assertStatus(Response::HTTP_CREATED);
        
        $this->get('api/inventory-data/1')->assertJsonFragment(["added_on"=>"2020-05-01"]);
        // $this->get('api/inventory-data/2')->assertJsonFragment(["added_on"=>"2020-12-01"]);
    }

    public function test_get_inventory_by_id_negative() {
        $this->post('api/add-inventory',[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2020-05-01",
            "sold_to"=>1007,
            "status"=>1
        ])->assertStatus(Response::HTTP_CREATED);
        $this->post('api/add-inventory',[
            "vehicle_type"=>1,
            "vehicle_type_id"=>8,
            "added_by"=>1002,
            "added_on"=>"2020-12-01",
            "sold_to"=>1008,
            "status"=>1
        ])->assertStatus(Response::HTTP_CREATED);
        
        $this->get('api/inventory-data/1')->assertJsonFragment(["added_on"=>"2020-12-01"]);
        // $this->get('api/inventory-data/2')->assertJsonFragment(["added_on"=>"2020-12-01"]);
    }
    
    
    public function test_get_inventory_by_status_positive() {
        $this->post('api/add-inventory',[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2020-05-01",
            "sold_to"=>1007,
            "status"=>1
        ])->assertStatus(Response::HTTP_CREATED);
        $this->post('api/add-inventory',[
            "vehicle_type"=>1,
            "vehicle_type_id"=>8,
            "added_by"=>1002,
            "added_on"=>"2020-12-01",
            "sold_to"=>1008,
            "status"=>2
        ])->assertStatus(Response::HTTP_CREATED);
        
        $this->get('api/inventory-data/1')->assertJsonFragment(["status"=>"1"]);
        // $this->get('api/inventory-data/1')->assertJsonFragment(["status"=>"1"]);
    }
    

    public function test_get_inventory_by_status_negative() {
        $this->post('api/add-inventory',[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2020-05-01",
            "sold_to"=>1007,
            "status"=>1
        ])->assertStatus(Response::HTTP_CREATED);
        
        $this->post('api/add-inventory',[
            "vehicle_type"=>1,
            "vehicle_type_id"=>8,
            "added_by"=>1002,
            "added_on"=>"2020-12-01",
            "sold_to"=>1008,
            "status"=>2
        ])->assertStatus(Response::HTTP_CREATED);
        
        // $this->get('api/inventory-data/1')->assertJsonFragment(["status"=>"1"]);
        $this->get('api/inventory-data/2')->assertJsonFragment(["status"=>"1"]);
    }
    
    public function test_remove_inventory_record_from_table_positive() {

        $first_inventory = [
            "vehicle_type"=>1,
            "vehicle_type_id"=>8,
            "added_by"=>1002,
            "added_on"=>"2020-12-01",
            "sold_to"=>1008,
            "status"=>2
        ];

        $second_inventory =[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2021-10-01",
            "sold_to"=>1003,
            "status"=>1
        ];

        $this->post('api/add-inventory',$first_inventory)->assertStatus(Response::HTTP_CREATED);
        $this->post('api/add-inventory',$second_inventory)->assertStatus(Response::HTTP_CREATED);

        $del = $this->delete('api/remove-inventory-data',[
            "id"=>1
        ])->assertOk();

        $this->assertDatabaseMissing('inventory', ["id" =>1]);
        $this->assertDatabaseCount('inventory',1);
        $this->assertDatabaseHas('inventory', $second_inventory);
    }
    
    
    public function test_remove_inventory_record_from_table_negative() {

        $first_inventory = [
            "vehicle_type"=>1,
            "vehicle_type_id"=>8,
            "added_by"=>1002,
            "added_on"=>"2020-12-01",
            "sold_to"=>1008,
            "status"=>2
        ];

        $second_inventory =[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2021-10-01",
            "sold_to"=>1003,
            "status"=>1
        ];

        $this->post('api/add-inventory',$first_inventory)->assertStatus(Response::HTTP_CREATED);
        $this->post('api/add-inventory',$second_inventory)->assertStatus(Response::HTTP_CREATED);

        $del = $this->delete('api/remove-inventory-data',[
            "id"=>1
        ])->assertOk();

        $this->assertDatabaseMissing('inventory', ["id" =>2]);
        $this->assertDatabaseHas('inventory', $first_inventory);
        $this->assertDatabaseCount('inventory',2);
    }
    
    public function test_valid_inventory_id_passed_to_method_positive() {
        $first_inventory = [
            "vehicle_type"=>1,
            "vehicle_type_id"=>8,
            "added_by"=>1002,
            "added_on"=>"2020-12-01",
            "sold_to"=>1008,
            "status"=>2
        ];

        $second_inventory =[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2021-10-01",
            "sold_to"=>1003,
            "status"=>1
        ];

        $this->post('api/add-inventory',$first_inventory)->assertStatus(Response::HTTP_CREATED);
        $this->post('api/add-inventory',$second_inventory)->assertStatus(Response::HTTP_CREATED);

        $this->patch('api/update-inventory-status/1/1')->assertOk();
        $this->patch('api/update-inventory-status/1/2')->assertOk();
        $this->patch('api/update-inventory-status/2/1')->assertOk();
        $this->patch('api/update-inventory-status/2/2')->assertOk();

    }
    
    
    public function test_valid_inventory_id_passed_to_method_negative() {
        $first_inventory = [
            "vehicle_type"=>1,
            "vehicle_type_id"=>8,
            "added_by"=>1002,
            "added_on"=>"2020-12-01",
            "sold_to"=>1008,
            "status"=>2
        ];

        $second_inventory =[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2021-10-01",
            "sold_to"=>1003,
            "status"=>1
        ];

        $this->post('api/add-inventory',$first_inventory)->assertStatus(Response::HTTP_CREATED);
        $this->post('api/add-inventory',$second_inventory)->assertStatus(Response::HTTP_CREATED);

        $this->patch('api/update-inventory-status/2/abc')->assertOk();
        $this->patch('api/update-inventory-status/2/1a2')->assertOk();
        $this->patch('api/update-inventory-status/1/1a@')->assertOk();
        $this->patch('api/update-inventory-status/1/abc')->assertOk();
        $this->patch('api/update-inventory-status/3/1')->assertOk();
        $this->patch('api/update-inventory-status/1/_')->assertOk();

    }

    public function test_passed_argument_has_number_format_postive()
    {

        $first_inventory =[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2021-10-01",
            "sold_to"=>1003,
            "status"=>2
        ];

        $this->post('api/add-inventory',$first_inventory)
        ->assertStatus(Response::HTTP_CREATED);
        
        
        $this->get('api/inventory-status/1',$first_inventory)           // verifies inventory id and it's type
        ->assertOk()
        ->assertJsonFragment(["status"=>"Unlisted"]);                   // true for status code 0

        // $this->get('api/inventory-status/1',$first_inventory)        
        // ->assertOk()
        //->assertJsonFragment(["status"=>"Active"]);                   // true for status code 1

        $this->get('api/inventory-status/1',$first_inventory)
        ->assertOk()
        ->assertJsonFragment(["status"=>"Inactive"]);                   // true for status code 2

        $this->get('api/inventory-status/1',$first_inventory)
        ->assertOk()
        ->assertJsonFragment(["status"=>"Unknown"]);                   // true for status code other than 0, 1 and 2

    }
    
    public function test_list_all_inventories_of_of_same_status_code()
    {
        $first_inventory = [
            "vehicle_type"=>1,
            "vehicle_type_id"=>8,
            "added_by"=>1002,
            "added_on"=>"2020-12-01",
            "sold_to"=>1008,
            "status"=>2
        ];

        $second_inventory =[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2021-10-01",
            "sold_to"=>1003,
            "status"=>1
        ];
        $third_inventory = [
            "vehicle_type"=>1,
            "vehicle_type_id"=>9,
            "added_by"=>1001,
            "added_on"=>"2019-12-11",
            "sold_to"=>1009,
            "status"=>2
        ];

        $fourth_inventory =[
            "vehicle_type"=>1,
            "vehicle_type_id"=>10,
            "added_by"=>1002,
            "added_on"=>"2022-10-11",
            "sold_to"=>1007,
            "status"=>2
        ];

        $this->post('api/add-inventory',$first_inventory)->assertStatus(Response::HTTP_CREATED);
        $this->post('api/add-inventory',$second_inventory)->assertStatus(Response::HTTP_CREATED);
        $this->post('api/add-inventory',$third_inventory)->assertStatus(Response::HTTP_CREATED);
        $this->post('api/add-inventory',$fourth_inventory)->assertStatus(Response::HTTP_CREATED);


        // $this->get('api/inventories-by-status-code/1')->assertOk();
        
        $response = $this->get('api/inventories-by-status-code/2');
        $this->assertEquals(3,count($response->json()['data']));
    }
}

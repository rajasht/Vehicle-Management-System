<?php
/**
 * Test Cases For Inventory Controller Php File Methods
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

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\Inventory;
use PHPUnit\Framework\Constraint\Count;

/**
 * Test cases for :
 * Inventory Creation/addition (positve and negative)
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
class InventoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A positve feature test for Inventory Creation/addition
     *
     * @test
     * @return response
     */
    private function _setData()
    {
        $first_inventory = [
            "vehicle_type"=>1,
            "vehicle_type_id"=>8,
            "added_by"=>1002,
            "added_on"=>"2020-12-01",
            "sold_to"=>1001,
            "status"=>2
        ];

        $second_inventory =[
            "vehicle_type"=>2,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2020-12-02",
            "sold_to"=>1002,
            "status"=>1
        ];
        $third_inventory = [
            "vehicle_type"=>1,
            "vehicle_type_id"=>9,
            "added_by"=>1001,
            "added_on"=>"2020-12-03",
            "sold_to"=>1003,
            "status"=>2
        ];

        $fourth_inventory =[
            "vehicle_type"=>1,
            "vehicle_type_id"=>10,
            "added_by"=>1002,
            "added_on"=>"2020-12-04",
            "sold_to"=>1001,
            "status"=>2
        ];

        $this->post('api/add-inventory', $first_inventory)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'vehicle_type',
                        'vehicle_type_id',
                        'added_by',
                        'added_on',
                        'sold_to',
                        'status'
                    ]
                ]
            );

        $this->post('api/add-inventory', $second_inventory)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                      'data' => [
                          'id',
                          'vehicle_type',
                          'vehicle_type_id',
                          'added_by',
                          'added_on',
                          'sold_to',
                          'status'
                          ]
                  ]
            );

        $this->post('api/add-inventory', $third_inventory)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'vehicle_type',
                        'vehicle_type_id',
                        'added_by',
                        'added_on',
                        'sold_to',
                        'status'
                        ]
                ]
            );
        
        $this->post('api/add-inventory', $fourth_inventory)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'vehicle_type',
                        'vehicle_type_id',
                        'added_by',
                        'added_on',
                        'sold_to',
                        'status'
                        ]
                ]
            );
    }

    /**
     * A positve feature test for Inventory Creation/addition
     *
     * @test
     * @return response
     */
    public function inventoryGetAddedPositive()
    {
        //Arrange
        $payload = $this->post(
            'api/add-inventory',
            [
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2020-05-01",
            "sold_to"=>1007,
            "status"=>1
            ]
        );

        //Act
        $payload->assertStatus(Response::HTTP_CREATED);
    }
    
    // /**
    //  * A negative feature test for Inventory Creation/addition
    //  *
    //  * @test
    //  * @return response
    //  */
    // public function inventoryGetAddedNegative()
    // {
    //     //Arrange
    //     $payload = $this->post(
    //         'api/add-inventory',
    //         [
    //         "vehicle_type"=>1,
    //         "vehicle_type_id"=>7,
    //         "added_on"=>"2020-05-01",
    //         "sold_to"=>1007,
    //         "status"=>1
    //         ]
    //     )->assertStatus(400);

    //     //Act
    //     $payload->assertJsonMissingExact(
    //         [
    //             "added_by"=>1003,
    //         ]
    //     );
    // }
    
    /**
     * A negative feature test for Inventory Creation/addition when anydatafield left
     *
     * @test
     * @return response
     */
    public function inventoryAdditionWithoutAddedByValue()
    {
        //Arrange
        $expected_status = 400;
        $payload = $this->post(
            'api/add-inventory',
            [
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_on"=>"2020-05-01",
            "sold_to"=>1007,
            "status"=>1
            ]
        )->assertStatus(500);
    }

    /**
     * A positive feature test to get all existing inventories of table
     *
     * @test
     * @return response
     */
    public function getAllInventoryPositive()
    {
         //Arrange
         $this->_setData();
        
         //Act
         $response = $this->get('api/inventory-data')->assertStatus(200);
         $this->assertEquals(4, count($response->json()['data']));
    }

    /**
     * A negative feature test to get all existing inventories
     *
     * @test
     * @return response
     */
    public function getAllInventoryNegative()
    {
         //Arrange
         $this->_setData();
        
         //Act
         $response = $this->get('api/inventory-data')->assertStatus(200);
         $this->assertNotEquals(2, count($response->json()['data']));
    }
    
    /**
     * A positive feature test to validate passed argument type to the method
     *
     * @test
     * @return $this
     */
    public function validArgumentTypePassedToMethodPositive()
    {
        //Arrange
        $this->post(
            'api/add-inventory',
            [
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2020-05-01",
            "sold_to"=>1007,
            "status"=>1
            ]
        )->assertStatus(Response::HTTP_CREATED);
        
        //Act
        $this->get('api/inventory-data/1')->assertStatus(200)
            ->assertJsonFragment(["status"=>1]);
    }
    
    /**
     * A neagative feature test to validate passed argument type to the method
     *
     * @test
     * @return $this
     */
    public function validArgumentTypePassedToMethodNegative()
    {
        $this->post(
            'api/add-inventory',
            [
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2020-05-01",
            "sold_to"=>1007,
            "status"=>1
            ]
        )->assertStatus(Response::HTTP_CREATED);
        
        $this->get('api/inventory-data/1a')->assertStatus(404);
        $this->get('api/inventory-data/abc')->assertStatus(404);
    }

    /**
     * A positive feature test to fetch inventory based on inventory id
     *
     * @test
     * @return $this
     */
    public function getInventoryByIdPositive()
    {
        //Arrange
        $this->_setData();
        
        //Act
        $this->get('api/inventory-data/1')
            ->assertJsonFragment(["added_on"=>"2020-12-01"])
            ->assertOk();
        $this->get('api/inventory-data/2')
            ->assertJsonFragment(["added_on"=>"2020-12-02"])
            ->assertOk();
        $this->get('api/inventory-data/3')
            ->assertJsonFragment(["added_on"=>"2020-12-03"])
            ->assertOk();
        $this->get('api/inventory-data/4')
            ->assertJsonFragment(["added_on"=>"2020-12-04"])
            ->assertOk();
    }

    /**
     * A neagative feature test to fetch inventory based on inventory id
     *
     * @test
     * @return status code 404
     */
    public function getInventoryByIdNegative()
    {
        //Arrange
        $this->_setData();
        
        //Act
        $this->get('api/inventory-data/1')
            ->assertJsonMissing(["added_on"=>"2020-12-02"]);
        $this->get('api/inventory-data/2')
            ->assertJsonMissing(["added_on"=>"2020-12-04"]);
        $this->get('api/inventory-data/3')
            ->assertJsonMissing(["added_on"=>"2020-12-01"]);
        $this->get('api/inventory-data/4')
            ->assertJsonMissing(["added_on"=>"2020-12-03"]);
    }
    
    /**
     * A positive feature test to fetch inventory based on status code
     *
     * @test
     * @return $this
     */
    public function getInventoryStatusOfRespectiveInventoryIdPositive()
    {
        //Arrange
        $this->_setData();
        
        //Act
        $this->get('api/inventory-data/1')
            ->assertJsonFragment(["status"=>2]);
        $this->get('api/inventory-data/2')
            ->assertJsonFragment(["status"=>1]);
        $this->get('api/inventory-data/3')
            ->assertJsonFragment(["status"=>2]);
        $this->get('api/inventory-data/4')
            ->assertJsonFragment(["status"=>2]);
    }
    
    /**
     * A neagative feature test to fetch inventory based on status code
     *
     * @test
     * @return status code 200
     */
    public function getInventoryStatusOfRespectiveInventoryIdNegative()
    {
        //Arrange
        $this->_setData();
        
        //Act
        $this->get('api/inventory-data/1')
            ->assertJsonMissingExact(["status"=>1]);
        $this->get('api/inventory-data/2')
            ->assertJsonMissingExact(["status"=>2]);
        $this->get('api/inventory-data/3')
            ->assertJsonMissingExact(["status"=>3]);
        $this->get('api/inventory-data/4')
            ->assertJsonMissingExact(["status"=>4]);
    }
    
    /**
     * A positive feature test to remove inventory based on inventory id
     *
     * @test
     * @return status code 200
     */
    public function removeInventoryRecordFromTablePositive()
    {
        //Arrange
        $this->_setData();

        //Act
        $this->delete(
            'api/remove-inventory-data',
            ["id"=>1]
        )->assertOk();
 
        //Assert
        $this->assertDatabaseMissing('inventory', ["id" =>1]);
        $this->assertDatabaseCount('inventory', 3);
        $this->assertDatabaseHas(
            'inventory',
            ["id" =>2,"id" =>3,"id" =>4]
        );
    }
    
    /**
     * A negative feature test to remove inventory based on inventory id
     *
     * @test
     * @return status code 200
     */
    public function removeInventoryRecordFromTableNegative()
    {

        //Arrange
        $this->_setData();

        //Act
        $this->delete(
            'api/remove-inventory-data',
            ["id"=>12]
        )->assertStatus(400);
 
        // //Assert
        $this->assertDatabaseMissing('inventory', ["id" =>12]);
        $this->assertDatabaseCount('inventory', 4);
        $this->assertDatabaseHas(
            'inventory',
            ["id" =>1,"id" =>2,"id" =>3,"id" =>4]
        );
    }
    
    /**
     * A positive feature test to validate inventory id
     * passed as an argument to method
     *
     * @test
     * @return status code 200
     */
    public function validInventoryIdPassedToInventoryUpdateMethodPositive()
    {
        //Arrange
        $this->_setData();

        //Act                                           //Assert
        $this->patch('api/update-inventory-status/1/1')->assertOk();
        $this->patch('api/update-inventory-status/2/2')->assertOk();
        $this->patch('api/update-inventory-status/3/2')->assertOk();
        $this->patch('api/update-inventory-status/4/2')->assertOk();
    }
    
    /**
     * A negative feature test to validate inventory id
     * passed as an argument to method
     *
     * @test
     * @return status code 200
     */
    public function validInventoryIdPassedToInventoryUpdateMethodNegative()
    {
        //Arrange
        $this->_setData();

        //Act                                           //Assert
        $this->patch('api/update-inventory-status/5/1')->assertStatus(404);
        $this->patch('api/update-inventory-status/abc/2')->assertStatus(404);
        $this->patch('api/update-inventory-status/@#/2')->assertStatus(404);
        $this->patch('api/update-inventory-status/1a2b/1')->assertStatus(404);
    }
    
    /**
     * A positive feature test to update inventory
     * using valid status code (1 and 2 only)
     *
     * @test
     * @return status code 200
     */
    public function validInventoryStatusCodePassedToMethodForStatusUpdatePositive()
    {
        //Arrange
        $this->_setData();

        //Act                                           //Assert
        $this->patch('api/update-inventory-status/1/1')->assertOk();
        $this->patch('api/update-inventory-status/2/2')->assertOk();
        $this->patch('api/update-inventory-status/3/2')->assertOk();
        $this->patch('api/update-inventory-status/4/2')->assertOk();
    }
    
    /**
     * A negative feature test to update inventory
     * using invalid status codes (i.e other than 1 and 2)
     *
     * @test
     * @return status code 200
     */
    public function validInventoryStatusCodePassedToMethodForStatusUpdateNegative()
    {
        //Arrange
        $this->_setData();

        //Act                                           //Assert
        $this->patch('api/update-inventory-status/1/8')->assertStatus(400);
        $this->patch('api/update-inventory-status/2/7')->assertStatus(400);
        $this->patch('api/update-inventory-status/3/6')->assertStatus(400);
        $this->patch('api/update-inventory-status/4/5')->assertStatus(400);
    }

    /**
     * A feature test to validate inventory status code "Zero"
     * to gives "Unlisted" Tag and other tags ("Active","Inactive" and
     * "Unknown") remains missing from the validation result
     *
     * @test
     * @return $this
     */
    public function inventoryStatusCodeZeroGivesUnlistedTag()
    {

        //Arrange
        $payload =[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2021-10-01",
            "sold_to"=>1003,
            "status"=>0
        ];

        // Act
        $this->post('api/add-inventory', $payload)
            ->assertStatus(Response::HTTP_CREATED);
        
        
        $this->get('api/inventory-status/1', $payload)
            ->assertJsonFragment(["status"=>"Unlisted"])
            ->assertJsonMissing(
                [
                    "status"=>"Active",
                    "status"=>"Inactive",
                    "status"=>"Unknown"
                ]
            );
    }
    
    /**
     * A feature test to validate inventory status code "One"
     * to gives "Active" Tag and other tags ("Unlisted","Inactive" and
     * "Unknown") remains missing from the validation result
     *
     * @test
     * @return $this
     */
    public function inventoryStatusCodeOneGivesActiveTag()
    {

        //Arrange
        $payload =[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2021-10-01",
            "sold_to"=>1003,
            "status"=>1
        ];

        // Act
        $this->post('api/add-inventory', $payload)
            ->assertStatus(Response::HTTP_CREATED);

        $this->get('api/inventory-status/1', $payload)
            ->assertJsonFragment(["status"=>"Active"])
            ->assertJsonMissing(
                [
                    "status"=>"Unlisted",
                    "status"=>"Inactive",
                    "status"=>"Unknown"
                ]
            );
    }
    
    /**
     * A feature test to validate inventory status code "Two"
     * to gives "Inactive" Tag and other tags ("Unlisted","Active" and
     * "Unknown") remains missing from the validation result
     *
     * @test
     * @return $this
     */
    public function inventoryStatusCodeTwoGivesInactiveTag()
    {

        //Arrange
        $payload =[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2021-10-01",
            "sold_to"=>1003,
            "status"=>2
        ];

        // Act
        $this->post('api/add-inventory', $payload)
            ->assertStatus(Response::HTTP_CREATED);

        $this->get('api/inventory-status/1', $payload)
            ->assertJsonFragment(["status"=>"Inactive"])
            ->assertJsonMissing(
                [
                    "status"=>"Unlisted",
                    "status"=>"Active",
                    "status"=>"Unknown"
                ]
            );
    }
    
    /**
     * A feature test to validate inventory status code other
     * than zero, one and two gives "Unknown" Tag and other
     * tags remains missing from the validation result
     *
     * @test
     * @return $this
     */
    public function inventoryStatusCodeOtherThanZeroOneTwoGivesUnknownTag()
    {

        //Arrange
        $payload =[
            "vehicle_type"=>1,
            "vehicle_type_id"=>7,
            "added_by"=>1003,
            "added_on"=>"2021-10-01",
            "sold_to"=>1003,
            "status"=>10
        ];
        
        // Act
        $this->post('api/add-inventory', $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonMissing(
                [
                    "status"=>"Unlisted",
                    "status"=>"Active",
                    "status"=>"Inactive"
                ]
            );
    }
    
    /**
     * A positive feature test to validate the count of inventories of
     * particular status code
     *
     * @test
     * @return $this
     */
    public function fetchInventoryCountOfSameStatusCodePositive()
    {
        //Arrange
        $this->_setData();
        
        //Act1
        $response = $this->get('api/inventories-by-status-code/1');
        //Assert1
        $this->assertEquals(1, count($response->json()['data']));
        
        //Act2
        $response = $this->get('api/inventories-by-status-code/2');
        //Assert2
        $this->assertEquals(3, count($response->json()['data']));
    }
    
    /**
     * A negative feature test to validate the count of inventories of
     * particular status code
     *
     * @test
     * @return $this
     */
    public function fetchInventoryCountOfSameStatusCodeNegative()
    {
        //Arrange
        $this->_setData();
        
        //Act1
        $response = $this->get('api/inventories-by-status-code/1');
        //Assert1
        $this->assertNotEquals(5, count($response->json()['data']));
        
        //Act2
        $response = $this->get('api/inventories-by-status-code/2');
        //Assert2
        $this->assertNotEquals(2, count($response->json()['data']));
    }
    
    /**
     * A positive feature test to validate the passed argument (vehicle type code)
     * is either 1 or 2 Only
     *
     * @test
     * @return $this
     */
    public function passedVehicleTypeIdArgumentShouldBeEitherOneOrTwoOnly()
    {
        $this->_setData();
        $this->get('api/inventories-by-vehicle-type-code/1')->assertOk();
        $this->get('api/inventories-by-vehicle-type-code/2')->assertOk();
    }
    
    /**
     * A positive feature test to validate the passed argument (vehicle type code)
     * is either 1 or 2 Only
     *
     * @test
     * @return $this
     */
    public function vehicleTypeIdExceptOneOrTwoResultsUndefinedRoute()
    {
        $this->_setData();
        $this->get('api/inventories-by-vehicle-type-code/3')->assertStatus(404);
        $this->get('api/inventories-by-vehicle-type-code/10')->assertStatus(404);
        $this->get('api/inventories-by-vehicle-type-code/abc')->assertStatus(404);
        $this->get('api/inventories-by-vehicle-type-code/12ab')->assertStatus(404);
        $this->get('api/inventories-by-vehicle-type-code/1@ab9')->assertStatus(404);
    }

    /**
     * A positive feature test to validate the count of inventories of
     * particular vehicle type code
     *
     * @test
     * @return $this
     */
    public function fetchInventoryCountOfSameVehicleTypeCodePositive()
    {
        //Arrange
        $this->_setData();
        
        //Act1
        $response = $this->get('api/inventories-by-vehicle-type-code/1');
        //Assert1
        $this->assertEquals(3, count($response->json()['data']));
        
        //Act2
        $response = $this->get('api/inventories-by-vehicle-type-code/2');
        //Assert2
        $this->assertEquals(1, count($response->json()['data']));
    }
    
    /**
     * A negative feature test to validate the count of inventories of
     * particular vehicle type code
     *
     * @test
     * @return $this
     */
    public function fetchInventoryCountOfSameVehicleTypeNegative()
    {
        //Arrange
        $this->_setData();
        
        //Act1
        $response = $this->get('api/inventories-by-vehicle-type-code/1');
        //Assert1
        $this->assertNotEquals(5, count($response->json()['data']));
        
        //Act2
        $response = $this->get('api/inventories-by-vehicle-type-code/2');
        //Assert2
        $this->assertNotEquals(2, count($response->json()['data']));
    }
    
    /**
     * A positive feature test to validate the passed argument
     * (sold_to code or buyer's id ) is of Valid, Existing and of Numeric Type
     *
     * @test
     * @return $this
     */
    public function passedBuyerIdArgumentShouldBeNumericTypePositive()
    {
        $this->_setData();
        $this->get('api/inventories-by-sold-to-id/1001')->assertOk();
        $this->get('api/inventories-by-sold-to-id/1002')->assertOk();
        $this->get('api/inventories-by-sold-to-id/1003')->assertOk();
    }
    
    /**
     * A negative feature test to validate the passed argument
     * (sold_to code or buyer's id ) is of Valid, Existing and of Numeric Type
     *
     * @test
     * @return $this
     */
    public function passedBuyerIdArgumentShouldBeNumericTypeNegative()
    {
        $this->_setData();
        $this->get('api/inventories-by-sold-to-id/1010')->assertStatus(404);
        $this->get('api/inventories-by-sold-to-id/10')->assertStatus(404);
        $this->get('api/inventories-by-sold-to-id/abc')->assertStatus(404);
        $this->get('api/inventories-by-sold-to-id/12ab')->assertStatus(404);
        $this->get('api/inventories-by-sold-to-id/1@ab8')->assertStatus(404);
    }

    /**
     * A positive feature test to validate the count of inventories of
     * particular buyer user using sold_to code
     *
     * @test
     * @return $this
     */
    public function fetchInventoryCountOfSameBuyerPositive()
    {
        //Arrange
        $this->_setData();
        
        //Act1
        $response = $this->get('api/inventories-by-sold-to-id/1001');
        //Assert1
        $this->assertEquals(2, count($response->json()['data']));
        
        //Act2
        $response = $this->get('api/inventories-by-sold-to-id/1002');
        //Assert2
        $this->assertEquals(1, count($response->json()['data']));
    }
    
    /**
     * A negative feature test to validate the count of inventories of
     * particular buyer user using sold_to code
     *
     * @test
     * @return $this
     */
    public function fetchInventoryCountOfSameBuyerTypeNegative()
    {
        //Arrange
        $this->_setData();
        
        //Act1
        $response = $this->get('api/inventories-by-sold-to-id/1001');
        //Assert1
        $this->assertNotEquals(5, count($response->json()['data']));
        
        //Act2
        $response = $this->get('api/inventories-by-sold-to-id/1002');
        //Assert2
        $this->assertNotEquals(2, count($response->json()['data']));
    }
}

<?php
/**
 * Test Cases For Add Invoice Controller Php File Methods
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
class InvoiceControllerTest extends TestCase
{
    use RefreshDatabase;


    /**
     * A positve feature test for invoice Creation/addition
     *
     * @test
     * @return response
     */
    private function _setData()
    {
        $first_invoice = [
            'order_id'            => 11001,
            'vehicle_id'          => 501,
            'dealer_id'           => 103,
            'buyer_id'            => 106,
            'price'               => 728000,
            'tax_percentage'      => 12.5,
            'discount_percentage' => 15,
            'total_amount'        => 696150,
            'payment_method'      => 'UPI',
            'transaction_id'      => 'D102UPI1000',
            'verified_by'         => 'Norbert Heaney',
        ];

        $second_invoice = [
            'order_id'            => 11002,
            'vehicle_id'          => 505,
            'dealer_id'           => 102,
            'buyer_id'            => 110,
            'price'               => 793000,
            'tax_percentage'      => 12.5,
            'discount_percentage' => 15,
            'total_amount'        => 758306.25,
            'payment_method'      => 'Net Banking',
            'transaction_id'      => 'D102NB10001SBI',
            'verified_by'         => 'Adelia Goodwin',
        ];
        $third_invoice  = [
            'order_id'            => 11003,
            'vehicle_id'          => 508,
            'dealer_id'           => 103,
            'buyer_id'            => 107,
            'price'               => 2040000,
            'tax_percentage'      => 15,
            'discount_percentage' => 20,
            'total_amount'        => 1876800,
            'payment_method'      => 'Credit Card',
            'transaction_id'      => 'D105CC15001HDFC',
            'verified_by'         => 'Norbert Heaney',
        ];

        $fourth_invoice = [
            'order_id'            => 11004,
            'vehicle_id'          => 512,
            'dealer_id'           => 105,
            'buyer_id'            => 1,
            'price'               => 2275000,
            'tax_percentage'      => 18,
            'discount_percentage' => 22,
            'total_amount'        => 2093910,
            'payment_method'      => 'Net Banking',
            'transaction_id'      => 'D105NB10002HDFC',
            'verified_by'         => 'Arjun Nayak',
        ];

        $fifth_invoice = [
            'order_id'            => 11005,
            'vehicle_id'          => 510,
            'dealer_id'           => 102,
            'buyer_id'            => 1,
            'price'               => 2115000,
            'tax_percentage'      => 18,
            'discount_percentage' => 22,
            'total_amount'        => 1946646,
            'payment_method'      => 'Credit Card',
            'transaction_id'      => 'D102CC15001SBI',
            'verified_by'         => 'Ramesh Rathore',
        ];

        $this->post('api/add-invoice', $first_invoice)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                'data' => [
                    'id',
                    'order_id',
                    'vehicle_id',
                    'dealer_id',
                    'buyer_id',
                    'price',
                    'tax_percentage',
                    'discount_percentage',
                    'total_amount',
                    'payment_method',
                    'transaction_id',
                    'verified_by',
                    ],
                ]
            );

        $this->post('api/add-invoice', $second_invoice)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                'data' => [
                    'id',
                    'order_id',
                    'vehicle_id',
                    'dealer_id',
                    'buyer_id',
                    'price',
                    'tax_percentage',
                    'discount_percentage',
                    'total_amount',
                    'payment_method',
                    'transaction_id',
                    'verified_by',
                    ],
                ]
            );

        $this->post('api/add-invoice', $third_invoice)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                'data' => [
                    'id',
                    'order_id',
                    'vehicle_id',
                    'dealer_id',
                    'buyer_id',
                    'price',
                    'tax_percentage',
                    'discount_percentage',
                    'total_amount',
                    'payment_method',
                    'transaction_id',
                    'verified_by',
                    ],
                ]
            );

        $this->post('api/add-invoice', $fourth_invoice)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                'data' => [
                    'id',
                    'order_id',
                    'vehicle_id',
                    'dealer_id',
                    'buyer_id',
                    'price',
                    'tax_percentage',
                    'discount_percentage',
                    'total_amount',
                    'payment_method',
                    'transaction_id',
                    'verified_by',
                    ],
                ]
            );

        $this->post('api/add-invoice', $fifth_invoice)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                'data' => [
                    'id',
                    'order_id',
                    'vehicle_id',
                    'dealer_id',
                    'buyer_id',
                    'price',
                    'tax_percentage',
                    'discount_percentage',
                    'total_amount',
                    'payment_method',
                    'transaction_id',
                    'verified_by',
                    ],
                ]
            );
    }


    /**
     * A positve feature test for Invoice Creation/addition
     *
     * @test
     * @return response
     */
    public function invoiceGetAddedPositive()
    {
        // Arrange
        $payload = $this->post(
            'api/add-invoice',
            [
                'order_id'            => 11001,
                'vehicle_id'          => 501,
                'dealer_id'           => 103,
                'buyer_id'            => 106,
                'price'               => 728000,
                'tax_percentage'      => 12.5,
                'discount_percentage' => 15,
                'total_amount'        => 696150,
                'payment_method'      => 'UPI',
                'transaction_id'      => 'D102UPI1000',
                'verified_by'         => 'Norbert Heaney',
            ]
        );

        // Act
        $payload->assertStatus(Response::HTTP_CREATED);
    }


    /**
     * A negative feature test for Invoice Creation/addition when
     * any data field left
     *
     * @test
     * @return response
     */
    public function invoiceAdditionWithoutBuyerIdValue()
    {
        // Arrange
        $payload = $this->post(
            'api/add-invoice',
            [
                'order_id'            => 11001,
                'vehicle_id'          => 501,
                'dealer_id'           => 102,
                'price'               => 728000,
                'tax_percentage'      => 12.5,
                'discount_percentage' => 15,
                'payment_method'      => 'UPI',
                'transaction_id'      => 'D102UPI1000',
                'verified_by'         => 'Ramesh Rathore',
            ]
        );

        // Act
        $payload->assertStatus(500);
    }//end invoiceAdditionWithoutBuyerIdValue()


    /**
     * A positive feature test to get all existing invoices of table
     *
     * @test
     * @return response
     */
    public function getAllInvoicePositive()
    {
         // Arrange
         $this->_setData();

         // Act
         $response = $this->get('api/invoice')->assertStatus(200);
         $this->assertEquals(5, count($response->json()['data']));
    }//end getAllInvoicePositive()


    /**
     * A negative feature test to get all existing invoices
     *
     * @test
     * @return response
     */
    public function getAllinvoiceNegative()
    {
        // Act
        $this->get('api/invoice')->assertStatus(400);
    }//end getAllinvoiceNegative()


    /**
     * A positive feature test to validate passed argument type to the method
     *
     * @test
     * @return $this
     */
    public function validArgumentTypePassedToGetInvoiceByIdMethodPositive()
    {
        // Arrange
        $this->post(
            'api/add-invoice',
            [
                'order_id'            => 11001,
                'vehicle_id'          => 501,
                'dealer_id'           => 103,
                'buyer_id'            => 106,
                'price'               => 728000,
                'tax_percentage'      => 12.5,
                'discount_percentage' => 15,
                'total_amount'        => 696150,
                'payment_method'      => 'UPI',
                'transaction_id'      => 'D102UPI1000',
                'verified_by'         => 'Norbert Heaney',
            ]
        )->assertStatus(Response::HTTP_CREATED);

        // Act
        $this->get('api/invoice/1')
            ->assertStatus(200)
            ->assertJsonFragment(['transaction_id' => 'D102UPI1000']);
    }//end validArgumentTypePassedToGetInvoiceByIdMethodPositive()


    /**
     * A neagative feature test to validate passed argument type to the method
     *
     * @test
     * @return $this
     */
    public function validArgumentTypePassedToGetInvoiceByIdMethodNegative()
    {
        $this->post(
            'api/add-invoice',
            [
                'order_id'            => 11001,
                'vehicle_id'          => 501,
                'dealer_id'           => 103,
                'buyer_id'            => 106,
                'price'               => 728000,
                'tax_percentage'      => 12.5,
                'discount_percentage' => 15,
                'total_amount'        => 696150,
                'payment_method'      => 'UPI',
                'transaction_id'      => 'D102UPI1000',
                'verified_by'         => 'Norbert Heaney',
            ]
        )->assertStatus(Response::HTTP_CREATED);

        $this->get('api/invoice-data/1a')->assertStatus(404);
        $this->get('api/invoice-data/abc')->assertStatus(404);
    }//end validArgumentTypePassedToGetInvoiceByIdMethodNegative()


    /**
     * A positive feature test to fetch invoice based on invoice id
     *
     * @test
     * @return $this
     */
    public function getInvoiceByIdPositive()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/1')->assertJsonFragment(
            ['transaction_id' => 'D102UPI1000']
        )->assertOk();
        $this->get('api/invoice/2')->assertJsonFragment(
            ['transaction_id' => 'D102NB10001SBI']
        )->assertOk();
        $this->get('api/invoice/3')->assertJsonFragment(
            ['transaction_id' => 'D105CC15001HDFC']
        )->assertOk();
        $this->get('api/invoice/4')->assertJsonFragment(
            ['transaction_id' => 'D105NB10002HDFC']
        )->assertOk();
        $this->get('api/invoice/5')->assertJsonFragment(
            ['transaction_id' => 'D102CC15001SBI']
        )->assertOk();
    }//end getInvoiceByIdPositive()


    /**
     * A neagative feature test to fetch invoice based on invoice id
     *
     * @test
     * @return status code 404
     */
    public function getinvoiceByIdNegative()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/1')->assertJsonMissing(
            ['transaction_id' => 'D102CC15001SBI']
        )->assertOk();
        $this->get('api/invoice/2')->assertJsonMissing(
            ['transaction_id' => 'D105NB10002HDFC']
        )->assertOk();
        $this->get('api/invoice/3')->assertJsonMissing(
            ['transaction_id' => 'D102NB10001SBI']
        )->assertOk();
        $this->get('api/invoice/4')->assertJsonMissing(
            ['transaction_id' => 'D105CC15001HDFC']
        )->assertOk();
        $this->get('api/invoice/5')->assertJsonMissing(
            ['transaction_id' => 'D102UPI1000']
        )->assertOk();
    }//end getinvoiceByIdNegative()


    /**
     * A positive feature test to remove invoice based on invoice id
     *
     * @test
     * @return status code 200
     */
    public function removeInvoiceRecordFromTablePositive()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->delete(
            'api/remove-invoice',
            ['id' => 1]
        )->assertOk();

        // Assert
        $this->assertDatabaseMissing('invoices', ['id' => 1]);
        $this->assertDatabaseCount('invoices', 4);
        $this->assertDatabaseHas(
            'invoices',
            [
                'id' => 2,
                'id' => 3,
                'id' => 4,
                'id' => 5,
            ]
        );
    }//end removeInvoiceRecordFromTablePositive()


    /**
     * A negative feature test to remove invoice based on invoice id
     *
     * @test
     * @return status code 200
     */
    public function removeInvoiceRecordFromTableNegative()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->delete(
            'api/remove-invoice',
            ['id' => 12]
        )->assertStatus(400);

        // //Assert
        $this->assertDatabaseMissing('invoices', ['id' => 12]);
        $this->assertDatabaseCount('invoices', 5);
        $this->assertDatabaseHas(
            'invoices',
            [
                'id' => 1,
                'id' => 2,
                'id' => 3,
                'id' => 4,
                'id' => 5,
            ]
        );
    }//end removeInvoiceRecordFromTableNegative()


    /**
     * A positive feature test to validate passed order id as
     *  argument type to the method
     *
     * @test
     * @return $this
     */
    public function validOrderIdPassedToMethodPositive()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/order/11001')->assertStatus(200);
        $this->get('api/invoice/order/11002')->assertStatus(200);
        $this->get('api/invoice/order/11003')->assertStatus(200);
        $this->get('api/invoice/order/11004')->assertStatus(200);
        $this->get('api/invoice/order/11005')->assertStatus(200);
    }


    /**
     * A neagative feature test to validate passed order id as
     *  argument type to the method
     *
     * @test
     * @return $this
     */
    public function validOrderIdPassedToMethodNegative()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/order/1')->assertStatus(400);
        $this->get('api/invoice/order/11a')->assertStatus(400);
        $this->get('api/invoice/order/abc')->assertStatus(400);
        $this->get('api/invoice/order/1@ab4')->assertStatus(400);
        $this->get('api/invoice/order/@#1t')->assertStatus(400);
    }//end validOrderIdPassedToMethodNegative()


    /**
     * A positive feature test to fetch invoice based on order id
     *
     * @test
     * @return $this
     */
    public function getInvoiceByOrderIdPositive()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/order/11001')->assertJsonFragment(
            ['transaction_id' => 'D102UPI1000']
        );
        $this->get('api/invoice/order/11002')->assertJsonFragment(
            ['transaction_id' => 'D102NB10001SBI']
        );
        $this->get('api/invoice/order/11003')->assertJsonFragment(
            ['transaction_id' => 'D105CC15001HDFC']
        );
        $this->get('api/invoice/order/11004')->assertJsonFragment(
            ['transaction_id' => 'D105NB10002HDFC']
        );
        $this->get('api/invoice/order/11005')->assertJsonFragment(
            ['transaction_id' => 'D102CC15001SBI']
        );
    }//end getInvoiceByOrderIdPositive()


    /**
     * A neagative feature test to fetch invoice based on order id
     *
     * @test
     * @return status code 200
     */
    public function getInvoiceByOrderIdNegative()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/order/11001')->assertJsonMissingExact(
            ['transaction_id' => 'D102CC15001SBI']
        );
        $this->get('api/invoice/order/11002')->assertJsonMissingExact(
            ['transaction_id' => 'D105NB10002HDFC']
        );
        $this->get('api/invoice/order/11003')->assertJsonMissingExact(
            ['transaction_id' => 'D105NB10002HDFC']
        );
        $this->get('api/invoice/order/11004')->assertJsonMissingExact(
            ['transaction_id' => 'D102NB10001SBI']
        );
        $this->get('api/invoice/order/11005')->assertJsonMissingExact(
            ['transaction_id' => 'D102UPI1000']
        );
    }//end getInvoiceByOrderIdNegative()


    /**
     * A positive feature test to validate passed dealer id as
     *  argument type to the method
     *
     * @test
     * @return $this
     */
    public function validDealerIdPassedToMethodPositive()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/dealer/102')->assertStatus(200);
        $this->get('api/invoice/dealer/103')->assertStatus(200);
        $this->get('api/invoice/dealer/105')->assertStatus(200);
    }//end validDealerIdPassedToMethodPositive()


    /**
     * A neagative feature test to validate passed dealer id as
     *  argument type to the method
     *
     * @test
     * @return $this
     */
    public function validDealerIdPassedToMethodNegative()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/dealer/1')->assertStatus(400);
        $this->get('api/invoice/dealer/101')->assertStatus(400);
        $this->get('api/invoice/dealer/11a')->assertStatus(400);
        $this->get('api/invoice/dealer/abc')->assertStatus(400);
        $this->get('api/invoice/dealer/1@ab4')->assertStatus(400);
        $this->get('api/invoice/dealer/@#1t')->assertStatus(400);
    }//end validDealerIdPassedToMethodNegative()


    /**
     * A positive feature test to fetch invoice based on dealer id
     *
     * @test
     * @return $this
     */
    public function getInvoiceByDealerIdPositive()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/dealer/102')->assertJsonFragment(
            ['transaction_id' => 'D102NB10001SBI'],
            ['transaction_id' => 'D102CC15001SBI'],
        );

        $this->get('api/invoice/dealer/103')->assertJsonFragment(
            ['transaction_id' => 'D102UPI1000'],
            ['transaction_id' => 'D105CC15001HDFC']
        );
        $this->get('api/invoice/dealer/105')->assertJsonFragment(
            ['transaction_id' => 'D105NB10002HDFC']
        );
    }//end getInvoiceByDealerIdPositive()


    /**
     * A neagative feature test to fetch invoice based on dealer id
     *
     * @test
     * @return status code 200
     */
    public function getInvoiceByDealerIdNegative()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/dealer/102')->assertJsonMissingExact(
            ['transaction_id' => 'D102UPI1000'],
            ['transaction_id' => 'D105CC15001HDFC']
        );

        $this->get('api/invoice/dealer/103')->assertJsonMissingExact(
            ['transaction_id' => 'D102NB10001SBI'],
            ['transaction_id' => 'D105NB10002HDFC']
        );
        $this->get('api/invoice/dealer/105')->assertJsonMissingExact(
            ['transaction_id' => 'D102CC15001SBI']
        );
    }//end getInvoiceByDealerIdNegative()


    /**
     * A positive feature test to validate passed vehicle id as
     *  argument type to the method
     *
     * @test
     * @return $this
     */
    public function validVehicleIdPassedToMethodPositive()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/vehicle/501')->assertStatus(200);
        $this->get('api/invoice/vehicle/505')->assertStatus(200);
        $this->get('api/invoice/vehicle/508')->assertStatus(200);
        $this->get('api/invoice/vehicle/510')->assertStatus(200);
        $this->get('api/invoice/vehicle/512')->assertStatus(200);
    }//end validVehicleIdPassedToMethodPositive()


    /**
     * A neagative feature test to validate passed order id as
     *  argument type to the method
     *
     * @test
     * @return $this
     */
    public function validVehicleIdPassedToMethodNegative()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/vehicle/1')->assertStatus(400);
        $this->get('api/invoice/vehicle/11a')->assertStatus(400);
        $this->get('api/invoice/vehicle/abc')->assertStatus(400);
        $this->get('api/invoice/vehicle/1@ab4')->assertStatus(400);
        $this->get('api/invoice/vehicle/@#1t')->assertStatus(400);
    }//end validVehicleIdPassedToMethodNegative()


    /**
     * A positive feature test to fetch invoice based on vehicle id
     *
     * @test
     * @return status code 200
     */
    public function getInvoiceByVehicleIdPositive()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/vehicle/501')->assertJsonFragment(
            ['transaction_id' => 'D102UPI1000']
        );
        $this->get('api/invoice/vehicle/505')->assertJsonFragment(
            ['transaction_id' => 'D102NB10001SBI']
        );
        $this->get('api/invoice/vehicle/508')->assertJsonFragment(
            ['transaction_id' => 'D105CC15001HDFC']
        );
        $this->get('api/invoice/vehicle/510')->assertJsonFragment(
            ['transaction_id' => 'D102CC15001SBI']
        );
        $this->get('api/invoice/vehicle/512')->assertJsonFragment(
            ['transaction_id' => 'D105NB10002HDFC']
        );
    }//end getInvoiceByVehicleIdPositive()


    /**
     * A neagative feature test to fetch invoice based on Transaction id
     *
     * @test
     * @return status code 200
     */
    public function getInvoiceByTransactionIdNegative()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/vehicle/501')->assertJsonMissingExact(
            ['transaction_id' => 'D102CC15001SBI']
        );
        $this->get('api/invoice/vehicle/505')->assertJsonMissingExact(
            ['transaction_id' => 'D105NB10002HDFC']
        );
        $this->get('api/invoice/vehicle/508')->assertJsonMissingExact(
            ['transaction_id' => 'D105NB10001HDFC']
        );
        $this->get('api/invoice/vehicle/510')->assertJsonMissingExact(
            ['transaction_id' => 'D102NB10001SBI']
        );
        $this->get('api/invoice/vehicle/512')->assertJsonMissingExact(
            ['transaction_id' => 'D102UPI1000']
        );
    }//end getInvoiceByTransactionIdNegative()


    /**
     * A positive feature test to validate passed Transaction id as
     *  argument type to the method
     *
     * @test
     * @return $this
     */
    public function validTransactionIdPassedToMethodPositive()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/transaction/D102NB10001SBI')->assertStatus(200);
        $this->get('api/invoice/transaction/D105NB10002HDFC')->assertStatus(200);
        $this->get('api/invoice/transaction/D102CC15001SBI')->assertStatus(200);
        $this->get('api/invoice/transaction/D105CC15001HDFC')->assertStatus(200);
        $this->get('api/invoice/transaction/D102UPI1000')->assertStatus(200);
    }//end validTransactionIdPassedToMethodPositive()


    /**
     * A neagative feature test to validate passed transaction id as
     *  argument type to the method
     *
     * @test
     * @return $this
     */
    public function validTransactionIdPassedToMethodNegative()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/transaction/1')->assertStatus(400);
        $this->get('api/invoice/transaction/1a')->assertStatus(400);
        $this->get('api/invoice/transaction/bc')->assertStatus(400);
        $this->get('api/invoice/transaction/@ab4')->assertStatus(400);
        $this->get('api/invoice/transaction/1#t')->assertStatus(400);
        $this->get('api/invoice/transaction/#3ab')->assertStatus(404);
        $this->get('api/invoice/transaction/D105CC10002HDFC')->assertStatus(400);
        $this->get('api/invoice/transaction/D105NB10XY02HDFC')->assertStatus(400);
    }//end validTransactionIdPassedToMethodNegative()


    /**
     * A positive feature test to fetch invoice based on transaction id
     *
     * @test
     * @return status code 200
     */
    public function getInvoiceByTransactionIdPositive()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/transaction/D102UPI1000')
            ->assertJsonFragment(['id' => 1]);
        $this->get('api/invoice/transaction/D102NB10001SBI')
            ->assertJsonFragment(['id' => 2]);
        $this->get('api/invoice/transaction/D105CC15001HDFC')
            ->assertJsonFragment(['id' => 3]);
        $this->get('api/invoice/transaction/D105NB10002HDFC')
            ->assertJsonFragment(['id' => 4]);
        $this->get('api/invoice/transaction/D102CC15001SBI')
            ->assertJsonFragment(['id' => 5]);
    }//end getInvoiceByTransactionIdPositive()


    /**
     * A neagative feature test to fetch invoice based on transaction id
     *
     * @test
     * @return status code 200
     */
    public function getInvoiceByVehicleIdNegative()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/vehicle/501')->assertJsonMissingExact(
            ['transaction_id' => 'D102CC15001SBI']
        );
        $this->get('api/invoice/vehicle/505')->assertJsonMissingExact(
            ['transaction_id' => 'D105NB10002HDFC']
        );
        $this->get('api/invoice/vehicle/508')->assertJsonMissingExact(
            ['transaction_id' => 'D105NB10002HDFC']
        );
        $this->get('api/invoice/vehicle/510')->assertJsonMissingExact(
            ['transaction_id' => 'D102NB10001SBI']
        );
        $this->get('api/invoice/vehicle/512')->assertJsonMissingExact(
            ['transaction_id' => 'D102UPI1000']
        );
    }//end getInvoiceByVehicleIdNegative()


    /**
     * A positive feature test to fetch invoice based on minimum vehicle
     * price and maximum vehicle price range
     *
     * @test
     * @return status code 200
     */
    public function passedStartPriceAndEndPriceAreNumber()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/price/1000000/2500000')->assertOk();
    }//end passedStartPriceAndEndPriceAreNumber()


    /**
     * A megative feature test to fetch invoice based on minimum vehicle
     * price and maximum vehicle price range
     *
     * @test
     * @return status code 200
     */
    public function passedStartPriceAndEndPriceAreNotNumber()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/price/100abc/2500000')->assertStatus(400);
        $this->get('api/invoice/price/1000000/2500abc')->assertStatus(400);
        $this->get('api/invoice/price/abc/100000')->assertStatus(400);
        $this->get('api/invoice/price/1000000/abc')->assertStatus(400);
        $this->get('api/invoice/price/xyz/abc')->assertStatus(400);
        $this->get('api/invoice/price/xy12/abc')->assertStatus(400);
        $this->get('api/invoice/price/xyx/abc12')->assertStatus(400);
        $this->get('api/invoice/price/xyx/abc')->assertStatus(400);
    }//end passedStartPriceAndEndPriceAreNotNumber()


    /**
     * A positive feature test to fetch invoice based on minimum vehicle
     * price and maximum vehicle price range
     *
     * @test
     * @return status code 200
     */
    public function passedMaxPriceIsNotZero()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/price/1000000/0')->assertStatus(400);
    }//end passedMaxPriceIsNotZero()


    /**
     * A positive feature test to fetch invoice based on minimum vehicle
     * price and maximum vehicle price range
     *
     * @test
     * @return status code 200
     */
    public function passedMaxPriceIsNotLessThanMinPrice()
    {
        // Arrange
        $this->_setData();

        // Act
        $this->get('api/invoice/price/1000000/10001')->assertStatus(400);
    }
}

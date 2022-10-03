<?php
/**
 * Integration test case for new car listing
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
namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * Class for Integration test case for dealer login and add car process
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Raja kumar <raja@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @version   Release: 0.1
 * @link      No Link
 */
class DealerAddCarProcessTest extends DuskTestCase
{
    /**
     * A function to browse the flow of new car addition by dealer
     *
     * @test
     * @return $this
     */
    public function dealerAddCarProcess()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->clickLink('Login')
                    ->assertSee('User Login')
                    ->assertPathIs('/login')
                    ->type('email', 'Eve94@yahoo.com')
                    ->type('password', 11223366)
                    ->press('Login')
                    ->assertPathIs('/dealer-data/104')
                    ->assertSee('Add Car')
                    ->clickLink('Add Car')
                    ->assertPathIs('/addcar')
                    ->assertSee('Car Details')
                    ->type('car_name', 'Esteem')
                    ->type('brand', 'Maruti Suzuki')
                    ->select('transmission', 'Manual')
                    ->type('model', 'Gold')
                    ->type('model_year', 2019)
                    ->select('seats', 4)
                    ->select('fuel', 'petrol')
                    ->type('fuel_tank_capacity_litres', 24)
                    ->type('mileage_kmpl', 18)
                    ->type('engine_displacement_cc', 1300)
                    ->select('body_type', 'SUV')
                    ->type('vin', '1ABCD23EFGH456788')
                    ->type('engine_number', '12ABC34599')
                    ->type('price', 1750000)
                    ->press('List Car')
                    ->assertSee('Your Request to sell car is submitted succesfully.')
                    ->press('Logout')
                    ->assertPathIs('/login')
                    ->assertGuest();
            }
        );
    }
}

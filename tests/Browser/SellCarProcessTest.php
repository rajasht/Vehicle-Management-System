<?php
/**
 * Integration test case to send a request to admin to sell a car
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
 * Class for Integration test case for sell car process
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Raja kumar <raja@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @version   Release: 0.1
 * @link      No Link
 */
class SellCarProcessTest extends DuskTestCase
{
    /**
     * A function to browse the flow of send a request to admin for car sell
     *
     * @test
     * @return $this
     */
    public function sellCarProcess()
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
                    ->assertGuest();
            }
        );
    }
}

<?php
/**
 * Integration test cases for buy vehicle porcess flow
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

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use function PHPUnit\Framework\assertJsonStringEqualsJsonString;

/**
 * Class for Integration test case of buy vehicle porcess flow
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Raja kumar <raja@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @version   Release: 0.1
 * @link      No Link
 */
class BuyVehicleProcessTest extends DuskTestCase
{
    /**
     * A function to browse the flow of vehicle buy now flow
     *
     * @test
     * @return $this
     */
    public function buyVehicleProcess()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->press('Buy Now')
                    ->assertSee('User Login')
                    ->assertPathIs('/login')
                    ->type('email', 'Bo86@gmail.com')
                    ->type('password', '34567')
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('Tierra')
                    ->assertSee('Cart: 0')
                    ->click('@buy_now_505')
                    ->assertSee('Order Details')
                    ->type('dealer_user_id', 103)
                    ->select('payment_mode', "Net Banking")
                    ->press('Place Order')
                    ->assertSee('Order Placed successfully.');
            }
        );
    }
}

<?php
/**
 * Integration test cases for Cart Count Increase/Decrease on Addition/Removal
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
 * Integration test cases for Cart Count Increase/Decrease on Addition/Removal
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Raja kumar <raja@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @version   Release: 0.1
 * @link      No Link
 */
class DashboardAddToCartLoginAddToCartVehicleAddedTest extends DuskTestCase
{
    /**
     * A function to browse the flow of cart operation
     *
     * @test
     * @return $this
     */
    public function cartVehicleAdditionCountIncrementRemovelDecrement()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->press('Add to Cart')
                    ->assertSee('User Login')
                    ->assertPathIs('/login')
                    ->type('email', 'Bo86@gmail.com')
                    ->type('password', '34567')
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('Tierra')
                    ->assertSee('Cart: 0')
                    ->press('Add to Cart')
                    ->assertSee('Vehicle added successfully to the cart')
                    ->visit('/logout')
                    ->visit('/login')
                    ->type('email', 'Bo86@gmail.com')
                    ->type('password', '34567')
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('Tierra')
                    ->assertSee('Cart: 1')
                    ->press('Remove from Cart')
                    ->assertSee('Cart data with ID = 17 removed from cart successfully')
                    ->assertPathIs('/api/cart')
                    ->visit('/logout')
                    ->visit('/login')
                    ->type('email', 'Bo86@gmail.com')
                    ->type('password', '34567')
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('Tierra')
                    ->assertSee('Cart: 0')
                    ->clickLink('Logout')
                    ->assertGuest();
            }
        );
    }
}

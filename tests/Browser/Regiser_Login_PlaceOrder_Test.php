<?php
/**
 * Integration test cases for new user registration, login and order place
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
 * Class for Integration test case of new user registration, login and order place
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Raja kumar <raja@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @version   Release: 0.1
 * @link      No Link
 */
class Regiser_Login_PlaceOrder_Test extends DuskTestCase
{
    /**
     * A function to browse the flow of new user registration, login and order place
     *
     * @test
     * @return $this
     */
    public function newUserRegistrationLoginPlaceOrder()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->clickLink('Register')
                    ->assertSee('User Registration')
                    ->assertPathIs('/register')
                    ->type('first_name', 'Suhani')
                    ->type('last_name', 'Kumari')
                    ->type('phone', '9900991119')
                    ->type('email', 'su@hani.in')
                    ->type('address', 'B12R, Big Garden, New Goa - 730068')
                    ->type('password', '112200')
                    ->type('confirm_password', '112200')
                    ->press('Register')
                    ->assertSee('User data saved successfully')
                    ->visit('/dashboard')
                    ->assertSee('Reset')
                    ->clickLink('Login')
                    ->assertSee('User Login')
                    ->assertPathIs('/login')
                    ->type('email', 'su@hani.in')
                    ->type('password', '112200')
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('Suhani')
                    ->assertSee('Cart: 0')
                    ->click('@buy_now_510')
                    ->assertSee('Order Details')
                    ->type('dealer_user_id', 105)
                    ->select('payment_mode', "Net Banking")
                    ->press('Place Order')
                    ->assertSee('Order Placed successfully.');
            }
        );
    }
}

<?php
/**
 * Integration test cases for new user registration and login logout
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
 * Class for Integration test case of new user registration and login logout
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Raja kumar <raja@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @version   Release: 0.1
 * @link      No Link
 */
class DashboardAddToCartNewUserRegistrationTest extends DuskTestCase
{
    /**
     * A function to browse the flow of new user registration and login logout
     *
     * @test
     * @return $this
     */
    public function newUserRegistration()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->press('Add to Cart')
                    ->assertSee('User Login')
                    ->assertPathIs('/login')
                    ->press('Register')
                    ->assertSee('User Registration')
                    ->assertPathIs('/register')
                    ->type('first_name', 'Rohan')
                    ->type('last_name', 'Kumar')
                    ->type('phone', '9900990099')
                    ->type('email', 'ro@han.in')
                    ->type('address', 'B57R, Rohan Garden, New delhi - 110068')
                    ->type('password', '321321')
                    ->type('confirm_password', '321321')
                    ->press('Register')
                    ->assertSee('User data saved successfully')
                    ->visit('/dashboard')
                    ->assertSee('Reset')
                    ->clickLink('Login')
                    ->assertSee('User Login')
                    ->assertPathIs('/login')
                    ->type('email', 'ro@han.in')
                    ->type('password', '321321')
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('My Cart')
                    ->clickLink('Logout')
                    ->assertGuest();
            }
        );
    }
}

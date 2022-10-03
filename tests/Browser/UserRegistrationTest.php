<?php
/**
 * Integration test cases for new user registration, login and logout
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
 * Class for Integration test case of new user registration, login and logout
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Raja kumar <raja@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @version   Release: 0.1
 * @link      No Link
 */
class UserRegistrationTest extends DuskTestCase
{
    /**
     * A function to browse the flow of new user registration, login and logout
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
                    ->clickLink('Register')
                    ->assertSee('User Registration')
                    ->assertPathIs('/register')
                    ->type('first_name', 'Sonam')
                    ->type('last_name', 'Thakur')
                    ->type('phone', '9900990078')
                    ->type('email', 'so@nam.in')
                    ->type('address', 'B57B, Mohan Garden, New delhi - 110098')
                    ->type('password', '123123')
                    ->type('confirm_password', '123123')
                    ->press('Register')
                    ->assertSee('User data saved successfully')
                    ->visit('/dashboard')
                    ->assertSee('Reset')
                    ->clickLink('Login')
                    ->assertSee('User Login')
                    ->assertPathIs('/login')
                    ->type('email', 'so@nam.in')
                    ->type('password', '123123')
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('My Cart')
                    ->clickLink('Logout')
                    ->assertGuest();
            }
        );
    }
}

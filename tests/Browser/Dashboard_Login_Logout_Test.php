<?php
/**
 * Integration test cases for VMS Dashboard Login and Logout
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
 * Class for Integration test case of login logout from vms dahboard
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Raja kumar <raja@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @version   Release: 0.1
 * @link      No Link
 */
class Dashboard_Login_Logout_Test extends DuskTestCase
{
    /**
     * A function to browse the flow of user login and logout
     *
     * @test
     * @return $this
     */
    public function dashboardLoginLogout()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->clickLink('Login')
                    ->assertSee('User Login')
                    ->assertPathIs('/login')
                    ->type('email', 'Bo86@gmail.com')
                    ->type('password', '34567')
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('My Cart')
                    ->clickLink('Logout')
                    ->assertGuest();
            }
        );
    }
}

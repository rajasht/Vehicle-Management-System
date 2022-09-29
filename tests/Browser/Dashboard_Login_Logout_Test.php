<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Dashboard_Login_Logout_Test extends DuskTestCase
{
    /**
     * @test
     */
    public function dashboardLoginLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->clickLink('Login')
                    ->assertSee('User Login')
                    ->assertPathIs('/login')
                    ->type('email','Bo86@gmail.com')
                    ->type('password','34567')
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('My Cart')
                    ->clickLink('Logout')
                    ->assertGuest();
        });
    }
}

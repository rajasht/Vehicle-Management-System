<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserRegistrationTest extends DuskTestCase
{
    /**
     * @test
     */
    public function newUserRegistration()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->clickLink('Register')
                    ->assertSee('User Registration')
                    ->assertPathIs('/register')
                    ->type('first_name','Sonam')
                    ->type('last_name','Thakur')
                    ->type('phone','9900990078')
                    ->type('email','so@nam.in')
                    ->type('address','B57B, Mohan Garden, New delhi - 110098')
                    ->type('password','123123')
                    ->type('confirm_password','123123')
                    ->press('Register')
                    ->assertSee('User data saved successfully')
                    ->visit('/dashboard')
                    ->assertSee('Reset')
                    ->clickLink('Login')
                    ->assertSee('User Login')
                    ->assertPathIs('/login')
                    ->type('email','so@nam.in')
                    ->type('password','123123')
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('My Cart')
                    ->clickLink('Logout')
                    ->assertGuest();
        });
    }
}

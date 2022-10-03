<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Regiser_Login_PlaceOrder_Test extends DuskTestCase
{
    /**
     * @test
     */
    public function newUserRegistrationLoginPlaceOrder()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->clickLink('Register')
                    ->assertSee('User Registration')
                    ->assertPathIs('/register')
                    ->type('first_name','Suhani')
                    ->type('last_name','Kumari')
                    ->type('phone','9900991119')
                    ->type('email','su@hani.in')
                    ->type('address','B12R, Big Garden, New Goa - 730068')
                    ->type('password','112200')
                    ->type('confirm_password','112200')
                    ->press('Register')
                    ->assertSee('User data saved successfully')
                    ->visit('/dashboard')
                    ->assertSee('Reset')
                    ->clickLink('Login')
                    ->assertSee('User Login')
                    ->assertPathIs('/login')
                    ->type('email','su@hani.in')
                    ->type('password','112200')
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('Suhani')
                    ->assertSee('Cart: 0')
                    ->click('@buy_now_510')
                    ->assertSee('Order Details')
                    ->type('dealer_user_id',105)
                    ->select('payment_mode',"Net Banking")
                    ->press('Place Order')
                    ->assertSee('Order Placed successfully.');
        });
    }
}

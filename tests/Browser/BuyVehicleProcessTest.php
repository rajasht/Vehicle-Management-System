<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use function PHPUnit\Framework\assertJsonStringEqualsJsonString;

class BuyVehicleProcessTest extends DuskTestCase
{
    /**
     * @test
     */
    public function buyVehicleProcess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->press('Buy Now')
                    ->assertSee('User Login')
                    ->assertPathIs('/login')
                    ->type('email','Bo86@gmail.com')
                    ->type('password','34567')
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('Tierra')
                    ->assertSee('Cart: 0')
                    ->click('@buy_now_505')
                    ->assertSee('Order Details')
                    ->type('dealer_user_id',103)
                    ->select('payment_mode',"Net Banking")
                    ->press('Place Order')
                    ->assertSee('Order Placed successfully.');
                });
            }
}

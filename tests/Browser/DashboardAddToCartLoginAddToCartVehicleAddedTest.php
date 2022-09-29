<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DashboardAddToCartLoginAddToCartVehicleAddedTest extends DuskTestCase
{
    /**
     * @test
     */
    public function cartVehicleAdditionCountIncrementRemovelDecrement()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->press('Add to Cart')
                    ->assertSee('User Login')
                    ->assertPathIs('/login')
                    ->type('email','Bo86@gmail.com')
                    ->type('password','34567')
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('Tierra')
                    ->assertSee('Cart: 0')
                    ->press('Add to Cart')
                    ->assertSee('Vehicle added successfully to the cart')
                    ->visit('/logout')
                    ->visit('/login')
                    ->type('email','Bo86@gmail.com')
                    ->type('password','34567')
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('Tierra')
                    ->assertSee('Cart: 1')
                    ->press('Remove from Cart')
                    ->assertSee('Cart data with ID = 10 removed from cart successfully')
                    ->assertPathIs('/api/cart')
                    ->visit('/logout')
                    ->visit('/login')
                    ->type('email','Bo86@gmail.com')
                    ->type('password','34567')
                    ->press('Login')
                    ->assertPathIs('/profile/customer')
                    ->assertSee('Tierra')
                    ->assertSee('Cart: 0')
                    ->clickLink('Logout')
                    ->assertGuest();
        });
    }
}

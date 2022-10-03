<?php
/**
 * Integration test case for display filtered vehicle list
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
 * Class for Integration test case to display filtered vehicle list
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Raja kumar <raja@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @version   Release: 0.1
 * @link      No Link
 */
class GetFilteredVehicleTest extends DuskTestCase
{
    /**
     * A function to display filtered vehicle list by Name
     *
     * @test
     * @return $this
     */
    public function getCarByName()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->type('name', 'Dzire')
                    ->press('Search')
                    ->assertSee('Maruti Suzuki')
                    ->assertSee('VXI')
                    ->press('Reset');
            }
        );
    }
    
    /**
     * A function to display filtered vehicle list by Brand
     *
     * @test
     * @return $this
     */
    public function getCarByBrand()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->type('brand', 'Maruti')
                    ->press('Search')
                    ->assertSee('Maruti Suzuki')
                    ->press('Reset');
            }
        );
    }
    
    /**
     * A function to display filtered vehicle list by Model
     *
     * @test
     * @return $this
     */
    public function getCarByModel()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->type('model', 'ZXI')
                    ->press('Search')
                    ->assertSee('Wagon R')
                    ->assertSee('Maruti Suzuki')
                    ->press('Reset');
            }
        );
    }
    
    /**
     * A function to display filtered vehicle list by Model year
     *
     * @test
     * @return $this
     */
    public function getCarByModelYear()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->type('year', 2021)
                    ->press('Search')
                    ->assertSee('Wagon R')
                    ->assertSee('Safari')
                    ->assertSee('Thar')
                    ->assertDontSee('Creta')
                    ->press('Reset');
            }
        );
    }
    
    // /**
    //  * A function to display filtered vehicle list by Fuel Type
    //  *
    //  * @test
    //  * @return $this
    //  */
    // public function getCarByFuelType()
    // {
        //     $this->browse(
    //         function (Browser $browser) {
        //             $browser->visit('/dashboard')
        //                 ->assertSee('Reset')
        //                 ->type('fuel_type', 'petrol')
        //                 ->press('Search')
        //                 ->assertSee('Wagon R')
        //                 ->assertSee('Dzire')
        //                 ->assertDontSee('Creta')
        //                 ->press('Reset');
        //         }
        //     );
        // }
        
        
    /**
     * A function to display filtered vehicle list by Transmission type
     *
     * @test
     * @return $this
     */
    public function getCarByTransmissionType()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->type('transmission', 'Automatic')
                    ->press('Search')
                    ->assertSee('XUV700')
                    ->assertSee('Mahindra')
                    ->assertDontSee('Creta')
                    ->press('Reset');
            }
        );
    }
    
    /**
     * A function to display filtered vehicle list by Brand and Model Year
     *
     * @test
     * @return $this
     */
    public function getCarByBrandModelYear()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->type('brand', 'Maruti')
                    ->type('year', 2021)
                    ->press('Search')
                    ->assertSee('Wagon R')
                    ->assertDontSee('Swift')
                    ->press('Reset');
            }
        );
    }
    
    /**
     * A function to display filtered vehicle list by Brand, Model and Model Year
     *
     * @test
     * @return $this
     */
    public function getCarByModelBrandModelYear()
    {
        $this->browse(
            function (Browser $browser) {
                $browser->visit('/dashboard')
                    ->assertSee('Reset')
                    ->type('brand', 'Maruti')
                    ->type('model', 'VXI')
                    ->type('year', 2022)
                    ->press('Search')
                    ->assertSee('Dzire')
                    ->assertSee('Swift')
                    ->assertDontSee('Creta')
                    ->press('Reset');
            }
        );
    }
    
}

<?php
/**
 * Methods Related to Adding Cars
 *
 * PHP version 7.4
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Sagnik Mandal <sagnik@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @link      No Link
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class for methods related to Adding Cars
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Sagnik Mandal <sagnik@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @version   Release: 0.1
 * @link      No Link
 */
class AddCarController extends Controller
{
    /**
     * Displays addcar view
     *
     * @return view
     */
    public function index()
    {
        return view('addcar');
    }
    
    /**
     * Shows all bike avialable in database
     *
     * @param $request \Illuminate\Http\Request
     *
     * @return view addcarresponse
     */
    public function carDetailsToAdmin(Request $request)
    {
        $unique_id = time() . mt_rand();
        $listing_status = "Pending";
        $car_details = $request->input();
        $data = compact('car_details', 'unique_id', 'listing_status');
        return view('addcarresponse')->with($data);
    }
}

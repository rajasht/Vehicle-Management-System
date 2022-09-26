<?php
/**
 * Methods Related to User Registration
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
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class for methods related to User Registration
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Raja kumar <raja@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @version   Release: 0.1
 * @link      No Link
 */
class RegistrationController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('registration-form');
    }
    
    /**
     * Register the new user.
     *
     * @param $req Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $req)
    {
        $req->validate(
            [
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'phone'=>'required|numeric|digits:10',
            'email'=>'required|email',
            'address'=>'required',
            'password'=>'required',
            'confirm_password'=>'required|same:password'
            ]
        );
        
        $user = new User;

        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->phone = $req->phone;
        $user->email = $req->email;
        $user->address = $req->address;
        $user->password = $req->password;
        $user->interest = 1;
        $user->user_type = 1;
        $result = $user->save();
    
        if ($result) {
            return response()->json(
                [
                "success" => "true",
                "code" => 201,
                "message" => "Invoice data saved successfully",
                "data" => $result
                ],
                201
            );
        } else {
            return response()->json(
                [
                "success" => "false",
                "code" => 400,
                "message" => "Failed to Register User."
                ],
                400
            );
        }
    }
}

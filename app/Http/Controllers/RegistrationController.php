<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(){
        return view('registration-form');
    }
    
    public function register(Request $req){
        $req->validate([
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'phone'=>'required|numeric|digits:10',
            'email'=>'required|email',
            'address'=>'required',
            'password'=>'required',
            'confirm_password'=>'required|same:password'
        ]);
        
        $user = new User;

        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->phone = $req->phone;
        $user->email = $req->email;
        $user->address = $req->address;
        $user->password = $req->password;
        $user->user_type = 1;
        $result = $user->save();
    
        if($result){
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "New User Creted Successfully",
                "data" => $user
            ], 200);
        }
        return response()->json([
            "status" => "fail",
            "code" => 400,
            "message" => "New User Creation Failed"
        ], 400);
    }

    

}

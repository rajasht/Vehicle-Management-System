<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddCarController extends Controller
{
    public function index(){
        return view('addcar');
    }
    
    public function carDetailsToAdmin(Request $request){
        $unique_id = time() . mt_rand();
        $listing_status = "Pending";
        $car_details = $request->input();
        $data = compact('car_details','unique_id','listing_status');
        return view('addcarrespoanse')->with($data);
    }
}

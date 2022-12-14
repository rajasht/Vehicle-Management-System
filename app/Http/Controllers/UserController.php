<?php
/**
 * Methods Related to Users
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

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\SendUserLogInMailJob;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendLeadsToAdminMailJob;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendRegisteredCustomerMailJob;

/**
 * Class for methods related to User
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Raja kumar <raja@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @version   Release: 0.1
 * @link      No Link
 */
class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @param $request Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = [];
        if ($request->type) {
            $userType = $request->type;
            if ($userType === 'admin') {
                $userType = 3;
            } else if ($userType === 'dealer') {
                $userType = 2;
            } else {
                $userType = 1;
            }

            $user = User::where('user_type', '=', $userType)->paginate(4);
        } else {
            $user = User::all();
        }
        
        if (!$user->isEmpty()) {
            return response()->json(
                [
                "success" => "true",
                "code" => 200,
                "message" => "User data found",
                "Total User:" => count($user),
                "data" => $user
                ],
                200
            );
        }
        return response()->json(
            [
            "status" => "fail",
            "code" => 400,
            "message" => "User data not found"
            ],
            400
        );
    }

    /**
     * Display user of a particular id.
     *
     * @param $userId id attribute of the users table
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserById($userId)
    {
        $user = User::find($userId);
        if ($user) {
            return response()->json(
                [
                "success" => "true",
                "code" => 200,
                "message" => "User data found where ID is equal to $userId",
                "data" => $user
                ],
                200
            );
        }
        return response()->json(
            [
            "status" => "fail",
            "code" => 404,
            "message" => "User data not found"
            ],
            404
        );
    }

    /**
     * Create and store new user in database
     *
     * @param $request request body
     *
     * @return response
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        if ($user) {
            $userMatchedWithEmail = User::where(
                "email",
                "=",
                $request->email
            )->get();
            $userAdmin = User::where("user_type", "=", 3)->get();
            // $userAdminFind = User::find($userAdmin[0]->id);
            // $userCustomer = User::find($userMatchedWithEmail[0]->id);
            // SendRegisteredCustomerMailJob::dispatch($userCustomer)->delay(now()->addSeconds(1));
            // SendLeadsToAdminMailJob::dispatch($userAdminFind, $userCustomer)
            //     ->delay(now()->addSeconds(1));
            return response()->json(
                [
                "success" => "true",
                "code" => 201,
                "message" => "User data saved successfully",
                "data" => $user
                ],
                201
            );
        }
        return response()->json(
            [
            "success" => "false",
            "code" => 400,
            "message" => "Failed to save user data"
            ],
            400
        );
    }

    /**
     * Login with email and password with validations
     *
     * @param $request request body
     *
     * @return response
     */
    public function userLogin(Request $request)
    {

        // return $request->input();
        $rules = array(
            "email" => "required|email",
            "password" => "required|min:4|max:20"
        );

        $isValid = Validator::make($request->all(), $rules);
        if ($isValid->fails()) {
            return response()->json($isValid->errors(), 401);
        }

        $data = $request->input();
        $request->session()->put('email', $data['email']);


        $user = User::where('email', '=', session('email'))
            ->where('password', '=', $request->password)->get();


        //Authentication
        if (count($user) === 0) {
            return response()->json(
                [
                "success" => "false",
                "code" => 400,
                "message" => "Wrong email or password"
                ],
                400
            );
        }

        $u = User::find($user[0]['id']);

        SendUserLogInMailJob::dispatch($u)->delay(now()->addSeconds(1));


        $user_first_name = $user[0]['first_name'];
        $user_type = $user[0]['user_type'];

        

        $request->session()->put('u_t', $user_type);
        $request->session()->put('name', $user_first_name);
        $request->session()->put('uid', $user[0]['id']);

        $dealer_profile = 'dealer-data/'.$user[0]['id'];
        
        $userCartData = Cart::where('user_id', '=', $user[0]['id'])->get();

        $userCartVID = [];
        for ($i=0; $i<count($userCartData); $i++) {
            if ($userCartData[$i]->status == 1) {
                $userCartVID[]= $userCartData[$i]->vehicle_type_id;
            }
        }
        $userCartVID = array_unique($userCartVID);
        $request->session()->put('userCartData', $userCartData);
        $request->session()->put('userCartDataCount', count($userCartVID));
        $request->session()->put('userCartVID', $userCartVID);
        //Authorization
        if ($user_type === 0) {
            return redirect('visitor');
        } else if ($user_type === 1) {
            return redirect('profile/customer');
        } else if ($user_type === 2) {
            return redirect($dealer_profile);
        } elseif ($user_type === 3) {
            return redirect('profile/admin');
        } else {
            return redirect('visitor');
        }
    }
    /**
     * Update the user data in storage by ID.
     *
     * @param $request \Illuminate\Http\Request
     * @param $userId  id attribute of the users table
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId)
    {
        $user = User::find($userId);
        $user->update($request->all());
        if ($user) {
            return response()->json(
                [
                "success" => "true",
                "code" => 200,
                "message" => "User data with ID = $userId updated successfully",
                "data" => $user
                ],
                200
            );
        }

        return response()->json(
            [
            "success" => "false",
            "code" => 400,
            "message" => "Failed to update user data with ID = $userId"
            ],
            400
        );
    }

    /**
     * Remove the specified user from storage.
     *
     * @param $request \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $userFind = User::find($request->input('id'));
        $userDelete = User::destroy($request->input('id'));
        if ($userDelete) {
            return response()->json(
                [
                "success" => "true",
                "code" => 200,
                "message" => "User data with ID = $userFind->id 
                    deleted successfully",
                ],
                200
            );
        }

        return response()->json(
            [
            "success" => "false",
            "code" => 400,
            "message" => "Failed to delete user data with ID = $userFind->id"
            ],
            400
        );
    }

    /**
     * Display a listing of the interested customers.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCustomers()
    {
        $user = User::where('user_type', '=', 1)->get();
        if (count($user)) {
            return response()->json(
                [
                "success" => "true",
                "code" => 200,
                "message" => "User data found",
                "data" => $user
                ],
                200
            );
        }
        return response()->json(
            [
            "status" => "fail",
            "code" => 400,
            "message" => "User data not found"
            ],
            400
        );
    }

    /**
     * Updates the user type
     *
     * @param $req Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUserType(Request $req)
    {
        if ($req->isMethod('patch')) {
            $userType = $req->input();
            User::where('id', $userType['id'])
                ->update(['user_type'=>$userType['user_type']]);
            return response()->json(
                ['message'=>'user type udated succesfully.'],
                202
            );
        }
    }

    /**
     * Display the Details when clicked on profile link
     *
     * @param $userId user id
     *
     * @return \Illuminate\Http\Response
     */
    public function profileDetailsById($userId)
    {
        $user = User::find($userId);
        if ($user) {
            return response()->json(
                [
                "success" => "true",
                "code" => 200,
                "message" => "User data found where ID is equal to $userId",
                "First Name" => $user->first_name,
                "Last Name" => $user->last_name,
                "Phone Number" => $user->phone,
                "Email" => $user->email,
                "Address" => $user->address
                ],
                200
            );
        }
        return response()->json(
            [
            "status" => "fail",
            "code" => 404,
            "message" => "User data not found"
            ],
            404
        );
    }

    /**
     * Displays the Dealer page details
     *
     * @param $uid User Id of the dealer
     *
     * @return \Illuminate\Http\Response
     */
    public function dealerDataShow($uid)
    {

        $details = DB::table('cars')
            // ->join('users', 'cars.id', '=', 'users.car_id')
            ->where('user_id', $uid)
            ->get();
        
            $datacount = Count($details);

        if ($datacount>0) {
            $data = compact('details');
            return view('profile.dealer')->with($data);
        } else {
            return "No cars Found/Not a Dealer.";
        }
    }

}

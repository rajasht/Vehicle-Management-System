<?php
/**
 * Methods Related to Vehicles
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

use App\Models\Vehicle;
use Illuminate\Http\Request;

/**
 * Class for methods related to vehicles
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Raja kumar <raja@shorthillstech.com>
 * @copyright 2022 No Copyright
 * @license   No Licence
 * @version   Release: 0.1
 * @link      No Link
 */
class VehicleController extends Controller
{
    /**
     * Getting the Status of a vehicle based on vehicle id
     *
     * @param $ID is the vehicle id
     *
     * @return response
     */
    public function getStatus($ID)
    {
        $vehicle = Vehicle::find($ID);
        $status = '';
        if ($vehicle) {
            $vehicleStatus = $vehicle['status'];
        }
        if (!$vehicle) {
            $status = 'unknown';
        } else if ($vehicleStatus == 0) {
            $status = 'unlisted';
        } else if ($vehicleStatus == 1) {
            $status = 'send for approval';
        } else if ($vehicleStatus == 2) {
            $status = 'approved';
        } else if ($vehicleStatus == 3) {
            $status = 'declined/send back to dealer for changes';
        } else {
            $status = 'unknown';
        }
        if ($vehicle) {
            return response()->json(
                [
                "success" => "true",
                "code" => 200,
                "message" => "Vehicle listing status is $status",
                "data" => $vehicle
                ],
                200
            );
        }
        return response()->json(
            [
            "status" => "fail",
            "code" => 404,
            "message" => "Vehicle listing status data not found"
            ],
            404
        );
    }

    /**
     * Add a vehicle in the database
     *
     * @param $request Illuminate\Http\Request
     *
     * @return response
     */
    public function store(Request $request)
    {
        $vehicle = Vehicle::create($request->all());
        if ($vehicle) {
            return response()->json(
                [
                "success" => "true",
                "code" => 201,
                "message" => "Vehicle listing status data saved successfully",
                "data" => $vehicle
                ],
                201
            );
        }
        return response()->json(
            [
            "success" => "false",
            "code" => 400,
            "message" => "Failed to save vehicle listing status data"
            ],
            400
        );
    }

    /**
     * Update a vehicle details based on vehicle id
     *
     * @param $request Illuminate\Http\Request
     * @param $ID      vehicle id
     *
     * @return response
     */
    public function update(Request $request, $ID)
    {
        $vehicle = Vehicle::find($ID);
        $vehicle->update($request->all());
        if ($vehicle) {
            return response()->json(
                [
                "success" => "true",
                "code" => 200,
                "message" => "Vehicle data with ID = $ID updated successfully",
                "data" => $vehicle
                ],
                200
            );
        }

        return response()->json(
            [
            "success" => "false",
            "code" => 400,
            "message" => "Failed to update vehicle listing status data with ID = $ID"
            ],
            400
        );
    }

    /**
     * Delete a vehicle record based on the vehicle id
     *
     * @param $ID vehicle's id
     *
     * @return response
     */
    public function destroy($ID)
    {
        $vehicleFind = Vehicle::find($ID);
        $vehicleDelete = Vehicle::destroy($ID);
        if ($vehicleDelete) {
            return response()->json(
                [
                "success" => "true",
                "code" => 200,
                "message" => "Vehicle data with ID = $ID deleted successfully",
                "data" => $vehicleFind
                ],
                200
            );
        }

        return response()->json(
            [
            "success" => "false",
            "code" => 400,
            "message" => "Failed to delete vehicle listing status data with ID = $ID"
            ],
            400
        );
    }
}

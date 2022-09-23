<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    public function store(Request $request)
    {
        $car = Inventory::create($request->all());
            if ($car) 
            {
                return response()->json([
                    "success" => "true",
                    "code" => 201,
                    "message" => "Inventory data saved successfully",
                    "data" => $car
                ], 201);
            }
            else
            {
                return response()->json([
                    "success" => "false",
                    "code" => 400,
                    "message" => "All Required Data Need to Be Filled."
                ], 400);
            }
    }

    public function getInventorydata()
    {
        $data = Inventory::all();
        if (count($data)) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Inventory data are: ",
                "Inventory Count " => Count($data),
                "data" => $data
            ], 200);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Data In Inventory"
        ], 400);
    }

    public function getInventoryDataById($id)
    {
        $data =  Inventory::find($id);
        if ($data) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Inventory data of having INVENTORY ID $id is: ",
                "data" => $data
            ], 200);
        }
        return response()->json([
            "success" => "false",
            "code" => 404,
            "message" => "No Inventory data found of INVENTORY ID $id"
        ], 404);
    }

    public function removeInventory(Request $request)
    {
        $inventoryFind = Inventory::find($request->input('id'));
        $inventoryDelete = Inventory::destroy($request->input('id'));
        $inventory_count = count(Inventory::all());
        if ($inventoryDelete && $inventoryFind != null) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Car data with ID = $inventoryFind->id deleted successfully",
                "Before deletion Inventory Count "=> $inventory_count+1,
                "After deletion Inventory Count "=> $inventory_count,
                "data" => $inventoryFind
            ], 200);
        }
        else
        {
            return response()->json([
                "success" => "false",
                "code" => 400,
                "message" => "Failed to delete car data"
            ], 400);
        }
    }

    public function updateInventoryStatus($id, $sts)
    {
        
        $data = Inventory::find($id);
        
        if ($data!= NULL)
        {
            if($sts==1 || $sts==2)
            {
                $data->update(['status'=>$sts]);
                return response()->json(
                    [
                    "code" => 200,
                    "message" => "Inventory data with ID $id updated successfully",
                    "data" => $data
                ], 200);
            }
            else
            {
                return response()->json([
                    "success" => "false",
                    "code" => 400,
                    "message" => "Status Code Should be Either 1 or 2 only"
                ], 400);
            }

        }
        else
        {
            return response()->json([
                "success" => "false",
                "code" => 404,
                "message" => "Unable to Update Status, Inventory ID $id Not Available"
            ], 404);
        }
    }

    public function getInventoryStatus($id)
    {
        $data =  Inventory::find($id);
        
        if ($data) {
            $status_code = $data->status;

            if ($status_code == 0) {
                $vehicle_status = 'Unlisted';
            } else if ($status_code == 1) {
                $vehicle_status = "Active";
            } else if ($status_code == 2) {
                $vehicle_status = "Inactive";
            } else {
                $vehicle_status = "Unknown";
            }

            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Inventory data of having INVENTORY ID $id is: ",
                "status" => $vehicle_status
            ], 200);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Inventory data found of INVENTORY ID $id",
            "status" => "Unlisted"
        ], 404);
    }

    public function getStatusWiseInventoryList($sts)
    {
        $data = Inventory::where('status', $sts)->get();

        if (count($data)) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Inventory data of having Status Code $sts is: ",
                "inventory count : " => count($data),
                "data" => $data
            ], 200);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Inventory data found having status code $sts"
        ], 400);
    }
    
    public function getVehicleTypeWiseInventoryList($vt_cd)
    {
        if( $vt_cd == "1" || $vt_cd == "2" )
        {
            $data = Inventory::where('vehicle_type', $vt_cd)->get();
            if (count($data)>0) 
            {
                return response()->json([
                    "success" => "true",
                    "code" => 200,
                    "Inventory count : " => count($data),
                    "message" => "Inventory data of having Vehicle Type code $vt_cd are: ",
                    "data" => $data
                ], 200);
            }
            else
            {
                return response()->json([
                    "success" => "false",
                    "code" => 200,
                    "message" => "No Inventory data found having Vehicle Type code $vt_cd"
                ], 200);
            }
        }
        else
        {
            return response()->json([
                "success" => "false",
                "code" => 404,
                "message" => "Route Not Found"
            ], 404);
        }
    }
    
    public function getInventoryListBySoldToId($buyer_id)
    {
        if(is_numeric($buyer_id))
        {
            $data = Inventory::where('sold_to', $buyer_id)->get();
            if (count($data)>0)
            {
                return response()->json([
                    "success" => "true",
                    "code" => 200,
                    "message" => "Inventory data of having Buyer Id $buyer_id is: ",
                    "inventory count : " => count($data),
                    "data" => $data
                ], 200);
            }
            else
            {
                return response()->json([
                    "success" => "false",
                    "code" => 404,
                    "message" => "No Inventory Data Found of Buyer Id = $buyer_id "
                ], 404);
            }
        }
        else
        {
            return response()->json([
                "success" => "false",
                "code" => 404,
                "message" => "No Inventory Data Found of Buyer Id = $buyer_id "
            ], 404);
        }
    }
}

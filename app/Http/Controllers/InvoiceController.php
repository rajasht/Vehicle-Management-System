<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function store(Request $request)
    {
        $car = Invoice::create($request->all());
        if ($car) {
            return response()->json([
                "success" => "true",
                "code" => 201,
                "message" => "Invoice data saved successfully",
                "data" => $car
            ], 201);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "Failed to save Invoice data"
        ], 400);
    }

    public function getInvoice()
    {
        $data = Invoice::all();
        if (count($data)) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "Total Available Invoices :"=> count($data),
                "message" => "All Invoices are: ",
                "data" => $data
            ], 200);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Invoice Available"
        ], 400);
    }

    public function getInvoiceDataById($id)
    {
        $data =  Invoice::find($id);
        if ($data) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Invoice of Invoice ID $id is: ",
                "data" => $data
            ], 200);
        }
        return response()->json([
            "success" => "false",
            "code" => 404,
            "message" => "No Invoice found of Invoice ID $id"
        ], 404);
    }

    public function removeInvoice(Request $request)
    {
        $invoiceFind = Invoice::find($request->input('id'));
        $invoiceDelete = Invoice::destroy($request->input('id'));
        $invoice_count = count(Invoice::all());

        if ($invoiceDelete && $invoiceFind != null) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Invoice with invoice-id $invoiceFind->id deleted successfully",
                "Before deletion Inventory Count "=> $invoice_count+1,
                "After deletion Inventory Count "=> $invoice_count,
            ], 200);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Invoice found of given invoice id $request->id "
        ], 400);
    }
    
    public function getInvoiceByOrderId($odr_id)
    {
        $data =  Invoice::where("order_id", $odr_id)->get();
        if (count($data)) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Invoice of Order ID $odr_id is: ",
                "data" => $data
            ], 200);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Invoice found of Order ID $odr_id"
        ], 400);
    }
    
    public function getInvoicesOfDealerId($dlr_id)
    {
        $data =  Invoice::where("dealer_id", $dlr_id)->get();
        if (count($data)) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "Total Count of Invoices of Dealer "=> count($data),
                "message" => "Invoices of Dealer ID $dlr_id are: ",
                "data" => $data
            ], 200);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Invoice found of Dealer ID $dlr_id"
        ], 400);
    }
    
    public function getInvoiceByVehicleId($vid)
    {
        $data =  Invoice::where("vehicle_id", $vid)->get();
        if (count($data)) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Invoice of Vehicle ID $vid is: ",
                "data" => $data
            ], 200);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Invoice found of Vehicle ID $vid"
        ], 400);
    }
    
    public function getInvoiceByTransactionId($txn_id)
    {
         //is_int($varname)
        $data =  Invoice::where("transaction_id", $txn_id)->get();
        if (count($data)) {
            return response()->json([
                "success" => "true",
                "code" => 200,
                "message" => "Invoice of Transaction ID $txn_id is: ",
                "data" => $data
            ], 200);
        }
        return response()->json([
            "success" => "false",
            "code" => 400,
            "message" => "No Invoice found of Transaction ID $txn_id"
        ], 400);
    }

    public function getInvoiceBetweenPrice($price_start, $price_end)
    {
        if(is_numeric($price_start) && is_numeric($price_end))
        {

            if(!($price_end <= 0 ) && ($price_end > $price_start))
            {
                $data = Invoice::whereBetween('price', [$price_start,$price_end])->get();
    
                if (count($data)>0) {
                    return response()->json([
                        "success" => "true",
                        "code" => 200,
                        "Total Invoice Found "=> count($data),
                        "message" => "Found Invoice data",
                        "data" => $data
                    ], 200);
                }
                else
                {
                    return response()->json([
                        "code" => 404,
                        "Total Invoice Found "=> count($data),
                        "message" => "No Invoice Found Having Min Price $price_start and Max Price $price_end"
                    ], 404);
                }
            }
            else
            {
                return response()->json([
                    "success" => "false",
                    "code" => 400,
                    "message" => "Max Price can't be Zero or less Than Min Price"
                ], 400);
            }
        }
        else
        {
            return response()->json([
                "success" => "false",
                "code" => 400,
                "message" => "Inappropriate Min Price or Max Price"
            ], 400);
        }
    }
}

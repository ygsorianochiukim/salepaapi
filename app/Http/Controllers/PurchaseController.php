<?php

namespace App\Http\Controllers;

use App\Models\PurchaseMonitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PurchaseController extends Controller
{
    public function displayPurchase(){
        $displayPurchase = PurchaseMonitoring::all();

        return response()->json($displayPurchase);
    }

    public function storePurchaseDetails(Request $request)
    {
        $purchaseField = $request->validate([
            'buyers_i_information_id' => 'integer|required',
            'mp_i_lot_id' => 'integer|required',
            'payment_type' => 'string|nullable',
            'terms' => 'integer|nullable',
            'beneficiary1' => 'string|nullable',
            'beneficiary2' => 'string|nullable',
            'datePayment' => 'integer|nullable',
            'e_signature' => 'string|nullable',
            'created_by' => 'integer|nullable',
        ]);

        $purchaseField['is_active'] = true;
        $purchaseField['data_created'] = Carbon::now();

        $count = PurchaseMonitoring::count() + 1;
        $purchaseField['sales_temp_pa'] = 'PA-' . now()->format('mdY') . $count;
        $purchaseInformation = PurchaseMonitoring::create($purchaseField);

        return response()->json([
            'message' => 'Purchase Information Recorded',
            'data' => $purchaseInformation
        ], 201);
    }

    public function lookupSalesPa($id)
    {
        $fetchInformation = PurchaseMonitoring::join('buyers_i_information_table as b', 'b.buyers_i_information_id', '=', 'purchase_i_information_table.buyers_i_information_id')
            ->select(
                'purchase_i_information_table.*',
                'b.*'
            )
            ->where('purchase_i_information_table.sales_temp_pa', '=', $id)
            ->first();

        return response()->json($fetchInformation);
    }

    public function lookupName($name)
    {
        $cleanName = preg_replace("/[^a-zA-Z0-9\s]/", "", $name);
        $nameParts = explode(' ', $cleanName);

        $fetchInformation = PurchaseMonitoring::join(
                'buyers_i_information_table as b',
                'b.buyers_i_information_id',
                '=',
                'purchase_i_information_table.buyers_i_information_id'
            )
            ->select(
                'purchase_i_information_table.*',
                'b.*'
            )
            ->where(function ($query) use ($nameParts) {
                foreach ($nameParts as $part) {
                    $part = trim($part);
                    if ($part !== '') {
                        $query->whereRaw('LOWER(purchase_i_information_table.buyers_name) LIKE ?', ['%' . strtolower($part) . '%']);
                    }
                }
            })
            ->first();

        return response()->json($fetchInformation);
    }
}

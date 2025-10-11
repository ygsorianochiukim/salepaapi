<?php

namespace App\Http\Controllers;

use App\Models\buyersInformation;
use Illuminate\Http\Request;

class BuyersController extends Controller
{
    public function displayBuyers(){
        $displayBuyers = buyersInformation::all();

        return response()->json($displayBuyers);
    }

    public function storeBuyersDetails(Request $request){
        $buyersField = $request->validate([
            'buyers_name' => 'string|required',
            'contact_number' => 'integer|required',
            'province' => 'string|nullable',
            'municipality' => 'string|nullable',
            'barangay' => 'string|nullable',
            'purok' => 'string|nullable',
            'zipcode' => 'integer|nullable',
            'civil_status' => 'string|nullable',
            'sex' => 'string|nullable',
            'birthdate' => 'date|nullable',
            'birthplace' => 'string|nullable',
            'occupation' => 'string|nullable',
            'company_name' => 'string|nullable',
            'created_by' => 'integer|nullable',
            'otp' => 'integer|nullable',
        ]);

        $buyersField['is_active'] = true;
        $buyersField['data_created'] = true;

        $buyersInformation = buyersInformation::create($buyersField);

        return response()->json(['Buyers Information Recorded', $buyersInformation], 201);
    }
}

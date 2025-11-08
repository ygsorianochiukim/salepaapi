<?php

namespace App\Http\Controllers;

use App\Models\PaymentInformation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentInformationController extends Controller
{
    public function displaypayment(){
        $displayPayment = PaymentInformation::all();

        return response()->json($displayPayment);
    }

    public function storePayment(Request $request){
        $paymentField = $request -> validate([
            'buyers_i_information_id' => 'integer|required',
            'sales_temp_pa' => 'string|required',
            'amount' => 'integer|required',
            'otp' => 'integer|required',
            'image_binary' => 'nullable',
            'created_by' => 'integer|required',
        ]);

        $paymentField['is_active'] = true;
        $paymentField['data_created'] = Carbon::now();

        $paymentInformation = PaymentInformation::create($paymentField);

        return response()->json(['Payment Added', $paymentInformation], 201);
    }
}

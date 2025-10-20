<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OTPCOntroller extends Controller
{
    public function sendOtp(Request $request){
        $request->validate([
            'otp' => 'integer|required',
            'message' => 'string|required',
            'name' => 'string|required',
            'contact' => 'integer|required',
        ]);
        $otp = $request->otp;
        $name = $request->name;
        $message = $request->message;
        $contact = $request->contact;
        $appId = 'fee8f5dd-bb38-4d0f-bdb2-b274b1e7f6a7';
        $tableName = 'Sales App AutoText';
        $apiKey = 'V2-RU2Uu-enHp4-GvozU-0tm8w-A6p6X-YnFKL-OoWDp-fD4EJ';
        $url = "https://api.appsheet.com/api/v2/apps/{$appId}/tables/{$tableName}/Action";
        $payload = [
            "Action" => "Add",
            "Properties" => [
                "Locale" => "en-US",
                "Timezone" => "Asia/Manila"
            ],
            "Rows" => [[
                "Name" => $name,
                "contact" => '0' . ltrim($contact, '0'),
                "Message" => $message,
                "otp" => $otp,
            ]]
        ];

        try {
            $client = new \GuzzleHttp\Client();
            $client->post($url, [
                'headers' => [
                    'ApplicationAccessKey' => $apiKey,
                    'Content-Type' => 'application/json'
                ],
                'json' => $payload,

                'proxy' => 'http://mis:c%40sper2021@10.7.7.121:3128'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'OTP saved, but failed to send to AppSheet',
                'error'   => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'OTP generated successfully',
            'OTP' => $otp
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class OTPController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'otp' => 'integer|required',
            'message' => 'string|required',
            'name' => 'string|required',
            'contact' => 'required',
        ]);

        $otp = $request->otp;
        $message = $request->message;
        $contact = preg_replace('/^0/', '63', $request->contact);
        $apiKey = "0da664d31027a12eefc386c454dabe3b";

        $fullMessage = "{$message} Your OTP is: {$otp}";
        $url = "https://api.semaphore.co/api/v4/messages";

        $payload = [
            'apikey'  => $apiKey,
            'number'  => $contact,
            'message' => $fullMessage,
        ];

        try {
            $client = new Client();

            $response = $client->post($url, [
                'form_params' => $payload,
                'proxy' => [
                    'http'  => 'http://mis:c%40sp3r2021@10.7.7.121:3128',
                    'https' => 'http://mis:c%40sp3r2021@10.7.7.121:3128',
                ],
                'timeout' => 10,
            ]);
            $respBody = (string)$response->getBody();
            Log::info("Semaphore Response: " . $respBody);

            return response()->json([
                'message' => 'OTP sent successfully via Semaphore',
                'semaphore_response' => json_decode($respBody, true),
                'otp' => $otp,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to send OTP via Semaphore',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

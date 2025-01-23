<?php


// app/Helpers/helpers.php

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

if (!function_exists('sendOtp')) {
    /**
     * Send OTP via SMS using Twilio
     *
     * @param string $mobile
     * @param string $otp
     * @return void
     */
    function sendOtp($mobile, $otp)
    {
        $sid = env('TWILIO_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('TWILIO_PHONE_NUMBER');

        try {
            $client = new Client($sid, $authToken);

            $message = $client->messages->create(
                $mobile, // to
                [
                    'from' => $twilioNumber,
                    'body' => "Your OTP code is: $otp"
                ]
            );

            return $message->sid;
        } catch (\Exception $e) {
            // Handle error
            Log::error('Error sending OTP: ' . $e->getMessage());
            return false;
        }
    }
}


<?php
namespace App\Helpers;
use App\Models\Sms_configuration;

if (!function_exists('send_message')) {
    function send_message($phone_number, $message_text)
    {
        /** SMS API Details **/
        $sms_config = Sms_configuration::latest()->first();
        $api_url = $sms_config->api_url;
        $api_key = $sms_config->api_key;
        $senderid = $sms_config->sender_id;

        /* Prepare data */
        $data = [
            'api_key' => $api_key,
            'senderid' => $senderid,
            'number' => $phone_number,
            'message' => $message_text,
        ];

        /* Initialize cURL */
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        /* Execute request */
        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true);
        return $responseData;
    }
}


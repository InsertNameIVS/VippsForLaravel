<?php
namespace Insertname\Vipps;

use GuzzleHttp\Client;
use Insertname\Vipps\Models\VippsTokens;
use Insetname\Vipps\Payments;

class Vipps
{
    public function getToken()
    {
        // i want ti use datetime instead
        $now = new \DateTime();
        // get the token from the database if it exists and is not expired
        if(VippsTokens::where('expires_at', '>', $now)->exists()){
            $token = VippsTokens::where('expires_at', '>', $now)->first();
            return $token->token;
        }

        // send a request to the mobilepay api to get the access token with headers
        $client = new Client();

        $response = $client->post(env('VIPPS_API_URL').'/accesstoken/get', [
            'headers' => [
                'Content-Type' => 'application/json',
                'client_id' => env('VIPPS_CLIENT_ID'),
                'client_secret' => env('VIPPS_CLIENT_SECRET'),
                'Ocp-Apim-Subscription-Key' => env('VIPPS_SUBSCRIPTION_KEY'),
                'Merchant-Serial-Number' => env('VIPPS_MERCHANT_SERIAL_NUMBER'),
                'Vipps-System-Name' => env('APP_NAME'),
                'Vipps-System-Version' => \Illuminate\Foundation\Application::VERSION,
                'Vipps-System-Plugin-Name' => 'Vipps-Laravel',
                'Vipps-System-Plugin-Version' => '1.0.0',
            ]
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true); // true to get associative array

        $now->modify('+'.$data['expires_in'].' seconds');

        VippsTokens::create([
            'token' => $data['access_token'],
            'expires_at' => $now,
        ]);

        return $data['access_token'];
    }
}
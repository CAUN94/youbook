<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PadpowController extends Controller
{
    public function pay(){
        $data = [
                    'id' => 'JSBTT-R5S7Va',
                    'type' => 'exampletype',
                    'attributes' => [
                        'amount_cents' => 50,
                        'work' => 'Example Hora',
                        'detail' => 'Agenda Example',
                        'reference_code' => 'JSBTT-R5S7Va'
                    ]
                ];
         $links = [
            'return_url' => config('app.url', 'http://localhost').'padpow/JSBTT-R5S7Va/return_url'
            ];

        $url = 'https://nimrod.avispa.work/api/v1/charges';
        $client = new Client();
        $response = $client->post($url, [
            'headers' => [
                'x-api-token' => 'd3c8da22-6dc6-47f4-baa6-22ee741d9008',
                'content-type' => 'application/json'
            ],
            'json' => [
                'data' => $data,
                'links' => $links
            ]
        ]);
        // echo $response->getStatusCode();
        // 200
        // echo $response->getHeader('content-type');
        // 'application/json; charset=utf8'
        $pay = json_decode($response->getBody(), true);
        // return  $pay['data']['attributes']['url'];
        return  redirect()->away($pay['data']['attributes']['url']);
        // {"type":"User"...'
    }

    public function code($code){
        return $code;
    }
}

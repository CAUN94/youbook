<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PadpowController extends Controller
{
    public function pay(){
        // $json = json_encode([
        //             'data' => [
        //                 'id' => 'JSBTT-R5S7V',
        //                 'type' => 'exampletype',
        //                 'atrributes' => [
        //                     'amount_cents' => 0,
        //                     'work' => 'Example Hora',
        //                     'detail' => 'Agenda Example',
        //                     'reference_code' => 'example2'
        //                 ]
        //             ],
        //             'links' => [
        //                 'return_url' => 'https://yjb-book.test/padpow/example/return_url'
        //             ]
        //         ]);
        $response = Http::withHeaders([
            'X-API-TOKEN' => 'd3c8da22-6dc6-47f4-baa6-22ee741d9008',
        ])->get('https://nimrod.avispa.work/');

        return $response->throw()->json();
    }
}

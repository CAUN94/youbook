<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class PadpowController extends Controller
{

    public function pay(){
        if (Auth::user()->isSettled()){
            return back();
        }
        $data = [
                    'id' => $this->code(Auth::user()),
                    'type' => 'Plan de Entrenamiento',
                    'attributes' => [
                        'amount_cents' => Auth::user()->plan()->planPrice(),
                        'work' => Auth::user()->plan()->name.' '.Auth::user()->plan()->format,
                        'detail' => Auth::user()->plan()->name.' '.Auth::user()->plan()->format,
                        'reference_code' =>$this->code(Auth::user())
                    ]
                ];
         $links = [
            'return_url' => config('app.url', 'http://localhost').'padpow/'.$this->code(Auth::user()).'/return_url'
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

        $pay = json_decode($response->getBody(), true);
        // return $pay;
        if ($pay['data']['attributes']['aasm_state'] == 'paying'
            and !Auth::user()->isSettled()){
            Auth::user()->student->settled = 1;
            Auth::user()->student->save();
            return redirect()->back();
        }

        if ($pay['data']['attributes']['aasm_state'] == 'paying'){
            return redirect()->back();
        }
        return  redirect()->away($pay['data']['attributes']['url']);
    }

    public function check($code){

        $data = [
            'id' => $code,
            'type' => 'Plan de Entrenamiento',
            'attributes' => [
                    'amount_cents' => Auth::user()->planPrice(),
                    'work' => Auth::user()->plan()->name.' '.Auth::user()->plan()->format,
                    'detail' => Auth::user()->plan()->name.' '.Auth::user()->plan()->format,
                    'reference_code' => $code
                ]
            ];
        $links = [
            'return_url' => config('app.url', 'http://localhost').'padpow/'.$code.'/return_url'
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

        $pay = json_decode($response->getBody(), true);
        if ($pay['data']['attributes']['aasm_state'] == 'paying'){
            Auth::user()->student->settled = 1;
            Auth::user()->student->save();
            try{
               Mail::send('emails.adminuserpay', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                ->bcc('clinica@justbetter.cl')
                ->bcc('you@justbetter.cl')
                ->subject('Nuevo Pago '.$to_name);
                $message->from('desarrollo@justbetter.cl','Pago Entrenamiento');
                });

            }catch(\Exception $e){
            }
        }

        return redirect('/training');
    }

    public function code($user){
        $code = []; //user-plan-month-year
        array_push($code, 'yjb');
        array_push($code, $user->id);
        array_push($code, $user->student->training_id);
        array_push($code, date('m'));
        array_push($code, date('y'));
        return implode($code,'-');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use GuzzleHttp\Client;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Log;

class PaymentController extends Controller
{
    
    public function payment(Request $request)
    {   
        
       
       Payment::create([
        'order_id' => $request->get('order_id'),
        'price' => $request->get('total'),
        'status' => 0,
        'user_id' =>Auth::user()->id,
        'url_payment' => 'https://pago.com.py']); 

        $payment = Payment::orderBy('id', 'desc')->first();;

        $order = Order::where('id', $payment->order_id)->get();


        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://staging.adamspay.com/api/v1/debts',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
          "debt": {
            "docId": "'.$order[0]->id.'",
            "amount": {
              "currency": "PYG",
              "value": "'.$payment->price.'"
            },
            "label": "Pago Orden: '.$order[0]->id.'",
            "slug": "'.$order[0]->id.' - '.$order[0]->created_at.'",
            "target": {
              "type": "ruc",
              "number": "999999-1",
              "label": "ACME Corporation"
            },
            "validPeriod": {
              "start": "2022-12-09T17:30:00Z",
              "end": "2022-12-31T17:30:00Z"
            }
          }
        }
        ',
          CURLOPT_HTTPHEADER => array(
            'apikey: ap-4b77a4530776001e8ca4764b',
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);

        Payment::where('order_id', $order[0]->id)->update(['url_payment' => $data['debt']['payUrl']]);

        return redirect($data['debt']['payUrl']);
    }

    public function webhook(Request $request)
    {
            Log::info($_SERVER);
    }

}
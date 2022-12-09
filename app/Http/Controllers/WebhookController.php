<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\Http\Requests;

class WebhookController extends Controller
{
    public function handle(Request $request)
      {     
       Log::info($request);
      }
}

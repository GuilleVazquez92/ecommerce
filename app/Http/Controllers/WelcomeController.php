<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class WelcomeController extends Controller
{
    public function __invoke(){

       // dd(@$_SERVER['HTTP_X_ADAMS_NOTIFY_HASH']);
        $categories = Category::all();

        if(isset(Auth::user()->id))
        {
        $payment  = Payment::where('user_id', Auth::user()->id)->get();
        $params ['payments']     = $payment ;
        
        }
        $params['categories']   = $categories;
       

        return view('welcome', $params);
    }


}

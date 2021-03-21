<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function getSession(Request $request)
    {
        if ($request->session()->has('channel')){
            echo $request->session()->get('channel');
        }else{
            echo ('Session not exists');
        }
    }

    public function storeSession(Request $request){
        $request->session()->put('channel', 'GurasHome');
        echo ('Session is stored');
    }

    public function deleteSession(Request $request){
        $request->session()->forget('channel');
        echo ('Session is deleted');
    }
}

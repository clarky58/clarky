<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $url = '';
        if ($request->user()->role === 'admin'){
            $url = 'admin/dashboard';
        }
        elseif($request->user()->role === 'secretary'){
            $url= 'secretary/dashboard';
        }
        elseif($request->user()->role === 'user'){
            $url = 'user/dashboard';
        }
        // dd($url);

        return redirect()->intended($url);
    }
}

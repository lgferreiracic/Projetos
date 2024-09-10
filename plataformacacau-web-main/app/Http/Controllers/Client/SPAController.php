<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class SPAController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
}

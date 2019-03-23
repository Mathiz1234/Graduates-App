<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified', ['except' => ['index']]);
    }

    /*
        Displays user personal data
    */
    public function index()
    {
        return view('layouts.account.index');
    }
}

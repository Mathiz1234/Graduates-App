<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('layouts.welcome', ['page' => 'main']);
    }

    public function rules()
    {
        return view('layouts.rules', ['page' => 'rules']);
    }

    public function localization()
    {
        if (app()->isLocale('en')) {
            app()->setLocale('pl');
            session()->put('locale', 'pl');
        } else {
            app()->setLocale('en');
            session()->put('locale', 'en');
        }

        return back();
    }
}

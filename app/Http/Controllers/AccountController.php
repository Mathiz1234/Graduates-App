<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /*
        Displays admin panel to change the role of users
    */
    public function management_index()
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        $users = DB::table('users')->select('id', 'name', 'email', 'role')->where('email', '!=', auth()->user()->email)->orderBy('name', 'asc')->get();

        return view('layouts.account.management', ['users' => $users]);
    }

    /*
        Change role of users
    */
    public function management_change_permissions(Request $request)
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        $data = $request->validate([

            'promotion' => ['required','string'],

            'id' => ['required','string', 'integer']
        ]);

        if ($data['promotion'] == 'up') {
            if (DB::table('users')
            ->where('id', $data['id'])
            ->whereIn('role', [1,2])
            ->increment('role')) {
                session()->flash('status', 'Pomyślnie zwiększono uprawnienia!');
            }
        } elseif ($data['promotion'] == 'down') {
            if (DB::table('users')
            ->where('id', $data['id'])
            ->whereIn('role', [2,3])
            ->decrement('role')) {
                session()->flash('status', 'Pomyślnie zmiejszono uprawnienia!');
            }
        }

        return redirect('/account/management');
    }
}

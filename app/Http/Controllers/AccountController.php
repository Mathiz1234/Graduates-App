<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

            'promotion' => ['required', 'string'],

            'id' => ['required', 'integer']
        ]);

        if ($data['promotion'] == 'up') {
            if (DB::table('users')
                ->where('id', $data['id'])
                ->whereIn('role', [1, 2])
                ->increment('role')
            ) {
                session()->flash('status', 'Successfully increased permissions!');
            }
        } elseif ($data['promotion'] == 'down') {
            if (DB::table('users')
                ->where('id', $data['id'])
                ->whereIn('role', [2, 3])
                ->decrement('role')
            ) {
                session()->flash('status', 'Successfully decreased permissions!');
            }
        }

        return redirect('/account/management');
    }

    /*
        Show password form
    */
    public function password()
    {
        return view('layouts.account.change-password');
    }

    /*
        Show change form
    */
    public function show()
    {
        return view('layouts.account.change-form');
    }

    /*
        Change password or other personal data
    */
    public function change(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'new-password' => ['required', 'string', 'min:6', 'confirmed'],
            'old-password' => ['required', 'string']
        ]);

        $validator->after(function ($validator) {
            $data = $validator->getData();
            if (Hash::check($data['old-password'], auth()->user()->password)) {

                auth()->user()->fill([
                    'password' => Hash::make($data['new-password'])
                ])->save();

                session()->flash('status', 'Password has been changed.');
            } else {
                $validator->errors()->add('old-password', 'Invalid old password!');
            }
        });

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        return redirect('/account');
    }
}

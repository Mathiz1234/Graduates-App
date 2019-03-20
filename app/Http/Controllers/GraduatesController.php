<?php

namespace App\Http\Controllers;

use App\Graduate;
use Illuminate\Http\Request;

class GraduatesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];

        if ($request->has(['name', 'surname', 'mature_year'])) {
            $data = $request->validate([

                'name' => ['string', 'nullable'],

                'surname' => ['string', 'nullable'],

                'mature_year' => ['numeric', 'nullable']
            ]);

            $request->flash();
        }

        if (auth()->check()) {
            $graduates = Graduate::getGraduates($data, false);
        } else {
            $graduates = Graduate::getGraduates($data);
        }

        return view('layouts.graduates.index', [
            'page' => 'search',
            'graduates' => $graduates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Graduate  $graduate
     * @return \Illuminate\Http\Response
     */
    public function show(Graduate $graduate)
    {
        $this->authorize('show', $graduate);

        return view('layouts.graduates.show', [
            'page' => 'search',
            'graduate' => $graduate
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Graduate  $graduate
     * @return \Illuminate\Http\Response
     */
    public function edit(Graduate $graduate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Graduate  $graduate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Graduate $graduate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Graduate  $graduate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Graduate $graduate)
    {
        //
    }
}

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

        if ($request->has(['name', 'surname', 'matura_year'])) {
            $data = $request->validate([

                'name' => ['string', 'nullable'],

                'surname' => ['string', 'nullable'],

                'matura_year' => ['numeric', 'nullable']
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
    * Soft deleting.
    *
    * @param  \App\Graduate  $graduate
    * @return \Illuminate\Http\Response
    */
    public function destroy(Graduate $graduate)
    {
        $this->authorize('change', Graduate::class);

        $graduate->delete();

        return redirect('/graduates')->with('status', 'The graduate has been removed.');
    }

    /**
     * Show deleted graduates.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showDeleted(Request $request)
    {
        $this->authorize('forceDeleted', Graduate::class);

        $graduates = Graduate::getDeletedGraduates();

        return view('layouts.graduates.index-deleted', [
            'page' => 'search',
            'graduates' => $graduates
        ]);
    }

    /**
    * Restore deleted graduates.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function restore(Request $request)
    {
        $this->authorize('forceDeleted', Graduate::class);

        if ($request->has('id')) {
            $data = $request->validate([
                'id' => ['required', 'integer']
            ]);

            if ($graduate = Graduate::findWithDeleted($data['id'])) {
                if ($graduate->trashed()) {
                    $graduate->restore();
                }
            }
        }

        return redirect('/graduates')->with('status', 'The graduate has been restored!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(Request $request)
    {
        $this->authorize('forceDeleted', Graduate::class);

        if ($request->has('id')) {
            $data = $request->validate([
                'id' => ['required', 'integer']
            ]);

            if ($graduate = Graduate::findWithDeleted($data['id'])) {
                if ($graduate->trashed()) {
                    $graduate->forceDelete();
                }
            }
        }

        return redirect('/graduates')->with('status', 'The graduate has been permanently removed!');
    }
}

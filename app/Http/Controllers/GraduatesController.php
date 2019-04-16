<?php

namespace App\Http\Controllers;

use App\Graduate;
use App\Scan;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Exception;
use Illuminate\Support\Facades\Storage;

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
        $this->authorize('change', Graduate::class);

        return view('layouts.graduates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('change', Graduate::class);

        try {
            DB::beginTransaction();
            if ($request->has(['name', 'surname', 'matura_year'])) {
                $validated = $request->validate([

                    'name' => ['required', 'min:3', 'max:100', 'string'],

                    'surname' => ['required', 'min:3', 'max:100', 'string'],

                    'matura_year' => ['required', 'numeric', 'max:2155'],

                    'description' => ['string', 'nullable'],

                    'avatar' => ['image', 'max:2048'],

                    'scans.*' => ['mimes:pdf,jpg,jpeg,png,bmp,gif,svg', 'max:4096']

                ]);

                $data = \Illuminate\Support\Arr::except($validated, ['avatar', 'scans']);

                //avatar
                $avatarName = 'default.png';
                if ($request->has('avatar')) {
                    if ($validated['avatar']->isValid()) {
                        $avatarName = time() . '.' . $validated['avatar']->extension();
                        $validated['avatar']->storeAs('public/avatars', $avatarName);
                        Image::make(public_path() . '/storage/avatars/' . $avatarName)->fit(100)->save(public_path() . '/storage/avatars/' . $avatarName);
                    }else{
                        throw new Exception('Uploaded avatar is invalid');
                    }
                }

                //checkbox
                if ($request->has('shared')) {
                    $data['shared'] = true;
                }

                //creating graduate
                $data['avatar'] = $avatarName;
                $graduate = Graduate::create($data);

                $scansNames = [];
                //scans
                if ($request->has('scans')) {
                    foreach ($validated['scans'] as $scan) {
                        if ($scan->isValid()) {
                            $scanName = Scan::getName($scan);
                            array_push($scansNames,$scanName);
                            if ($scan->extension() == 'pdf') {
                                $scan->storeAs('public/files', $scanName);
                                $graduate->addFile($scanName, $scan->getClientOriginalName());
                            } else {
                                $scan->storeAs('public/scans', $scanName);
                                $graduate->addScan($scanName);
                            }
                        }else{
                            throw new Exception('Uploaded scan is invalid');
                        }
                    }
                }
            }
            DB::commit();
        } catch (\PDOException $e) {

            DB::rollBack();

            if($avatarName!='default.png' && Storage::exists('public/avatars/'.$avatarName)){
                Storage::delete('public/avatars/'.$avatarName);
            }


            if(count($scansNames)!=0){
                foreach($scansNames as $name){
                    if(Storage::exists('public/scans/'.$name)){
                        Storage::delete('public/scans/'.$name);
                    }elseif(Storage::exists('public/files/'.$name)){
                        Storage::delete('public/files/'.$name);
                    }
                }
            }

            //dd($e);

            return back()->withInput();

        }

        return redirect('/graduates')->with('status', 'Graduate has been successfully added!');
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

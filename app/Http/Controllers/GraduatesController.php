<?php

namespace App\Http\Controllers;

use App\File;
use App\Scan;
use App\Graduate;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use PHPUnit\Framework\Exception;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
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
            $scansNames = [];
            $avatarName = 'default.png';
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
                if ($request->has('avatar')) {
                    if ($validated['avatar']->isValid()) {
                        $avatarName = time() . '.' . $validated['avatar']->extension();
                        $validated['avatar']->storeAs('avatars', $avatarName);
                        Image::make(storage_path('app/uploads/') . 'avatars/' . $avatarName)->fit(100)->save(storage_path('app/uploads/') . 'avatars/' . $avatarName);
                    } else {
                        throw new Exception('Uploaded avatar is invalid');
                    }
                }

                //checkbox
                if ($request->has('shared')) {
                    $data['shared'] = true;
                }

                //creating graduate
                $data['avatar'] = $avatarName;
                $data['edited_by'] = auth()->user()->id;
                $graduate = Graduate::create($data);

                //scans
                if ($request->has('scans')) {
                    foreach ($validated['scans'] as $scan) {
                        if ($scan->isValid()) {
                            $scanName = Scan::getName($scan);
                            array_push($scansNames, $scanName);
                            if ($scan->extension() == 'pdf') {
                                $scan->storeAs('files', $scanName);
                                $graduate->addFile($scanName, $scan->getClientOriginalName());
                            } else {
                                $scan->storeAs('scans', $scanName);
                                $graduate->addScan($scanName);
                            }
                        } else {
                            throw new Exception('Uploaded scan is invalid');
                        }
                    }
                }
            }
            DB::commit();
        } catch (\PDOException $e) {

            DB::rollBack();

            if ($avatarName != 'default.png' && Storage::exists('avatars/' . $avatarName)) {
                Storage::delete('avatars/' . $avatarName);
            }


            if (isset($scansNames)) {
                if (count($scansNames) != 0) {
                    foreach ($scansNames as $name) {
                        if (Storage::exists('scans/' . $name)) {
                            Storage::delete('scans/' . $name);
                        } elseif (Storage::exists('files/' . $name)) {
                            Storage::delete('files/' . $name);
                        }
                    }
                }
            }

            //dd($e);

            return back()->withInput();
        }

        return redirect('/graduates/' . $graduate->id)->with('status', 'Graduate has been successfully added!');
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
        $this->authorize('change', Graduate::class);

        return view('layouts.graduates.edit', compact('graduate'));
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
        $this->authorize('change', Graduate::class);

        try {
            $storageArray = [];
            $avatarName = 'default.png';
            $scansNames = [];
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
                if ($request->has('if-avatar-deleted')) {
                    if (($request->input('if-avatar-deleted') != 'false') && ($graduate->avatar != 'default.png')) {
                        if (Storage::exists('avatars/' . $graduate->avatar)) {
                            $storageArray = Arr::prepend($storageArray, 'avatars/' . $graduate->avatar);
                            //Storage::delete('avatars/' . $graduate->avatar);
                            $data['avatar'] = 'default.png';
                        }
                    }
                    if ($request->has('avatar')) {
                        if ($validated['avatar']->isValid()) {
                            $avatarName = time() . '.' . $validated['avatar']->extension();
                            $validated['avatar']->storeAs('avatars', $avatarName);
                            Image::make(storage_path('app/uploads/') . 'avatars/' . $avatarName)->fit(100)->save(storage_path('app/uploads/') . 'avatars/' . $avatarName);
                            $data['avatar'] = $avatarName;
                        } else {
                            throw new Exception('Uploaded avatar is invalid');
                        }
                    }
                }

                //checkbox
                if ($request->has('shared')) {
                    $data['shared'] = true;
                } else {
                    $data['shared'] = false;
                }

                $data['edited_by'] = auth()->user()->id;
                //creating graduate
                $graduate->update($data);


                //old files
                if ($request->has('old-files')) {
                    $oldFiles = [];

                    foreach ($graduate->files as $oldFile) {
                        $oldFiles[$oldFile->id] = false;
                    }

                    foreach ($request->input('old-files.*') as $file) {

                        if ($file != false) {
                            foreach ($oldFiles as $key => $value) {
                                if ($key == $file) {
                                    $oldFiles[$key] = true;
                                    break;
                                }
                            }
                        }
                    }

                    foreach ($oldFiles as $key => $value) {
                        if ($value == false) {
                            $file = File::find($key);
                            if (Storage::exists('files/' . $file->image_url)) {
                                $storageArray = Arr::prepend($storageArray, 'files/' . $file->image_url);
                                //Storage::delete('files/' . $file->image_url);
                            }
                            $file->delete();
                        }
                    }
                }

                //old scans
                if ($request->has('old-scans')) {
                    $oldScans = [];

                    foreach ($graduate->scans as $oldScan) {
                        $oldScans[$oldScan->id] = false;
                    }

                    foreach ($request->input('old-scans.*') as $scan) {

                        if ($scan != false) {
                            foreach ($oldScans as $key => $value) {
                                if ($key == $scan) {
                                    $oldScans[$key] = true;
                                    break;
                                }
                            }
                        }
                    }

                    foreach ($oldScans as $key => $value) {
                        if ($value == false) {
                            $scan = Scan::find($key);
                            if (Storage::exists('scans/' . $scan->image_url)) {
                                $storageArray = Arr::prepend($storageArray, 'scans/' . $scan->image_url);
                                //Storage::delete('scans/' . $scan->image_url);
                            }
                            $scan->delete();
                        }
                    }
                }

                // new scans
                if ($request->has('scans')) {
                    foreach ($validated['scans'] as $scan) {
                        if ($scan->isValid()) {
                            $scanName = Scan::getName($scan);
                            array_push($scansNames, $scanName);
                            if ($scan->extension() == 'pdf') {
                                $scan->storeAs('files', $scanName);
                                $graduate->addFile($scanName, $scan->getClientOriginalName());
                            } else {
                                $scan->storeAs('scans', $scanName);
                                $graduate->addScan($scanName);
                            }
                        } else {
                            throw new Exception('Uploaded scan is invalid');
                        }
                    }
                }
            }
            DB::commit();

            foreach ($storageArray as $string) {
                Storage::delete($string);
            }
        } catch (\PDOException $e) {

            DB::rollBack();

            if ($request->has('if-avatar-deleted') && $avatarName != 'default.png' && Storage::exists('avatars/' . $avatarName)) {
                Storage::delete('avatars/' . $avatarName);
            }


            if (isset($scansNames)) {
                if (count($scansNames) != 0) {
                    foreach ($scansNames as $name) {
                        if (Storage::exists('scans/' . $name)) {
                            Storage::delete('scans/' . $name);
                        } elseif (Storage::exists('files/' . $name)) {
                            Storage::delete('files/' . $name);
                        }
                    }
                }
            }

            //dd($e);

            return back()->withInput();
        }

        return redirect('/graduates/' . $graduate->id)->with('status', 'Graduate has been successfully updated!');
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

        $graduate->edited_by = auth()->user()->id;

        $graduate->save();

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

            if ($graduate = Graduate::withTrashed()->with(['scans', 'files'])->find($data['id'])) {

                if ($graduate->trashed()) {

                    foreach ($graduate->scans as $image) {
                        if (Storage::exists('scans/' . $image->image_url)) {
                            Storage::delete('scans/' . $image->image_url);
                        }
                    }

                    foreach ($graduate->files as $file) {
                        if (Storage::exists('files/' . $file->image_url)) {
                            Storage::delete('files/' . $file->image_url);
                        }
                    }

                    if ($graduate->avatar != 'default.png') {
                        if (Storage::exists('avatars/' . $graduate->avatar)) {
                            Storage::delete('avatars/' . $graduate->avatar);
                        }
                    }

                    $graduate->forceDelete();
                }
            }
        }

        return redirect('/graduates')->with('status', 'The graduate has been permanently removed!');
    }
}

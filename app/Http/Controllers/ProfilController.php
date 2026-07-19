<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profils =
        Profil::latest()
        ->paginate(10);

        return view(
        'admin.profil.index',
        compact('profils')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
        'admin.profil.create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'nama_sekolah'=>'required',
        'logo'=>'nullable|image',
        'sejarah'=>'nullable',
        'visi'=>'nullable',
        'misi'=>'nullable',
        'program'=>'nullable',
        'alamat'=>'nullable',
        'telepon'=>'nullable',
        'email'=>'nullable'

        ]);


        if(
        $request->hasFile(
        'logo'
        )
        ){

        $data['logo']=
        $request
        ->file('logo')
        ->store(
        'school',
        'public'
        );

        }

        Profil::create($data);

        return redirect()
        ->route(
        'admin.profil.index'
        );

    }

    /**
     * Display the specified resource.
     */
    public function show(Profil $profil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profil $profil)
    {
        $profil = Profil::first();
        if(!$profil){
        $profil = Profil::create([]);
        }

        return view(
        'admin.profil.edit',
        compact('profil')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profil $profil)
    {
        $profil =
        Profil::first();

        $data =
        $request->validate([
        'nama_sekolah'=>'required',
        'logo'=>'nullable|image',
        'sejarah'=>'nullable',
        'visi'=>'nullable',
        'misi'=>'nullable',
        'program'=>'nullable',
        'alamat'=>'nullable',
        'telepon'=>'nullable',
        'email'=>'nullable'

        ]);

        if($request->hasFile('logo')){
            if(
            $profil->logo &&
            Storage::disk('public')
            ->exists(
            $profil->logo
            )
            ){

        Storage::disk('public')
            ->delete(
            $profil->logo
            );
        }

        $data['logo'] =
        $request->file('logo')->store(
            'school',
            'public'
            );
        }

        $profil->update($data);
        return back()->with(
            'success',
            'Updated'
        );        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profil $profil)
    {

        $profil->delete();
        return back();

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gurus = Guru::latest()->paginate(10);
        return view('admin.guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'nama_lengkap'=>'required',
        'jkelamin'=>'required',
        'tempat_lahir'=>'required',
        'tanggal_lahir'=>'required',
        'NUPTK'=>'required',
        'NIK'=>'required',
        'pendidikan'=>'required',
        'alamat'=>'required',        
        ]);

        Guru::create($data);

        return redirect()
        ->route('admin.guru.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $gurus)
    {
        $gurus->delete();

        return redirect()
        ->route('admin.guru.index');
    }
}

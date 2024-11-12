<?php

namespace App\Http\Controllers;

use App\Models\Daftar;
use App\Models\Pasien;
use App\Models\Poli;
use App\Http\Requests\StoreDaftarRequest;
use App\Http\Requests\UpdateDaftarRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

class DaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->filled('q')){
            $daftar = \App\Models\Daftar::search(request('q'))->paginate(20);
        }else{
            $daftar = \App\Models\Daftar::latest()->paginate(20);
        }
        return view('daftar_index', compact('daftar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listPasien = \App\Models\Pasien::orderBy('nama', 'asc')->get();
        $listPoli = \App\Models\Poli::orderBy('nama', 'asc')->get();
    
        return view('daftar_create', compact('listPasien', 'listPoli'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDaftarRequest $request)
    {       
        $validated = $request->validate([
            'tanggal_daftar' => 'required|date',
            'pasien_id' => 'required|exists:pasiens,id',
            'poli' => 'required|exists:polis,id',
            'keluhan' => 'required|string',
        ]);
    
        // Simpan data
        
        $daftar = new Daftar;
        $daftar->tanggal_daftar = $validated['tanggal_daftar'];
        $daftar->pasien_id = $validated['pasien_id'];
        $daftar->poli_id = $validated['poli'];
        $daftar->keluhan = $validated['keluhan'];
        $poli = \App\Models\Poli::findOrFail($validated['poli']);
        $daftar->biaya = $poli->biaya;
        $daftar->save();
    
        return redirect('/daftar')->with('success', 'Pendaftaran berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data['daftar'] = \App\Models\Daftar::findOrFail($id);
        return view('daftar_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Daftar $daftar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'tindakan' => 'required',
            'diagnosis' => 'required',
        ]);
        $daftar = \App\Models\Daftar::findOrFail($id);
        $daftar->fill($requestData);
        $daftar->save();
        flash('Data anda berhasil disimpan')->success();
        return redirect('/daftar');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Daftar $daftar)
    {
        $daftar->delete();
        flash('Data anda berhasil dihapus')->success();
        return redirect('/daftar');
    }
}
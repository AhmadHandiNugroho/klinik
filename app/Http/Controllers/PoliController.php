<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poli;
use Illuminate\Pagination\Paginator;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $data['poli']= \App\Models\Poli::latest()->paginate(10);
        return view('poli_index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('poli_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'nama' => 'required|min:3',
            'biaya' => 'required',
            'keterangan' => 'nullable',
        ]);
        $poli = new \App\Models\Poli();
        $poli->fill($requestData);
        $poli->save();
        flash('Selamat Data anda berhasil disimpan!')->success();
        
        return redirect('/poli');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['poli'] = \App\Models\Poli::findOrFail($id);
        return view('poli_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->validate([
            'nama' => 'required',
            'biaya' => 'required',
            'keterangan' => 'nullable',
        ]);
        $poli = \App\Models\Poli::findOrFail($id);
        $poli->fill($requestData);
        $poli->save();
        flash('Selamat Data anda berhasil diupdate!')->success();
        
        return redirect('/poli');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $poli = \App\Models\Pasien::findOrFail($id);
        $poli->delete();
        flash('Data Berhasil dihapus')->success();
        return redirect('/poli');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dokumens = dokumen::latest()->paginate(5);
        return view('dokumens.index',compact('dokumens'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dokumens.create');
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
        $request->validate([
            'santri_id' => 'required',
            'ijazah' => 'required',
            'nilai_raport'=>'required',
            'skhun'=>'required',
            'foto' => 'required',
            'kk'=>'required',
            'ktp_ayah'=>'required',
            'ktp_ibu'=>'required',
            ]);
            Dokumen::create($request->all());
            return redirect()->route('santris.index')
            ->with('success','dokumen Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function show(Dokumen $dokumen)
    {
        //
        return view('dokumens.show',compact('santri'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokumen $dokumen)
    {
        //
        return view('dokumens.edit',compact('santri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokumen $dokumen)
    {
        //
        $request->validate([
            'santri_id' => 'required',
            'ijazah' => 'required',
            'nilai_raport'=>'required',
            'skhun'=>'required',
            'foto' => 'required',
            'kk'=>'required',
            'ktp_ayah'=>'required',
            'ktp_ibu'=>'required',
            ]);
            $dokumen->update($request->all());
            return redirect()->route('santris.index')
            ->with('success','Dokumen Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokumen $dokumen)
    {
        //
        $dokumen->delete();
        return redirect()->route('dokumens.index')
        ->with('success','Dokumen Berhasil Dihapus');
    }
}

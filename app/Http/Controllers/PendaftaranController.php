<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendaftarans = Pendaftaran::latest()->paginate(5);
        return view('pendaftarans.index', compact('pendaftarans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pendaftarans.create');
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
            'tanggal_pendaftaran' => 'required',
            'status' => 'required',
        ]);
        Pendaftaran::create($request->all());
        return redirect()->route('pendaftarans.index')
            ->with('success', 'Data Pendaftaran Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pendaftaran $pendaftaran)
    {
        //
        return view('pendaftarans.show', compact('pendaftaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        //
        return view('pendaftarans.edit', compact('pendaftaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        //\
        $request->validate([
            'santri_id' => 'required',
            'tanggal_pendaftaran' => 'required',
            'status' => 'required',
        ]);

        $pendaftaran->update($request->all());
        return redirect()->route('pendaftarans.index')
            ->with('success', 'Data Pendaftaran Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        //
        $pendaftaran->delete();
        return redirect()->route('pendaftarans.index')
            ->with('success', 'Data Pendaftaran Berhasil Dihapus');
    }
}

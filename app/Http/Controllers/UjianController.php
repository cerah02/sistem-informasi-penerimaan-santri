<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ujians = ujian::latest()->paginate(5);
        return view('ujians.index', compact('ujians'))
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
        return view('ujians.create');
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
            'mata_pelajaran' => 'required',
            'tanggal_ujian' => 'required',
            'deskripsi' => 'required',
        ]);
        Ujian::create($request->all());
        return redirect()->route('ujians.index')
            ->with('success', 'Data Ujian Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ujian  $ujian
     * @return \Illuminate\Http\Response
     */
    public function show(Ujian $ujian)
    {
        //
        return view('ujians.show', compact('ujian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ujian  $ujian
     * @return \Illuminate\Http\Response
     */
    public function edit(Ujian $ujian)
    {
        //
        return view('ujians.edit', compact('ujian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ujian  $ujian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ujian $ujian)
    {
        //
        $request->validate([
            'mata_pelajaran' => 'required',
            'tanggal_ujian' => 'required',
            'deskripsi' => 'required',
        ]);

        $ujian->update($request->all());
        return redirect()->route('ujians.index')
            ->with('success', 'Data Ujian Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ujian  $ujian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ujian $ujian)
    {
        //
        $ujian->delete();
        return redirect()->route('ujians.index')
            ->with('success', 'Data Ujian Berhasil Dihapus');
    }
}

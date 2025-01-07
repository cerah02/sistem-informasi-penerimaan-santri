<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kelas = Kelas::latest()->paginate(5);
        return view('kelas.index',compact('kelas'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gurus = Guru::all();
        return view('kelas.create',compact('gurus'));
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

        // dd($request->all());
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'id_guru' => 'required',
            ]);
            Kelas::create($request->all());
            return redirect()->route('kelas.index')
            ->with('success','Data Kelas Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.show',compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kls
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kls = Kelas::findOrFail($id);
        return view('kelas.edit',compact('kls'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kls
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'id_guru' => 'required',
            ]);
            $kls = Kelas::findOrFail($id);
            $kls->update($request->all());
            return redirect()->route('kelas.index')
            ->with('success','Data Kelas Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kls
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kls = Kelas::findOrFail($id);
        $kls->delete();
        return redirect()->route('kelas.index')
        ->with('success','Data Kelas Berhasil Dihapus');
    }
}
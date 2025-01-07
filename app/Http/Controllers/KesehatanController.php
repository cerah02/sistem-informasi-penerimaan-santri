<?php

namespace App\Http\Controllers;

use App\Models\Kesehatan;
use Illuminate\Http\Request;

class KesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kesehatans = kesehatan::latest()->paginate(5);
        return view('kesehatans.index',compact('kesehatans'))
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
        return view('kesehatans.create');
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
            'golongan_darah' => 'required',
            'tb'=>'required',
            'bb'=>'required',
            'riwayat_penyakit'=>'required',
            ]);
            Kesehatan::create($request->all());
            return redirect()->route('kesehatans.index')
            ->with('success','Data Kesehatan Santri Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kesehatan  $kesehatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kesehatan $kesehatan)
    {
        //
        return view('kesehatans.show',compact('kesehatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kesehatan  $kesehatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kesehatan $kesehatan)
    {
        //
        return view('kesehatans.edit',compact('kesehatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kesehatan  $kesehatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kesehatan $kesehatan)
    {
        //
        $request->validate([
            'santri_id' => 'required',
            'golongan_darah' => 'required',
            'tb'=>'required',
            'bb'=>'required',
            'riwayat_penyakit'=>'required',
            ]);

            $kesehatan->update($request->all());
            return redirect()->route('kesehatans.index')
            ->with('success','Data Kesehatan Santri Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kesehatan  $kesehatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kesehatan $kesehatan)
    {
        //
        $kesehatan->delete();
        return redirect()->route('kesehatans.index')
        ->with('success','Data Kesehatan Santri Berhasil Dihapus');
    }
}

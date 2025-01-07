<?php

namespace App\Http\Controllers;

use App\Models\Ortu;
use Illuminate\Http\Request;

class OrtuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ortus = ortu::latest()->paginate(5);
        return view('ortus.index',compact('ortus'))
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
        return view('ortus.create');
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
            'nama_ayah' => 'required',
            'pendidikan_ayah'=>'required',
            'pekerjaan_ayah'=>'required',
            'nama_ibu'=>'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required',
            ]);
            Ortu::create($request->all());
            return redirect()->route('ortus.index')
            ->with('success','Data Orang Tua Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function show(Ortu $ortu)
    {
        //
        return view('ortus.show',compact('ortu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function edit(Ortu $ortu)
    {
        //
        return view('ortus.edit',compact('ortu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ortu $ortu)
    {
        //
        $request->validate([
            'santri_id' => 'required',
            'nama_ayah' => 'required',
            'pendidikan_ayah'=>'required',
            'pekerjaan_ayah'=>'required',
            'nama_ibu'=>'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required',
            ]);

            $ortu->update($request->all());
            return redirect()->route('ortus.index')
            ->with('success','Data Orang Tua Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ortu $ortu)
    {
        //
        $ortu->delete();
        return redirect()->route('ortus.index')
        ->with('success','Data Orang Tua Berhasil Dihapus');
    }
}

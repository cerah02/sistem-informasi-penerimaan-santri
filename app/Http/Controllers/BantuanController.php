<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use Illuminate\Http\Request;

class BantuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bantuans = Bantuan::latest()->paginate(5);
        return view('bantuans.index',compact('bantuans'))
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
        return view('bantuans.create');
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
            'nama_bantuan' => 'required',
            'tingkat' =>'required',
            'no_kip' => 'required',
            ]);
            Bantuan::create($request->all());
            return redirect()->route('bantuans.index')
            ->with('success','Data Riwayat Bantuan Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bantuan  $bantuan
     * @return \Illuminate\Http\Response
     */
    public function show(Bantuan $bantuan)
    {
        //
        return view('bantuans.show',compact('bantuan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bantuan  $bantuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Bantuan $bantuan)
    {
        //
        return view('bantuans.edit',compact('bantuan'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bantuan  $bantuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bantuan $bantuan)
    {
        //
        $request->validate([
            'santri_id' => 'required',
            'nama_bantuan' => 'required',
            'tingkat' => 'required',
            'no_kip'=> 'required',
            ]);
            Bantuan::create($request->all());
            return redirect()->route('bantuans.index')
            ->with('success','Data Riwayat Bantuan Berhasil Disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bantuan  $bantuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bantuan $bantuan)
    {
        //
        $bantuan->delete();
        return redirect()->route('bantuans.index')
        ->with('success','Data Riwayat Bantuan Berhasil Dihapus');
    }
}

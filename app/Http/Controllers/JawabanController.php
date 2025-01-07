<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use Illuminate\Http\Request;

class JawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jawabans = Jawaban::latest()->paginate(5);
        return view('jawabans.index',compact('jawabans'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jawabans.create');
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
            'soal_id' => 'required',
            'jawaban' => 'required',
            'is_benar' => 'required',
            ]);
            Jawaban::create($request->all());
            return redirect()->route('jawabans.index')
            ->with('success','Data Jawaban Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function show(Jawaban $jawaban)
    {
        //
        return view('jawabans.show', compact('jawaban'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function edit(Jawaban $jawaban)
    {
        return view('jawabans.edit', compact('jawaban'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jawaban $jawaban)
    {
        //
        $request->validate([
            'soal_id' => 'required',
            'jawaban' => 'required',
            'is_benar' => 'required',
            ]);
            Jawaban::create($request->all());
            return redirect()->route('jawabans.index')
            ->with('success','Data Jawaban Berhasil Disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jawaban $jawaban)
    {
        //
        $jawaban->delete();
        return redirect()->route('jawabans.index')
        ->with('success','Data Jawaban Berhasil Dihapus');
    }
}

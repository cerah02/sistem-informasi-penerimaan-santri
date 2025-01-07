<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $santris = santri::latest()->paginate(5);
        return view('santris.index',compact('santris'))
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
        return view('santris.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        dd($request->all());
        $request->validate([
            'nama' => 'required',
            'nisn' => 'required',
            'nik'=>'required',
            'asal_sekolah'=>'required',
            'jenis_kelamin' => 'required',
            'ttl'=>'required',
            'kondisi'=>'required',
            'kondisi_ortu'=>'required',
            'status_dkluarga'=>'required',
            'tempat_tinggal'=>'required',
            'kewarganegaraan'=>'required',
            'anak_ke'=>'required',
            'jumlah_saudara'=>'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_telpon' => 'required',
            'email' => 'required',
            'jenjang_pendidikan' => 'required',
            ]);
            Santri::create($request->all());
            return redirect()->route('santris.index')
            ->with('success','Data Santri Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function show(Santri $santri)
    {
        //
        return view('santris.show',compact('santri'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function edit(Santri $santri)
    {
        //
        return view('santris.edit',compact('santri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Santri $santri)
    {
        //
        $request->validate([
            'nama' => 'required',
            'nisn' => 'required',
            'nik'=>'required',
            'asal_sekolah'=>'required',
            'jenis_kelamin' => 'required',
            'ttl'=>'required',
            'kondisi'=>'required',
            'kondisi_ortu'=>'required',
            'status_dkluarga'=>'required',
            'tinggal'=>'required',
            'kewarganegaraan'=>'required',
            'anak_ke'=>'requires',
            'jumlah_saudara'=>'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_telpon' => 'required',
            'email' => 'required',
            'jenjang_pendidikan' => 'required',
            ]);

            $santri->update($request->all());
            return redirect()->route('santris.index')
            ->with('success','Data Santri Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Santri $santri)
    {
        //
        $santri->delete();
        return redirect()->route('santris.index')
        ->with('success','Data Santri Berhasil Dihapus');
    }
}

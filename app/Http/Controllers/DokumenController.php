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
        return view('dokumens.index', compact('dokumens'))
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
        // Validasi input
        $request->validate([
            'santri_id' => 'required',
            'ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'nilai_raport' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'skhun' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'foto' => 'required|file|mimes:jpg,jpeg,png,docx|max:2048',
            'kk' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'ktp_ayah' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'ktp_ibu' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
        ]);

        // Inisialisasi array untuk menyimpan data file
        $data = [
            'santri_id' => $request->santri_id,
        ];

        // Proses setiap file
        if ($request->hasFile('ijazah')) {
            $ijazahPath = $request->file('ijazah')->move(public_path('uploads/ijazah'), time() . '_' . $request->file('ijazah')->getClientOriginalName());
            $data['ijazah'] = 'uploads/ijazah/' . basename($ijazahPath);
        }

        if ($request->hasFile('nilai_raport')) {
            $nilaiRaportPath = $request->file('nilai_raport')->move(public_path('uploads/nilai_raport'), time() . '_' . $request->file('nilai_raport')->getClientOriginalName());
            $data['nilai_raport'] = 'uploads/nilai_raport/' . basename($nilaiRaportPath);
        }

        if ($request->hasFile('skhun')) {
            $skhunPath = $request->file('skhun')->move(public_path('uploads/skhun'), time() . '_' . $request->file('skhun')->getClientOriginalName());
            $data['skhun'] = 'uploads/skhun/' . basename($skhunPath);
        }

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->move(public_path('uploads/foto'), time() . '_' . $request->file('foto')->getClientOriginalName());
            $data['foto'] = 'uploads/foto/' . basename($fotoPath);
        }

        if ($request->hasFile('kk')) {
            $kkPath = $request->file('kk')->move(public_path('uploads/kk'), time() . '_' . $request->file('kk')->getClientOriginalName());
            $data['kk'] = 'uploads/kk/' . basename($kkPath);
        }

        if ($request->hasFile('ktp_ayah')) {
            $ktpAyahPath = $request->file('ktp_ayah')->move(public_path('uploads/ktp_ayah'), time() . '_' . $request->file('ktp_ayah')->getClientOriginalName());
            $data['ktp_ayah'] = 'uploads/ktp_ayah/' . basename($ktpAyahPath);
        }

        if ($request->hasFile('ktp_ibu')) {
            $ktpIbuPath = $request->file('ktp_ibu')->move(public_path('uploads/ktp_ibu'), time() . '_' . $request->file('ktp_ibu')->getClientOriginalName());
            $data['ktp_ibu'] = 'uploads/ktp_ibu/' . basename($ktpIbuPath);
        }

        // Simpan data ke database
        Dokumen::create($data);

        // Redirect dengan pesan sukses
        return redirect()->route('dokumens.index')
            ->with('success', 'Dokumen Berhasil Disimpan.');
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
        return view('dokumens.show', compact('santri'));
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
        return view('dokumens.edit', compact('santri'));
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
            'nilai_raport' => 'required',
            'skhun' => 'required',
            'foto' => 'required',
            'kk' => 'required',
            'ktp_ayah' => 'required',
            'ktp_ibu' => 'required',
        ]);
        $dokumen->update($request->all());
        return redirect()->route('dokumenss.index')
            ->with('success', 'Dokumen Berhasil Diupdate');
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
            ->with('success', 'Dokumen Berhasil Dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Models\Dokumen;
use App\Models\Kesehatan;
use App\Models\Ortu;
use App\Models\Pendaftaran;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function santri_pendaftaran_view()
    {
        return view('pendaftarans.main');
    }
    public function pendaftara_santri_simpan(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nisn' => 'required',
            'nik' => 'required',
            'asal_sekolah' => 'required',
            'jenis_kelamin' => 'required',
            'kondisi' => 'required',
            'kondisi_ortu' => 'required',
            'status_dkluarga' => 'required',
            'tempat_tinggal' => 'required',
            'kewarganegaraan' => 'required',
            'anak_ke' => 'required',
            'jumlah_saudara' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_telpon' => 'required',
            'email' => 'required',
            'jenjang_pendidikan' => 'required',
            'nama_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'nama_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'golongan_darah' => 'required',
            'tb' => 'required',
            'bb' => 'required',
            'riwayat_penyakit' => 'required',
            'ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'nilai_raport' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'skhun' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'foto' => 'required|file|mimes:jpg,jpeg,png,docx|max:2048',
            'kk' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'ktp_ayah' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'ktp_ibu' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'nama_bantuan' => 'required',
            'tingkat' => 'required',
            'no_kip' => 'required',
        ]);

        $input = $request->all();
        $input['ttl'] = $request->tempat_lahir . ' ' . $request->tanggal_lahir;
        $santri = Santri::create($input);
        Ortu::create([
            'santri_id' => $santri->id,
            'nama_ayah' => $request->nama_ayah,
            'pendidikan_ayah' => $request->pendidikan_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pendidikan_ibu' => $request->pendidikan_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        // Inisialisasi array untuk menyimpan data file
        $data = [
            'santri_id' => $santri->id,
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
        $input_kesehatan = $request->all();
        $input_kesehatan['santri_id'] = $santri->id;
        Kesehatan::create($input_kesehatan);

        Bantuan::create([
            'santri_id' => $santri->id,
            'nama_bantuan' => $request->nama_bantuan,
            'tingkat' => $request->tingkat,
            'no_kip' => $request->no_kip,
        ]);


        User::create([
            'name' => $santri->nama,
            'email' => $santri->email,
            'password' => Hash::make('123123')
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('santris.index')
            ->with('success', 'Dokumen Berhasil Disimpan.');
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

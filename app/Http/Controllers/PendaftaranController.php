<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Models\Dokumen;
use App\Models\Kesehatan;
use App\Models\Ortu;
use App\Models\Pendaftaran;
use App\Models\Santri;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:pendaftaran-list|pendaftaran-create|pendaftaran-edit|pendaftaran-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:pendaftaran-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pendaftaran-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pendaftaran-delete', ['only' => ['destroy']]);
    }
    public function index_old()
    {
        $pendaftarans = Pendaftaran::latest()->paginate(5);
        return view('pendaftarans.index', compact('pendaftarans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query_data = new Pendaftaran();
            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('tanggal_pendaftaran', 'like', $search_value)
                        ->orwhere('status', 'like', $search_value);
                });
            }
            $data = $query_data->orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $btn = '';
                
                    // Cek permission 'view santri'
                    if (auth()->user()->can('pendaftaran-show')) {
                        $btn .= '<a class="btn btn-info" href="' . route('pendaftarans.show', $row->id) . '">Show</a> ';
                    }
                
                    // Cek permission 'edit pendaftaran'
                    if (auth()->user()->can('pendaftaran-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('pendaftarans.edit', $row->id) . '">Edit</a> ';
                    }
                
                    // Cek permission 'delete pendaftaran'
                    if (auth()->user()->can('pendaftaran-delete')) {
                        $btn .= '
                        <form action="' . route('pendaftarans.destroy', $row->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>';
                    }
                
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('pendaftarans.index');
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
        $input['ttl'] = $request->tempat_lahir . '|' . $request->tanggal_lahir;
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
        Pendaftaran::create([
            'santri_id' => $santri->id,
            'tanggal_pendaftaran' => Carbon::now(),
            'status' => 'proses'
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

        $raw_data = Pendaftaran::with([
            'santri.dokumen',
            'santri.ortu',
            'santri.kesehatan',
            'santri.bantuan'
        ])->get();


        $new_data = [];

        // dd($raw_data);

        foreach ($raw_data as $key => $item_data_raw) {
            $ttl_raw = $item_data_raw->santri->ttl;
            $data_ttl = explode('|',$ttl_raw); 
            $new_data[] = [
                'santri_id' => $item_data_raw->santri->id,
                'nama_santri' => $item_data_raw->santri->nama,
                'nisn' => $item_data_raw->santri->nisn,
                'nik' => $item_data_raw->santri->nik,
                'asal_sekolah' => $item_data_raw->santri->asal_sekolah,
                'jenis_kelamin' => $item_data_raw->santri->jenis_kelamin,
                'tempat_lahir' => $data_ttl[0],
                'tanggal_lahir' => $data_ttl[1],
                'kondisi' => $item_data_raw->santri->kondisi,
                'kondisi_ortu' => $item_data_raw->santri->kondisi_ortu,
                'status_dkluarga' => $item_data_raw->santri->status_dkluarga,
                'tempat_tinggal' => $item_data_raw->santri->tempat_tinggal,
                'kewarganegaraan' => $item_data_raw->santri->kewarganegaraan,
                'anak_ke' => $item_data_raw->santri->anak_ke,
                'jumlah_saudara' => $item_data_raw->santri->jumlah_saudara,
                'alamat_santri' => $item_data_raw->santri->alamat,
                'nomor_telpon' => $item_data_raw->santri->nomor_telpon,
                'email' => $item_data_raw->santri->email,
                'jenjang_pendidikan' => $item_data_raw->santri->jenjang_pendidikan,
                'ijazah' => $item_data_raw->santri->dokumen->ijazah,
                'nilai_raport' => $item_data_raw->santri->dokumen->nilai_raport,
                'skhun' => $item_data_raw->santri->dokumen->skhun,
                'foto' => $item_data_raw->santri->dokumen->foto,
                'kk' => $item_data_raw->santri->dokumen->kk,
                'ktp_ayah' => $item_data_raw->santri->dokumen->ktp_ayah,
                'ktp_ibu' => $item_data_raw->santri->dokumen->ktp_ibu,
                'nama_ayah' => $item_data_raw->santri->ortu->nama_ayah,
                'pendidikan_ayah' => $item_data_raw->santri->ortu->pendidikan_ayah,
                'pekerjaan_ayah' => $item_data_raw->santri->ortu->pekerjaan_ayah,
                'nama_ibu' => $item_data_raw->santri->ortu->nama_ibu,
                'pendidikan_ibu' => $item_data_raw->santri->ortu->pendidikan_ibu,
                'pekerjaan_ibu' => $item_data_raw->santri->ortu->pekerjaan_ibu,
                'no_hp' => $item_data_raw->santri->ortu->no_hp,
                'alamat_ortu' => $item_data_raw->santri->ortu->alamat,
                'golongan_darah' => $item_data_raw->santri->kesehatan->golongan_darah,
                'tb' => $item_data_raw->santri->kesehatan->tb,
                'bb' => $item_data_raw->santri->kesehatan->bb,
                'riwayat_penyakit' => $item_data_raw->santri->kesehatan->riwayat_penyakit,
                'nama_bantuan' => $item_data_raw->santri->bantuan->nama_bantuan,
                'tingkat' => $item_data_raw->santri->bantuan->tingkat,
                'no_kip' => $item_data_raw->santri->bantuan->no_kip,
            ];
        }

        // dd($new_data);


        return view('pendaftarans.edit', compact('new_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validasi data
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
            'alamat_ortu' => 'required',
            'alamat_santri' => 'required',
            'golongan_darah' => 'required',
            'tb' => 'required',
            'bb' => 'required',
            'riwayat_penyakit' => 'required',
            'ijazah' => 'file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'nilai_raport' => 'file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'skhun' => 'file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'foto' => 'file|mimes:jpg,jpeg,png,docx|max:2048',
            'kk' => 'file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'ktp_ayah' => 'file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'ktp_ibu' => 'file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'nama_bantuan' => 'required',
            'tingkat' => 'required',
            'no_kip' => 'required',
        ]);

        // Temukan santri yang akan diupdate
        $santri = Santri::findOrFail($id);

        // Update data santri
        $input = $request->all();
        $input['ttl'] = $request->tempat_lahir . '|' . $request->tanggal_lahir;
        $santri->update($input);

        // Update data orang tua
        $ortu = Ortu::where('santri_id', $santri->id)->first();
        if ($ortu) {
            $ortu->update([
                'nama_ayah' => $request->nama_ayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat_ortu,
            ]);
        }

        // Update dokumen
        $dokumen = Dokumen::where('santri_id', $santri->id)->first();
        if ($dokumen) {
            $data = [];

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

            $dokumen->update($data);
        }

        // Update data kesehatan
        $kesehatan = Kesehatan::where('santri_id', $santri->id)->first();
        if ($kesehatan) {
            $input_kesehatan = $request->all();
            $kesehatan->update($input_kesehatan);
        }

        // Update data bantuan
        $bantuan = Bantuan::where('santri_id', $santri->id)->first();
        if ($bantuan) {
            $bantuan->update([
                'nama_bantuan' => $request->nama_bantuan,
                'tingkat' => $request->tingkat,
                'no_kip' => $request->no_kip,
            ]);
        }

        // Update data user
        $user = User::where('email', $santri->email)->first();
        if ($user) {
            $user->update([
                'name' => $santri->nama,
                'email' => $santri->email,
            ]);
        }

        // Update data pendaftaran
        $pendaftaran = Pendaftaran::where('santri_id', $santri->id)->first();
        if ($pendaftaran) {
            $pendaftaran->update([
                'status' => 'proses', // atau status lain yang sesuai
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('santris.index')
            ->with('success', 'Data Santri Berhasil Diupdate.');
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

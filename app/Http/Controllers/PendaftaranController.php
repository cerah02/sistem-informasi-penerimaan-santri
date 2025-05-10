<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Models\Dokumen;
use App\Models\Kesehatan;
use App\Models\Ortu;
use App\Models\Pendaftaran;
use App\Models\Santri;
use App\Models\User;
use App\Notifications\ApproveDataSantriNotification;
use App\Notifications\FormCompletedNotification;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
            $query_data = Pendaftaran::with('santri');

            if ($request->status) {
                $query_data = $query_data->where('status', $request->status);
            }

            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('tanggal_pendaftaran', 'like', $search_value)
                        ->orWhere('status', 'like', $search_value);
                });
            }

            $data = $query_data->orderBy('created_at', 'desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $btn = '';

                    if (auth()->user()->can('pendaftaran-show')) {
                        $btn .= '<a class="btn btn-info" href="' . route('pendaftarans.show', $row->id) . '">Show</a> ';
                    }

                    if (auth()->user()->can('pendaftaran-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('pendaftarans.edit', $row->id) . '">Edit</a> ';
                    }

                    if (auth()->user()->can('pendaftaran-delete')) {
                        $btn .= '
                        <form action="' . route('pendaftarans.destroy', $row->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>';
                    }

                    return $btn;
                })
                ->addColumn('nama_santri', function ($row) {
                    return $row->santri->nama ?? '-';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('pendaftarans.index');
    }

    public function santri_pendaftaran_view()
    {
        $user = auth()->user();

        // Ambil data santri beserta relasi-relasinya
        $santri = Santri::with(['ortu', 'kesehatan', 'bantuan', 'dokumen'])
            ->where('user_id', $user->id)
            ->first();

        return view('pendaftarans.main', compact('santri'));
    }


    public function pendaftara_santri_simpan(Request $request)
    {
        $user = auth()->user();

        // Cek apakah santri dan dokumennya sudah ada
        $santri = Santri::with('dokumen')->where('user_id', $user->id)->first();
        $dokumen = $santri ? $santri->dokumen : null;

        // Validasi request
        $request->validate([
            'nama' => 'required',
            'nisn' => 'required|numeric',
            'nik' => 'required|numeric',
            'asal_sekolah' => 'required',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'kondisi' => 'required',
            'kondisi_ortu' => 'required',
            'status_dkluarga' => 'required',
            'tempat_tinggal' => 'required',
            'kewarganegaraan' => 'required',
            'anak_ke' => 'required',
            'jumlah_saudara' => 'required|numeric',
            'alamat' => 'required',
            'nomor_telpon' => 'required',
            'email' => 'required|email',
            'jenjang_pendidikan' => 'required',
            'nama_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'nama_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'no_hp' => 'required',
            'golongan_darah' => 'required',
            'tb' => 'required|numeric',
            'bb' => 'required|numeric',
            'riwayat_penyakit' => 'required',
            'ijazah' => ($dokumen && $dokumen->ijazah) ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120' : 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'nilai_raport' => ($dokumen && $dokumen->nilai_raport) ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120' : 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'skhun' => ($dokumen && $dokumen->skhun) ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120' : 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'foto' => ($dokumen && $dokumen->foto) ? 'nullable|file|mimes:jpg,jpeg,png|max:5120' : 'required|file|mimes:jpg,jpeg,png|max:5120',
            'kk' => ($dokumen && $dokumen->kk) ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120' : 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'ktp_ayah' => ($dokumen && $dokumen->ktp_ayah) ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120' : 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'ktp_ibu' => ($dokumen && $dokumen->ktp_ibu) ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120' : 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'nama_bantuan' => 'required',
            'tingkat' => 'required',
            'no_kip' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            // Cek ulang atau buat baru
            if (!$santri) {
                $santri = new Santri();
                $santri->user_id = $user->id;
            }

            $santri->fill([
                'nama' => $request->nama,
                'nisn' => $request->nisn,
                'nik' => $request->nik,
                'asal_sekolah' => $request->asal_sekolah,
                'jenis_kelamin' => $request->jenis_kelamin,
                'ttl' => $request->tempat_lahir . '|' . $request->tanggal_lahir,
                'kondisi' => $request->kondisi,
                'kondisi_ortu' => $request->kondisi_ortu,
                'status_dkluarga' => $request->status_dkluarga,
                'tempat_tinggal' => $request->tempat_tinggal,
                'kewarganegaraan' => $request->kewarganegaraan,
                'anak_ke' => $request->anak_ke,
                'jumlah_saudara' => $request->jumlah_saudara,
                'alamat' => $request->alamat,
                'nomor_telpon' => $request->nomor_telpon,
                'email' => $request->email,
                'jenjang_pendidikan' => $request->jenjang_pendidikan,
                'tahun_masuk' => date('Y')
            ]);
            $santri->save();

            // ORTU
            Ortu::updateOrCreate(
                ['santri_id' => $santri->id],
                [
                    'nama_ayah' => $request->nama_ayah,
                    'pendidikan_ayah' => $request->pendidikan_ayah,
                    'pekerjaan_ayah' => $request->pekerjaan_ayah,
                    'nama_ibu' => $request->nama_ibu,
                    'pendidikan_ibu' => $request->pendidikan_ibu,
                    'pekerjaan_ibu' => $request->pekerjaan_ibu,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                ]
            );

            // KESEHATAN
            Kesehatan::updateOrCreate(
                ['santri_id' => $santri->id],
                [
                    'golongan_darah' => $request->golongan_darah,
                    'tb' => $request->tb,
                    'bb' => $request->bb,
                    'riwayat_penyakit' => $request->riwayat_penyakit
                ]
            );

            // BANTUAN
            Bantuan::updateOrCreate(
                ['santri_id' => $santri->id],
                [
                    'nama_bantuan' => $request->nama_bantuan,
                    'tingkat' => $request->tingkat,
                    'no_kip' => $request->no_kip
                ]
            );

            // DOKUMEN
            $dokumenData = ['santri_id' => $santri->id];
            $fileFields = ['ijazah', 'nilai_raport', 'skhun', 'foto', 'kk', 'ktp_ayah', 'ktp_ibu'];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    // Hapus file lama jika ada
                    if ($dokumen && $dokumen->$field && Storage::disk('public')->exists($dokumen->$field)) {
                        Storage::disk('public')->delete($dokumen->$field);
                    }

                    $file = $request->file($field);
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads/' . $field, $fileName, 'public');
                    $dokumenData[$field] = $path;
                } elseif ($dokumen && $dokumen->$field) {
                    // Jika tidak upload ulang, simpan path lama
                    $dokumenData[$field] = $dokumen->$field;
                }
            }

            Dokumen::updateOrCreate(
                ['santri_id' => $santri->id],
                $dokumenData
            );

            // PENDAFTARAN
            Pendaftaran::updateOrCreate(
                ['santri_id' => $santri->id],
                ['tanggal_pendaftaran' => now(), 'status' => 'proses']
            );

            // Kirim notifikasi selamat datang ke user
            $user->notify(new FormCompletedNotification());

            DB::commit();
            return redirect()->route('santri_pendaftaran_view')->with('success', 'Pendaftaran berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
        $santri = $pendaftaran->santri;

        // Pastikan relasi sudah di-load
        $santri->load(['ortu', 'kesehatan', 'bantuan', 'dokumen']);

        return view('pendaftarans.show', compact('santri'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        // Ambil data relasi santri jika diperlukan
        $new_data = [
            'nama_santri' => $pendaftaran->santri->nama ?? '',
            'tanggal_pendaftaran' => $pendaftaran->tanggal_pendaftaran,
            'status' => $pendaftaran->status,
        ];

        return view('pendaftarans.edit', compact('pendaftaran', 'new_data'));
    }

    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'tanggal_pendaftaran' => 'required|date',
            'status' => 'required|in:proses,diterima,ditolak',
        ]);

        $oldStatus = $pendaftaran->status;

        $pendaftaran->update([
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
            'status' => $request->status,
        ]);

        // Kirim notifikasi jika status diterima
        // Hanya kirim notifikasi jika status berubah menjadi 'diterima'
        if ($oldStatus !== 'diterima' && $request->status === 'diterima') {
            $user = $pendaftaran->santri->user ?? null;

            if ($user) {
                $user->notify(new ApproveDataSantriNotification());
            }
        }

        return redirect()->route('pendaftarans.index')
            ->with('success', 'Data pendaftaran berhasil diperbarui.');
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

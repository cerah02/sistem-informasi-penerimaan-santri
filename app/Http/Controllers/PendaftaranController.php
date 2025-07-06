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
use App\Notifications\StatusPendaftaranUpdated;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
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
                        $btn .= '<a class="btn btn-info" href="' . route('pendaftarans.show', $row->id) . '">Lihat</a> ';
                    }

                    if (auth()->user()->can('pendaftaran-edit')) {
                        $btn .= '<button class="btn btn-warning verifikasi-btn"
                    data-id="' . $row->id . '"
                    data-status="' . $row->status . '">
                Verifikasi
            </button> ';
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
            'alamat_ortu' => 'required',
            'golongan_darah' => 'required',
            'tb' => 'required|numeric',
            'bb' => 'required|numeric',
            'riwayat_penyakit' => 'nullable',
            'akta_kelahiran' => ($dokumen && $dokumen->akta_kelahiran) ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120' : 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'foto' => ($dokumen && $dokumen->foto) ? 'nullable|file|mimes:jpg,jpeg,png|max:5120' : 'required|file|mimes:jpg,jpeg,png|max:5120',
            'ktp_ayah' => ($dokumen && $dokumen->ktp_ayah) ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120' : 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'ktp_ibu' => ($dokumen && $dokumen->ktp_ibu) ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120' : 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'kk' => ($dokumen && $dokumen->kk) ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120' : 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'ijazah' => ($dokumen && $dokumen->ijazah) ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120' : 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'skhun' => ($dokumen && $dokumen->skhun) ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120' : 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'nilai_raport' => ($dokumen && $dokumen->nilai_raport) ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120' : 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'nama_bantuan' => 'required',
            'tingkat' => 'required',
            'no_kip' => 'nullable|numeric',
        ], [
            'nama.required' => 'Nama santri wajib diisi.',
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.numeric' => 'NISN harus berupa angka.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'asal_sekolah.required' => 'Asal sekolah wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus antara laki-laki atau perempuan.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'kondisi.required' => 'Kondisi santri wajib diisi.',
            'kondisi_ortu.required' => 'Kondisi orang tua wajib diisi.',
            'status_dkluarga.required' => 'Status dalam keluarga wajib diisi.',
            'tempat_tinggal.required' => 'Tempat tinggal wajib diisi.',
            'kewarganegaraan.required' => 'Kewarganegaraan wajib diisi.',
            'anak_ke.required' => 'Anak ke-berapa harus diisi.',
            'jumlah_saudara.required' => 'Jumlah saudara wajib diisi.',
            'jumlah_saudara.numeric' => 'Jumlah saudara harus berupa angka.',
            'alamat.required' => 'Alamat lengkap wajib diisi.',
            'nomor_telpon.required' => 'Nomor telepon wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'jenjang_pendidikan.required' => 'Jenjang pendidikan wajib dipilih.',
            'nama_ayah.required' => 'Nama ayah wajib diisi.',
            'pendidikan_ayah.required' => 'Pendidikan ayah wajib diisi.',
            'pekerjaan_ayah.required' => 'Pekerjaan ayah wajib diisi.',
            'nama_ibu.required' => 'Nama ibu wajib diisi.',
            'pendidikan_ibu.required' => 'Pendidikan ibu wajib diisi.',
            'pekerjaan_ibu.required' => 'Pekerjaan ibu wajib diisi.',
            'no_hp.required' => 'Nomor HP orang tua wajib diisi.',
            'alamat_ortu.required' => 'Alamat orang tua wajib diisi.',
            'golongan_darah.required' => 'Golongan darah wajib diisi.',
            'tb.required' => 'Tinggi badan wajib diisi.',
            'tb.numeric' => 'Tinggi badan harus berupa angka.',
            'bb.required' => 'Berat badan wajib diisi.',
            'bb.numeric' => 'Berat badan harus berupa angka.',
            'akta_kelahiran.required' => 'File akta kelahiran wajib diunggah.',
            'akta_kelahiran.file' => 'File akta kelahiran harus berupa dokumen.',
            'akta_kelahiran.mimes' => 'Akta kelahiran harus bertipe: pdf, jpg, jpeg, atau png.',
            'akta_kelahiran.max' => 'Ukuran akta kelahiran maksimal 5MB.',
            'foto.required' => 'Foto wajib diunggah.',
            'ktp_ayah.required' => 'KTP ayah wajib diunggah.',
            'ktp_ibu.required' => 'KTP ibu wajib diunggah.',
            'kk.required' => 'Kartu Keluarga wajib diunggah.',
            'nama_bantuan.required' => 'Nama bantuan wajib diisi.',
            'tingkat.required' => 'Tingkat bantuan wajib diisi.',
            'no_kip.numeric' => 'Nomor KIP harus berupa angka.',
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
                    'alamat_ortu' => $request->alamat_ortu,
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
            $fileFields = ['ijazah', 'akta_kelahiran', 'nilai_raport', 'skhun', 'foto', 'kk', 'ktp_ayah', 'ktp_ibu'];

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

    public function admin_pendaftaran_santri_view()
    {
        return view('pendaftarans.create_byadmin');
    }

    public function admin_pendaftaran_santri_simpan(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'nisn' => 'required|numeric|unique:santris,nisn',
            'nik' => 'required|numeric|unique:santris,nik',
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
            'jenjang_pendidikan' => 'required',
            'nama_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'nama_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'no_hp' => 'required',
            'alamat_ortu' => 'required',
            'golongan_darah' => 'required',
            'tb' => 'required|numeric',
            'bb' => 'required|numeric',
            'riwayat_penyakit' => 'nullable',
            'akta_kelahiran' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'foto' => 'required|file|mimes:jpg,jpeg,png|max:5120',
            'ktp_ayah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'ktp_ibu' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'kk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'skhun' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'nilai_raport' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'nama_bantuan' => 'required',
            'tingkat' => 'required',
            'no_kip' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make('12341234'),
            ]);

            $role = Role::whereIn('name', ['Santri', 'santri'])->first();
            $user->assignRole([$role->id]);

            $santri = new Santri();
            $santri->fill([
                'user_id' => $user->id,
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
                'tahun_masuk' => now()->year,
            ]);
            $santri->save();

            Ortu::create([
                'santri_id' => $santri->id,
                'nama_ayah' => $request->nama_ayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'no_hp' => $request->no_hp,
                'alamat_ortu' => $request->alamat_ortu,
            ]);

            Kesehatan::create([
                'santri_id' => $santri->id,
                'golongan_darah' => $request->golongan_darah,
                'tb' => $request->tb,
                'bb' => $request->bb,
                'riwayat_penyakit' => $request->riwayat_penyakit,
            ]);

            Bantuan::create([
                'santri_id' => $santri->id,
                'nama_bantuan' => $request->nama_bantuan,
                'tingkat' => $request->tingkat,
                'no_kip' => $request->no_kip,
            ]);

            $dokumenData = ['santri_id' => $santri->id];
            $fileFields = ['ijazah', 'akta_kelahiran', 'nilai_raport', 'skhun', 'foto', 'kk', 'ktp_ayah', 'ktp_ibu'];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads/' . $field, $fileName, 'public');
                    $dokumenData[$field] = $path;
                }
            }

            Dokumen::create($dokumenData);

            Pendaftaran::create([
                'santri_id' => $santri->id,
                'tanggal_pendaftaran' => now(),
                'status' => 'proses'
            ]);

            DB::commit();

            return redirect()->route('admin_pendaftaran_santri_view')->with('success', 'Data santri berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Admin Gagal Simpan Santri: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data!');
        }
    }

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

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:proses,diterima,ditolak,perbaikan',
            'pesan' => 'nullable|string'
        ]);

        try {
            $pendaftaran = Pendaftaran::findOrFail($id);
            $pendaftaran->status = $request->status;
            $pendaftaran->save();

            $santri = \App\Models\Santri::find($pendaftaran->santri_id);

            if ($santri && $santri->user) {
                $user = $santri->user;
                $user->notify(new \App\Notifications\StatusPendaftaranUpdated(
                    $request->status,
                    $request->pesan,
                    $pendaftaran->id
                ));
            } else {
                \Log::warning("User tidak ditemukan untuk santri_id: " . $pendaftaran->santri_id);
            }


            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Update Status Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}

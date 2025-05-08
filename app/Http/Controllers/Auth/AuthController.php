<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Hasil;
use App\Models\Pendaftaran;
use App\Models\Pengumuman;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only(
            'email',
            'password'
        );
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully loggedin');
        }
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data = $request->all();
        $check = $this->create($data);
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    public function edit_profile()
    {
        return View('auth.edit_profile');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard(Request $request)
    {
        $Guru = "";
        $Santri = "";

        if (Auth::check()) {
            if (Auth::user()->hasRole('Guru')) {
                $Guru = Guru::where('email', auth()->user()->email)->first();
            } elseif (Auth::user()->hasRole('Santri')) {
                $Santri = Santri::with(['dokumen', 'hasil.ujian'])->where('email', auth()->user()->email)->first();
            }

            // Cek pengumuman aktif
            $pengumuman = Pengumuman::where('is_active', true)
                ->where('tanggal_rilis', '<=', now())
                ->first();

            $kelulusan_santri = null;
            if ($Santri && $pengumuman) {
                $hasil_sesuai_jenjang = $Santri->hasil->filter(function ($item) use ($Santri) {
                    return $item->ujian->jenjang_pendidikan === $Santri->jenjang_pendidikan;
                });

                $total_nilai = $hasil_sesuai_jenjang->sum('total_nilai_kategori');
                $jumlah_ujian = $hasil_sesuai_jenjang->count();
                $rata_rata = $jumlah_ujian > 0 ? $total_nilai / $jumlah_ujian : 0;
                $status = $rata_rata >= 70 ? 'Lulus' : 'Tidak Lulus';

                $kelulusan_santri = [
                    'nama_santri' => $Santri->nama,
                    'foto' => $Santri->dokumen->foto ?? null,
                    'jenjang' => $Santri->jenjang_pendidikan,
                    'nisn' => $Santri->nisn,
                    'nik' => $Santri->nik,
                    'ttl' => $Santri->ttl,
                    'jenis_kelamin' => $Santri->jenis_kelamin,
                    'asal_sekolah' => $Santri->asal_sekolah,
                    'alamat' => $Santri->alamat,
                    'total_nilai' => $total_nilai,
                    'rata_rata' => round($rata_rata, 2),
                    'status_kelulusan' => $status,
                ];
            }

            // Hitung total santri yang memiliki jenjang dan tahun masuk
            $jumlah_santri = Santri::whereNotNull('jenjang_pendidikan')
                ->whereNotNull('tahun_masuk')
                ->count();

            // Filter untuk santri
            $query = Santri::query();
            if ($request->jenjang_filter) {
                $query->where('jenjang_pendidikan', $request->jenjang_filter);
            }
            if ($request->year) {
                $query->where('tahun_masuk', $request->year);
            }

            // Tambahkan pengecekan kolom tidak null
            $query->whereNotNull('jenjang_pendidikan')
                ->whereNotNull('tahun_masuk');

            $hitung_santri_byfilter = $query->count();

            // Data tambahan
            $jumlah_santri_mendaftar_tahun_ini = Santri::whereYear('created_at', Carbon::now()->year)->count();
            $jumlah_santri_yang_sudah_disetujui = Pendaftaran::where('status', 'diterima')->count();
            $jumlah_santri_yang_menunggu_disetujui = Pendaftaran::where('status', 'proses')->count();

            // Data nilai hasil ujian
            $data_hasil = Hasil::with(['santri', 'ujian'])->get();

            $data_ujian = $data_hasil->groupBy('santri_id')->map(function ($group) {
                $santri = $group->first()->santri;
                $jenjang = $santri->jenjang_pendidikan;

                $hasil_sesuai_jenjang = $group->filter(function ($item) use ($jenjang) {
                    return $item->ujian->jenjang_pendidikan == $jenjang;
                });

                $nilai_permapel = $hasil_sesuai_jenjang->mapWithKeys(function ($item) {
                    return [$item->ujian->nama_ujian => $item->total_nilai_kategori];
                });

                $total_nilai = $hasil_sesuai_jenjang->sum('total_nilai_kategori');
                $jumlah_ujian = $hasil_sesuai_jenjang->count();
                $rata_rata = $jumlah_ujian > 0 ? $total_nilai / $jumlah_ujian : 0;
                $status = $rata_rata >= 70 ? 'Lulus' : 'Tidak Lulus';

                return [
                    'nama_santri' => $santri->nama,
                    'jenjang' => $jenjang,
                    'nilai_permapel' => $nilai_permapel,
                    'total_nilai' => $total_nilai,
                    'rata_rata' => round($rata_rata, 2),
                    'status_kelulusan' => $status,
                ];
            })->values();

            $jenjang_list = $data_ujian->pluck('jenjang')->unique();

            // Data untuk Chart Perkembangan Santri
            $data = Santri::select('tahun_masuk', 'jenjang_pendidikan', DB::raw('count(*) as total'))
                ->whereNotNull('jenjang_pendidikan')
                ->whereNotNull('tahun_masuk')
                ->groupBy('tahun_masuk', 'jenjang_pendidikan')
                ->orderBy('tahun_masuk')
                ->get();

            $years = $data->pluck('tahun_masuk')->unique()->sort()->values();
            $jenjangs = ['SD', 'MTS', 'MA'];
            $chartData = [];

            foreach ($jenjangs as $jenjang) {
                $chartData[$jenjang] = [];
                foreach ($years as $year) {
                    $count = $data->firstWhere(fn($item) => $item->tahun_masuk == $year && $item->jenjang_pendidikan == $jenjang);
                    $chartData[$jenjang][] = $count ? $count->total : 0;
                }
            }

            // Data gender santri sesuai filter dan validasi kolom
            $genderQuery = Santri::whereNotNull('jenjang_pendidikan')
                ->whereNotNull('tahun_masuk');

            if ($request->year) {
                $genderQuery->where('tahun_masuk', $request->year);
            }
            if ($request->jenjang_filter) {
                $genderQuery->where('jenjang_pendidikan', $request->jenjang_filter);
            }

            $jumlah_laki_laki = (clone $genderQuery)->where('jenis_kelamin', 'laki-laki')->count();
            $jumlah_perempuan = (clone $genderQuery)->where('jenis_kelamin', 'perempuan')->count();

            // Data kelengkapan tabel santri, ortu, dokumen, kesehatan, bantuan
            $santriData = $query->get()->map(function ($santri) {
                // Mengecek kelengkapan data dari tabel santri
                $santri_complete = $santri->nama &&
                    $santri->nisn &&
                    $santri->nik &&
                    $santri->asal_sekolah &&
                    $santri->jenis_kelamin &&
                    $santri->ttl &&
                    $santri->kondisi &&
                    $santri->kondisi_ortu &&
                    $santri->status_dkluarga &&
                    $santri->tempat_tinggal &&
                    $santri->kewarganegaraan &&
                    $santri->anak_ke &&
                    $santri->jumlah_saudara !== null &&
                    $santri->alamat &&
                    $santri->nomor_telpon &&
                    $santri->email &&
                    $santri->jenjang_pendidikan &&
                    $santri->tahun_masuk ? 'Lengkap' : 'Tidak Lengkap';

                // Mengecek kelengkapan data dari tabel ortu
                $ortu_complete = $santri->ortu &&
                    $santri->ortu->nama_ayah &&
                    $santri->ortu->pendidikan_ayah &&
                    $santri->ortu->pekerjaan_ayah &&
                    $santri->ortu->nama_ibu &&
                    $santri->ortu->pendidikan_ibu &&
                    $santri->ortu->pekerjaan_ibu &&
                    $santri->ortu->no_hp &&
                    $santri->ortu->alamat ? 'Lengkap' : 'Tidak Lengkap';

                // Mengecek kelengkapan data dari tabel dokumen
                $dokumen_complete = $santri->dokumen &&
                    $santri->dokumen->ijazah &&
                    $santri->dokumen->nilai_raport &&
                    $santri->dokumen->skhun &&
                    $santri->dokumen->foto &&
                    $santri->dokumen->kk &&
                    $santri->dokumen->ktp_ayah &&
                    $santri->dokumen->ktp_ibu ? 'Lengkap' : 'Tidak Lengkap';

                // Mengecek kelengkapan data dari tabel kesehatan
                $kesehatan_complete = $santri->kesehatan &&
                    $santri->kesehatan->golongan_darah &&
                    $santri->kesehatan->tb !== null &&
                    $santri->kesehatan->bb !== null &&
                    $santri->kesehatan->riwayat_penyakit ? 'Lengkap' : 'Tidak Lengkap';

                // Mengecek kelengkapan data dari tabel bantuan
                $bantuan_complete = $santri->bantuan &&
                    $santri->bantuan->nama_bantuan &&
                    $santri->bantuan->tingkat &&
                    $santri->bantuan->no_kip ? 'Lengkap' : 'Tidak Lengkap';

                return [
                    'nama_santri' => $santri->nama,
                    'jenjang_pendidikan' => $santri->jenjang_pendidikan,
                    'santri_complete' => $santri_complete,
                    'ortu_complete' => $ortu_complete,
                    'dokumen_complete' => $dokumen_complete,
                    'kesehatan_complete' => $kesehatan_complete,
                    'bantuan_complete' => $bantuan_complete,
                ];
            });

            return view('auth.dashboard', compact(
                'Guru',
                'Santri',
                'kelulusan_santri',
                'jumlah_santri',
                'hitung_santri_byfilter',
                'jumlah_santri_mendaftar_tahun_ini',
                'jumlah_santri_yang_sudah_disetujui',
                'jumlah_santri_yang_menunggu_disetujui',
                'data_ujian',
                'jenjang_list',
                'years',
                'chartData',
                'jumlah_laki_laki',
                'jumlah_perempuan',
                'santriData'
            ));
        }

        return redirect("login")->withErrors('Maaf! Kamu tidak memiliki akses masuk');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        $santri = Santri::create([
            'user_id' => $user->id,
            'nama' => $user->name
        ]);
        $role = Role::where('name', '=', 'Santri')->orWhere('name', '=', 'santri')->first();
        $user->assignRole([$role->id]);
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Validasi gambar
            'password' => 'nullable|string'
        ]);

        // dd($request->all());

        $user = auth()->user();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        // Handle upload gambar
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/profil', $filename);

            // Hapus gambar lama jika ada
            if ($user->profile_image && file_exists(storage_path('app/public/profil/' . $user->foto))) {
                unlink(storage_path('app/public/profil/' . $user->foto));
            }

            // Simpan nama file ke database
            $data['foto'] = $filename;
        }

        // Update user
        $user->update($data);

        return redirect()->route('dashboard')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}

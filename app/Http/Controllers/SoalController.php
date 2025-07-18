<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Soal;
use App\Models\Ujian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LDAP\Result;
use Yajra\DataTables\Facades\DataTables;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:soal-list|soal-create|soal-edit|soal-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:soal-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:soal-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:soal-delete', ['only' => ['destroy']]);
    }
    public function index_old()
    {
        //
        $soals = soal::latest()->paginate(5);
        return view('soals.index', compact('soals'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function index(Request $request, $id)
    {
        if ($request->ajax()) {
            $query_data = new soal();

            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('ujian_id', 'like', $search_value);
                });
            }

            if ($request->has('status_filter') && $request->status_filter != '') {
                $query_data = $query_data->where('status', $request->status_filter);
            }

            $data = $query_data->where('ujian_id', '=', $id)->orderBy('ujian_id', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status === 'dipilih' ? 'checked' : '';
                    $badge = $row->status === 'dipilih' ? 'success' : 'danger';
                    $label = ucfirst($row->status);
                    return '
        <div class="form-check form-switch">
            <input class="form-check-input toggle-status" type="checkbox" data-id="' . $row->id . '" ' . $checked . '>
            <span class="badge bg-' . $badge . ' mt-1">' . $label . '</span>
        </div>
    ';
                })

                ->addColumn('aksi', function ($row) {
                    $btn = '';


                    if (auth()->user()->can('ujian-show')) {
                        $btn .= '<a class="btn btn-info" href="' . route('soals.show', $row->id) . '">Show</a> ';
                    }


                    if (auth()->user()->can('ujian-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('soals.edit', $row->id) . '">Edit</a> ';
                    }

                    if (auth()->user()->can('ujian-delete')) {
                        $btn .= '
                        <form action="' . route('soals.destroy', $row->ujian_id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>';
                    }

                    return $btn;
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);
        }
        return view('soals.index', compact('id'));
    }

    public function updateStatus(Request $request, $id)
    {
        $soal = Soal::findOrFail($id);
        $soal->status = $request->status;
        $soal->save();

        return response()->json([
            'success' => true,
            'message' => 'Status soal berhasil diperbarui menjadi ' . $request->status
        ]);
    }

    // // Ambil ID user yang sedang login
    // $id_user = 1;

    // //  Ambil semua soal yang sudah dikerjakan oleh user
    // $soalDikerjakan = Jawaban::where('santri_id', $id_user)
    //     ->with('soal.ujian') // Eager load relasi soal dan ujian
    //     ->get();


    // // // Inisialisasi array untuk menyimpan ujian yang sudah dikerjakan
    // $ujianDikerjakan = [];
    // // Loop melalui soal yang sudah dikerjakan
    // foreach ($soalDikerjakan as $jawaban) {
    //     $soal = $jawaban->soal;
    //     $ujian = $soal->ujian;

    // //     // Simpan ujian_id ke dalam array
    // // }
    // $ujianDikerjakan[$ujian->id] = $ujian;


    // // Ambil semua ujian beserta jumlah soal
    // $ujians = Ujian::withCount('soal')->get();
    // dd($ujians);
    // foreach ($ujians as $ujian) {
    //     $ujian->user_already_submit = isset($ujianDikerjakan[$ujian->id]);
    // }
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function ujian($id)
    {
        $Santri = auth()->user()->santri;

        if (!$Santri) {
            return redirect()->route('dashboard')->with('error', 'Data santri tidak ditemukan.');
        }

        // Ambil data ujian dengan validasi jenjang & tahun
        $ujian = Ujian::where('id', $id)
            ->where('jenjang_pendidikan', $Santri->jenjang_pendidikan)
            ->where('tahun_ajaran', $Santri->tahun_masuk)
            ->first();

        if (!$ujian) {
            return redirect()->route('dashboard')->with('error', 'Ujian tidak ditemukan atau Anda tidak berhak mengaksesnya.');
        }

        // Urutan soal di session
        if (!session()->has("urutan_soal_ujian_$id")) {
            $soalIds = Soal::where('ujian_id', $id)
                ->where('status', 'dipilih') // 👈 hanya soal dipilih
                ->pluck('id')
                ->shuffle()
                ->toArray();

            if (empty($soalIds)) {
                return redirect()->route('dashboard')->with('error', 'Belum ada soal yang dipilih untuk ujian ini.');
            }

            session()->put("urutan_soal_ujian_$id", $soalIds);
        } else {
            $soalIds = session("urutan_soal_ujian_$id");
        }

        $soals = Soal::whereIn('id', $soalIds)->get()->sortBy(function ($soal) use ($soalIds) {
            return array_search($soal->id, $soalIds);
        });

        return view('soals.ujian', compact('soals', 'ujian'));
    }



    public function submitUjian(Request $request)
    {
        // Ambil ID santri yang sedang login
        $santri_id = Auth::user()->santri->id ?? null;

        if (!$santri_id) {
            return redirect()->route('dashboard')->with('error', 'Anda harus login sebagai santri.');
        }

        // Ambil jawaban user dari request
        $jawabanUser = $request->jawaban; // Array jawaban dari user

        // Ambil semua soal untuk ujian ini
        $soals = Soal::where('ujian_id', '=', $request->ujian_id)
            ->where('status', 'dipilih')
            ->get();

        $results = [];

        // Loop melalui setiap soal
        foreach ($soals as $soal) {
            $jawabanBenar = $soal->jawaban_benar;
            $jawabanDipilih = $jawabanUser[$soal->id] ?? null;

            // Tentukan status jawaban
            $status_jawaban = ($jawabanDipilih === $jawabanBenar) ? 'Benar' : 'Salah';

            // Simpan jawaban ke tabel jawabans
            Jawaban::updateOrCreate(
                [
                    'soal_id' => $soal->id,
                    'santri_id' => $santri_id,
                ],
                [
                    'jawaban' => $jawabanDipilih ?? 'Tidak diisi', // Jika jawaban tidak dipilih, isi dengan 'Tidak diisi'
                    'status_jawaban' => $status_jawaban,
                ]
            );

            // Tambahkan hasil ke array results untuk ditampilkan di view
            $results[] = [
                'soal_id' => $soal->id,
                'pertanyaan' => $soal->pertanyaan,
                'jawaban_benar' => $jawabanBenar,
                'jawaban_dipilih' => $jawabanDipilih,
                'status' => $status_jawaban,
            ];
        }

        $ujian_id = $request->ujian_id;
        $jumlah_soal = count($results);
        $jawaban_benar = 0;
        $jawaban_salah = 0;
        $keterangan = null;



        foreach ($results as $result) {
            if ($result['status'] === 'Benar') {
                $jawaban_benar++;
            } elseif ($result['status'] === 'Salah') {
                $jawaban_salah++;
            }
        }

        $total_nilai_kategori = ($jawaban_benar / $jumlah_soal) * 100;

        if ($total_nilai_kategori <= 70) {
            $keterangan = 'Kurang Baik';
        } elseif ($total_nilai_kategori > 70 && $total_nilai_kategori <= 85) {
            $keterangan = 'Baik';
        } elseif ($total_nilai_kategori > 85) {
            $keterangan = 'Amat Baik';
        }

        DB::table("hasils")->insert([
            'santri_id' => $santri_id,
            'ujian_id' => $ujian_id,
            'jumlah_soal' => $jumlah_soal,
            'jawaban_benar' => $jawaban_benar,
            'jawaban_salah' => $jawaban_salah,
            'total_nilai_kategori' => $total_nilai_kategori,
            'keterangan' => $keterangan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // =====================================
        // Tambahan: Logika untuk total_hasils
        // =====================================

        // Hitung total jadwal ujian untuk jenjang santri
        $jenjang = Auth::user()->santri->jenjang_pendidikan;
        $totalUjianJenjang = DB::table('ujians')
            ->where('jenjang_pendidikan', $jenjang)
            ->count();

        // Hitung jumlah hasil ujian yang sudah dikerjakan oleh santri
        $jumlahHasil = DB::table('hasils')
            ->where('santri_id', $santri_id)
            ->distinct('ujian_id')
            ->count('ujian_id');

        if ($jumlahHasil == $totalUjianJenjang) {
            // Hitung rata-rata nilai
            $rataRata = DB::table('hasils')
                ->where('santri_id', $santri_id)
                ->avg('total_nilai_kategori');

            // Ambil passing grade sesuai jenjang santri
            $passingGrade = DB::table('passing_grades')
                ->where('jenjang', $jenjang)
                ->value('passing_grade');

            $statusKelulusan = $rataRata >= $passingGrade ? 'Lulus' : 'Tidak Lulus';

            // Simpan atau update ke tabel total_hasils
            DB::table('total_hasils')->updateOrInsert(
                ['santri_id' => $santri_id],
                [
                    'rata_rata' => $rataRata,
                    'status' => $statusKelulusan,
                ]
            );
        }

        // Redirect ke halaman hasil dengan data results
        return view('soals.hasil', compact('results'));
    }

    public function list_soal()
    {
        $Santri = auth()->user()->santri;

        if (!$Santri) {
            return redirect()->route('dashboard')->with('error', 'Data santri tidak ditemukan.');
        }

        // Cek status pendaftaran dari tabel pendaftarans
        $pendaftaran = \App\Models\Pendaftaran::where('santri_id', $Santri->id)->first();

        if (!$pendaftaran) {
            return redirect()->route('santri_pendaftaran_view')->with('error', 'Silakan isi data diri dan lengkapi berkas terlebih dahulu.');
        }

        $status = strtolower($pendaftaran->status);

        if ($status === 'proses') {
            return redirect()->route('santri_pendaftaran_view')->with('error', 'Status pendaftaran Anda masih dalam proses pengecekan oleh panitia. Harap sabar dan jika ada kendala hubungi kepanitian.');
        }

        if ($status === 'perbaikan') {
            return redirect()->route('santri_pendaftaran_view')->with('error', 'Data Anda perlu perbaikan. Silakan periksa kembali dan lengkapi berkas sesuai catatan panitia.');
        }

        if ($status === 'ditolak') {
            return redirect()->route('santri_pendaftaran_view')->with('error', 'Maaf, pendaftaran Anda Ditolak. Hubungi panitia untuk informasi lebih lanjut.');
        }

        if ($status !== 'diterima') {
            return redirect()->route('santri_pendaftaran_view')->with('error', 'Status pendaftaran Anda tidak valid.');
        }

        // Ambil semua ujian sesuai jenjang pendidikan santri
        $ujians = Ujian::where('jenjang_pendidikan', $Santri->jenjang_pendidikan)
            ->with(['soals' => function ($query) {
                $query->where('status', 'dipilih');
            }])
            ->get();

        $now = Carbon::now('Asia/Jakarta'); // waktu real dengan jam

        foreach ($ujians as $ujian) {
            $mulai = Carbon::parse($ujian->tanggal_mulai, 'Asia/Jakarta');
            $selesai = Carbon::parse($ujian->tanggal_selesai, 'Asia/Jakarta');

            $jumlahSoal = $ujian->soals->count();
            $jumlahJawabanSantri = Jawaban::where('santri_id', $Santri->id)
                ->whereIn('soal_id', $ujian->soals->pluck('id'))
                ->count();

            // Cek apakah santri sudah mengerjakan semua soal
            $ujian->user_already_submit = ($jumlahJawabanSantri >= $jumlahSoal);

            // Perhitungan status berdasarkan waktu lengkap
            if ($now->lt($mulai)) {
                $ujian->ujian_status = 'belum_dimulai';
            } elseif ($now->gt($selesai)) {
                $ujian->ujian_status = 'waktu_habis';
            } else {
                $ujian->ujian_status = 'tersedia';
            }
        }

        return view('soals.list_soal', compact('ujians'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $ujians = Ujian::where('id', '=', $id)->get();
        return view('soals.create', compact('ujians', 'id'));
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'ujian_id' => 'required',
            'pertanyaan' => 'required',
            'jawaban_a' => 'required',
            'jawaban_b' => 'required',
            'jawaban_c' => 'required',
            'jawaban_d' => 'required',
            'jawaban_e' => 'required',
            'status' => 'required',
            'jawaban_benar' => 'required',
        ]);
        $soal = Soal::create($request->all());
        return redirect()->route('form_buat_soal', ['id' => $soal->ujian_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function show(Soal $soal)
    {
        return view('soals.show', compact('soal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function edit(Soal $soal)
    {
        return view('soals.edit', compact('soal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_data)
    {
        //
        $request->validate([
            'ujian_id' => 'required',
            'pertanyaan' => 'required',
            'jawaban_a' => 'required',
            'jawaban_b' => 'required',
            'jawaban_c' => 'required',
            'jawaban_d' => 'required',
            'jawaban_e' => 'required',
            'status' => 'required',
            'jawaban_benar' => 'required',

        ]);
        $soal = Soal::where('id', '=', $id_data)->first();
        $soal->update($request->all());
        $id = $soal->ujian_id;
        return redirect()->route('form_buat_soal', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($soal);
        $soal = Soal::where('ujian_id', '=', $id)->first();
        $soal->delete();
        return redirect()->route('form_buat_soal', ['id' => $soal->ujian_id]);
    }
}

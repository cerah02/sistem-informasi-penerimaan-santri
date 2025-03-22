<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Soal;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $data = $query_data->where('ujian_id', '=', $id)->orderBy('ujian_id', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
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
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('soals.index', compact('id'));
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
        $soals = Soal::where('ujian_id', '=', $id)->get();
        $ujian = ujian::where('id', '=', $id)->first();
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
        $soals = Soal::where('ujian_id', '=', $request->ujian_id)->get();
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

        // Redirect ke halaman hasil dengan data results
        return view('soals.hasil', compact('results'));
    }

    public function list_soal()
    {
        $Santri = auth()->user()->santri; // Ambil data santri dari user yang login

        if (!$Santri) {
            return redirect()->route('dashboard')->with('error', 'Data santri tidak ditemukan.');
        }

        // Ambil semua ujian sesuai jenjang pendidikan santri
        $ujians = Ujian::where('jenjang_pendidikan', $Santri->jenjang_pendidikan)
            ->with('soals') // Ambil soal untuk pengecekan jumlah
            ->get();

        // Ambil semua ujian yang sudah dikerjakan oleh santri
        foreach ($ujians as $ujian) {
            $jumlahSoal = $ujian->soals->count();
            $jumlahJawabanSantri = Jawaban::where('santri_id', $Santri->id)
                ->whereIn('soal_id', $ujian->soals->pluck('id'))
                ->count();

            // Jika semua soal telah dijawab, set ujian sebagai selesai
            $ujian->user_already_submit = ($jumlahJawabanSantri >= $jumlahSoal);
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

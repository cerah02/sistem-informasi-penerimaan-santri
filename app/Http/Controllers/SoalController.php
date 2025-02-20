<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Soal;
use App\Models\Ujian;
use Illuminate\Http\Request;
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

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query_data = new soal();

            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('ujian_id', 'like', $search_value);
                });
            }
            $data = $query_data->orderBy('ujian_id', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $btn = '';
                
                    
                    if (auth()->user()->can('ujian-show')) {
                        $btn .= '<a class="btn btn-info" href="' . route('ujians.show', $row->id) . '">Show</a> ';
                    }
                
                
                    if (auth()->user()->can('ujian-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('ujians.edit', $row->id) . '">Edit</a> ';
                    }
                
                    if (auth()->user()->can('ujian-delete')) {
                        $btn .= '
                        <form action="' . route('ujians.destroy', $row->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>';
                    }
                
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('soals.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $ujians = Ujian::all();
        return view('soals.create', compact('ujians'));
    }
    public function list_soal()
    {

        // Ambil ID user yang sedang login
        $id_user = 1;

        // Ambil semua soal yang sudah dikerjakan oleh user
        $soalDikerjakan = Jawaban::where('santri_id', $id_user)
            ->with('soal.ujian') // Eager load relasi soal dan ujian
            ->get();

        // Inisialisasi array untuk menyimpan ujian yang sudah dikerjakan
        $ujianDikerjakan = [];

        // Loop melalui soal yang sudah dikerjakan
        foreach ($soalDikerjakan as $jawaban) {
            $soal = $jawaban->soal;
            $ujian = $soal->ujian;

            // Simpan ujian_id ke dalam array
            $ujianDikerjakan[$ujian->id] = $ujian;
        }

        // Ambil semua ujian beserta jumlah soal
        $ujians = Ujian::withCount('soal')->get();

        // Loop melalui setiap ujian untuk mengecek apakah user sudah mengerjakan ujian tersebut
        foreach ($ujians as $ujian) {
            $ujian->user_already_submit = isset($ujianDikerjakan[$ujian->id]);
        }

        // dd($ujians);
        // Kirim data ke view
        return view('soals.list_soal', compact('ujians'));
    }

    public function ujian($id)
    {
        $soals = Soal::where('ujian_id', '=', $id)->get();
        $ujian = ujian::where('id', '=', $id)->first();
        return view('soals.ujian', compact('soals', 'ujian'));
    }

    public function submitUjian(Request $request)
    {
        // Ambil ID santri yang sedang login (contoh menggunakan Auth)
        $santri_id = 1; // Sesuaikan dengan cara Anda mengambil ID santri

        // Ambil jawaban user dari request
        $jawabanUser = $request->jawaban; // Array jawaban dari user

        // Ambil semua soal
        $soals = Soal::where('ujian_id', '=', $request->ujian_id)->get();
        $results = [];
        $state = "";

        // Loop melalui setiap soal
        foreach ($soals as $soal) {
            $jawabanBenar = $soal->jawaban_benar;
            $jawabanDipilih = $jawabanUser[$soal->id] ?? null;

            // Tentukan status jawaban
            $status_jawaban = ($jawabanDipilih === $jawabanBenar) ? 'Benar' : 'Salah';

            // Simpan jawaban ke tabel jawabans
            $state = Jawaban::create([
                'soal_id' => $soal->id,
                'santri_id' => $santri_id,
                'jawaban' => $jawabanDipilih ?? 'Tidak diisi', // Jika jawaban tidak dipilih, isi dengan 'Tidak diisi'
                'status_jawaban' => $status_jawaban,
            ]);

            // // Tambahkan hasil ke array results untuk ditampilkan di view
            // $results[] = [
            //     'soal_id' => $soal->id,
            //     'pertanyaan' => $soal->pertanyaan,
            //     'jawaban_benar' => $jawabanBenar,
            //     'jawaban_dipilih' => $jawabanDipilih,
            //     'status' => $status_jawaban,
            // ];
        }

        return redirect()->route('list_soal');

        // Redirect ke halaman hasil dengan data results
        // return view('soals.hasil', compact('results'));
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
            'ujian_id' => 'required',
            'pertanyaan' => 'required',
            'jawaban_a' => 'required',
            'jawaban_b' => 'required',
            'jawaban_c' => 'required',
            'jawaban_d' => 'required',
            'jawaban_e' => 'required',
            'jawaban_benar' => 'required',
        ]);
        Soal::create($request->all());
        return redirect()->route('soals.index')
            ->with('success', 'Data Soal Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function show(Soal $soal)
    {
        //
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
        //
        return view('soals.edit', compact('soal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Soal $soal)
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
        $soal->update($request->all());
        return redirect()->route('soals.index')
            ->with('success', 'Data Soal Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soal $soal)
    {
        //
        $soal->delete();
        return redirect()->route('soals.index')
            ->with('success', 'Data Soal Berhasil Dihapus');
    }
}

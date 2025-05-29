<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Jawaban;
use App\Models\Santri;
use App\Models\Total_Hasil;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:jawaban-list|jawaban-create|jawaban-edit|jawaban-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:jawaban-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:jawaban-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:jawaban-delete', ['only' => ['destroy']]);
    }
    public function index_old()
    {
        //
        $jawabans = Jawaban::latest()->paginate(5);
        return view('jawabans.index', compact('jawabans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    //     public function index(Request $request)
    //     {
    //         if ($request->ajax()) {
    //             $query_data = new Jawaban();

    //             if ($request->sSearch) {
    //                 $search_value = '%' . $request->sSearch . '%';
    //                 $query_data = $query_data->where(function ($query) use ($search_value) {
    //                     $query->where('santri_id', 'like', $search_value)
    //                         ->orwhere('soals', 'like', $search_value)
    //                         ->orwhere('status_jawaban', 'like', $search_value);
    //                 });
    //             }
    //             $data = $query_data->with(['santri', 'soal'])->orderBy('santri_id', 'asc')->get();
    //             return DataTables::of($data)
    //                 ->addIndexColumn()
    //                 ->addColumn('nama_santri', function ($row) {
    //                     return $row->santri->nama ?? '-'; // sesuaikan nama kolom
    //                 })
    //                 ->addColumn('pertanyaan', function ($row) {
    //                     return $row->soal->pertanyaan ?? '-'; // sesuaikan nama kolom
    //                 })
    //                 ->addColumn('aksi', function ($row) {
    //                     $btn = '';

    //                     // Cek permission 'view santri'
    //                     if (auth()->user()->can('jawaban-show')) {
    //                         $btn .= '<a class="btn btn-info" href="' . route('jawabans.show', $row->id) . '">Show</a> ';
    //                     }

    //                     // Cek permission 'edit jawaban'
    //                     if (auth()->user()->can('jawaban-edit')) {
    //                         $btn .= '<a class="btn btn-primary" href="' . route('jawabans.edit', $row->id) . '">Edit</a> ';
    //                     }

    //                     // Cek permission 'delete jawaban'
    //                     if (auth()->user()->can('jawaban-delete')) {
    //                         $btn .= '
    //                         <button type="button" class="btn btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
    //                         <form id="delete-form-' . $row->id . '" action="' . route('jawabans.destroy', $row->id) . '" method="POST" style="display: none;">
    //     ' . csrf_field() . method_field('DELETE') . '
    // </form>';
    //                     }

    //                     return $btn;
    //                 })
    //                 ->rawColumns(['aksi'])
    //                 ->make(true);
    //         }
    //         return view('jawabans.index');
    //     }

    public function index(Request $request)
    {
        $jenjangs = Santri::select('jenjang_pendidikan')->distinct()->pluck('jenjang_pendidikan');
        $ujians = Ujian::all();

        $query = Hasil::with(['santri', 'ujian']);

        if ($request->jenjang) {
            $query->whereHas('santri', function ($q) use ($request) {
                $q->where('jenjang_pendidikan', $request->jenjang);
            });
        }

        if ($request->ujian_id) {
            $query->where('ujian_id', $request->ujian_id);
        }

        $hasils = $query->get();

        return view('jawabans.index', compact('hasils', 'jenjangs', 'ujians'));
    }


    public function detail(Request $request)
    {
        $santri_id = $request->query('santri_id');
        $ujian_id = $request->query('ujian_id');

        $jawabans = Jawaban::with('soal.ujian')
            ->where('santri_id', $santri_id)
            ->whereHas('soal', function ($query) use ($ujian_id) {
                $query->where('ujian_id', $ujian_id);
            })
            ->get();

        return view('jawabans.partial_detail', compact('jawabans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jawabans.create');
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
            'soal_id' => 'required',
            'jawaban' => 'required',
            'status_jawaban' => 'required',
        ]);
        Jawaban::create($request->all());
        return redirect()->route('jawabans.index')
            ->with('success', 'Data Jawaban Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function show(Jawaban $jawaban)
    {
        //
        return view('jawabans.show', compact('jawaban'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */

    public function edit(Jawaban $jawaban)
    {
        return view('jawabans.edit', compact('jawaban'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jawaban $jawaban)
    {
        //
        $request->validate([
            'santri_id' => 'required',
            'soal_id' => 'required',
            'jawaban' => 'required',
            'status_jawaban' => 'required',
        ]);
        $jawaban->update($request->all());
        return redirect()->route('jawabans.index')
            ->with('success', 'Data Jawaban Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jawaban $jawaban)
    {
        $santriId = $jawaban->santri_id;
        $ujianId = $jawaban->soal->ujian_id;

        // 1. Hapus semua jawaban santri tersebut untuk ujian ini
        Jawaban::where('santri_id', $santriId)
            ->whereHas('soal', function ($query) use ($ujianId) {
                $query->where('ujian_id', $ujianId);
            })
            ->delete();

        // 2. Hapus hasil ujian santri tersebut untuk ujian ini
        Hasil::where('santri_id', $santriId)
            ->where('ujian_id', $ujianId)
            ->delete();

        // 3. Hapus total hasil santri (jika kamu ingin hapus semuanya)
        Total_Hasil::where('santri_id', $santriId)->delete();

        return redirect()->route('jawabans.index')
            ->with('success', 'Semua jawaban, hasil ujian, dan total hasil santri berhasil dihapus.');
    }

    public function hapusDariTabelHasil(Request $request)
    {
        $santriId = $request->santri_id;
        $ujianId = $request->ujian_id;

        // Hapus semua jawaban santri untuk ujian ini
        Jawaban::where('santri_id', $santriId)
            ->whereHas('soal', function ($query) use ($ujianId) {
                $query->where('ujian_id', $ujianId);
            })->delete();

        // Hapus hasil ujian
        Hasil::where('santri_id', $santriId)
            ->where('ujian_id', $ujianId)->delete();

        // Hapus total hasil
        Total_Hasil::where('santri_id', $santriId)->delete();

        return redirect()->route('hasils.index')->with('success', 'Data jawaban, hasil, dan total berhasil dihapus.');
    }
}

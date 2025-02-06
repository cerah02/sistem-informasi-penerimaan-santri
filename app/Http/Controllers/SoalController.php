<?php

namespace App\Http\Controllers;

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
                    $btn = '
                <form action="' . route('soals.destroy', $row->id) . '" method="POST">
                <a class="btn btn-info" href="' . route('soals.show', $row->id) . '">Show</a>
                <a class="btn btn-primary" href="' . route('soals.edit', $row->id) . '">Edit</a>
                ' . csrf_field() . method_field('DELETE') . '
                <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                ';
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

    public function ujian()
    {
        $soals = Soal::all();
        return view('soals.ujian', compact('soals'));
    }

    public function submitUjian(Request $request)
    {
        $jawabanUser = $request->jawaban; // Array jawaban dari user
        $soals = Soal::all();
        $results = [];

        foreach ($soals as $soal) {
            $jawabanBenar = $soal->jawaban_benar;
            $jawabanDipilih = $jawabanUser[$soal->id] ?? null;

            $results[] = [
                'soal_id' => $soal->id,
                'pertanyaan' => $soal->pertanyaan,
                'jawaban_benar' => $jawabanBenar,
                'jawaban_dipilih' => $jawabanDipilih,
                'status' => $jawabanDipilih === $jawabanBenar ? 'Benar' : 'Salah'
            ];
        }

        return view('soals.hasil', compact('results'));
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

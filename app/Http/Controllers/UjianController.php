<?php

namespace App\Http\Controllers;
use App\Models\Soal;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:ujian-list|ujian-create|ujian-edit|ujian-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:ujian-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:ujian-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:ujian-delete', ['only' => ['destroy']]);
    }
    public function index_old()
    {
        //
        $ujians = ujian::latest()->paginate(5);
        return view('ujians.index', compact('ujians'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function index_buat_soal($jenjang)
    {
        $ujians = Ujian::where('jenjang_pendidikan', strtoupper($jenjang))->get();
        // dd($ujians);

        return view('ujians.buat_soal', compact('ujians', 'jenjang'));
    }

    public function index(Request $request)
    {

        $jenjang = [
            "SD",
            "MTS",
            "MA"
        ];

        return view('ujians.index', compact('jenjang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($jenjang)
    {
        return view('ujians.create', compact('jenjang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_ujian' => 'required',
            'kategori' => 'required',
            'jenjang_pendidikan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'durasi' => 'required|numeric',
            'status' => 'required',
        ]);

        // Simpan data ujian
        $input = $request->all();
        $input['durasi'] = $request->durasi * 60; // Konversi durasi ke detik
        $ujian = Ujian::create($input);

        // Ambil jenjang pendidikan untuk redirect
        $jenjang = strtolower($ujian->jenjang_pendidikan);

        return redirect()->route('ujians.sd', ['jenjang' => $jenjang])
            ->with('success', 'Data Ujian Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ujian  $ujian
     * @return \Illuminate\Http\Response
     */
    public function show(Ujian $ujian)
    {
        //
        return view('ujians.show', compact('ujian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ujian  $ujian
     * @return \Illuminate\Http\Response
     */
    public function edit(Ujian $ujian)
    {

        return view('ujians.edit', compact('ujian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ujian  $ujian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ujian $ujian)
    {
        // Validasi input
        $request->validate([
            'nama_ujian' => 'required',
            'kategori' => 'required',
            'jenjang_pendidikan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'durasi' => 'required|numeric',
            'status' => 'required',
        ]);

        // Update data ujian
        $input = $request->all();
        $input['durasi'] = $request->durasi * 60; // Konversi durasi ke detik
        $ujian->update($input);

        // Ambil jenjang pendidikan untuk redirect
        $jenjang = strtolower($ujian->jenjang_pendidikan);

        return redirect()->route('ujians.sd', ['jenjang' => $jenjang])
            ->with('success', 'Data Ujian Berhasil Diupdate');
    }


    public function form_buat_soal($id)
    {
        $ujian = Ujian::where('id', '=', $id)->first();
        return view('soals.index', compact('ujian', 'id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ujian  $ujian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ujian = Ujian::where('id', '=', $id)->first();

        if ($ujian) {
            $jenjang = strtolower($ujian->jenjang_pendidikan); // Ambil jenjang pendidikan dari data ujian
            $ujian->delete();

            return redirect()->route('ujians.sd', ['jenjang' => $jenjang])
                ->with('success', 'Data Ujian Berhasil Dihapus');
        }

        return redirect()->back()->with('error', 'Ujian tidak ditemukan');
    }
}

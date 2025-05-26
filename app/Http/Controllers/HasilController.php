<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class HasilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:hasil-list|hasil-create|hasil-edit|hasil-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:hasil-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:hasil-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:hasil-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query_data = new Hasil();

            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('santri_id', 'like', $search_value)
                        ->orwhere('ujian_id', 'like', $search_value)
                        ->orwhere('hasil_akhir', 'like', $search_value);
                });
            }
            $data = $query_data->with(['santri', 'ujian'])->orderBy('santri_id', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_santri', function ($row) {
                    return $row->santri->nama ?? '-'; // sesuaikan nama kolom
                })
                ->addColumn('nama_ujian', function ($row) {
                    return $row->ujian->nama_ujian ?? '-';
                })
                ->addColumn('aksi', function ($row) {
                    $btn = '';


                    // if (auth()->user()->can('hasil-show')) {
                    //     $btn .= '<a class="btn btn-info" href="' . route('hasils.show', $row->id) . '">Show</a> ';
                    // }


                    if (auth()->user()->can('hasil-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('hasils.edit', $row->id) . '">Edit</a> ';
                    }
                    if (auth()->user()->can('jawaban-delete')) {
                        $btn .= '
        <button type="button" class="btn btn-danger btn-delete" data-santri="' . $row->santri_id . '" data-ujian="' . $row->ujian_id . '">Hapus</button>
        <form id="delete-form-' . $row->santri_id . '-' . $row->ujian_id . '" action="' . route('hapus.jawaban.dari.hasil') . '" method="POST" style="display: none;">
            ' . csrf_field() . '
            <input type="hidden" name="santri_id" value="' . $row->santri_id . '">
            <input type="hidden" name="ujian_id" value="' . $row->ujian_id . '">
        </form>';
                    }

                    // if (auth()->user()->can('hasil-delete')) {
                    //     $btn .= '
                    // <form action="' . route('hasils.destroy', $row->id) . '" method="POST" style="display:inline;">
                    //     ' . csrf_field() . method_field('DELETE') . '
                    //     <button type="submit" class="btn btn-danger">Hapus</button>
                    // </form>';
                    // }

                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('hasils.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    //     return view('ortus.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    //     $request->validate([
    //         'santri_id' => 'required',
    //         'nama_ayah' => 'required',
    //         'pendidikan_ayah'=>'required',
    //         'pekerjaan_ayah'=>'required',
    //         'nama_ibu'=>'required',
    //         'pendidikan_ibu' => 'required',
    //         'pekerjaan_ibu'=>'required',
    //         'no_hp'=>'required',
    //         'alamat'=>'required',
    //         ]);
    //         Ortu::create($request->all());
    //         return redirect()->route('ortus.index')
    //         ->with('success','Data Orang Tua Berhasil Disimpan.');
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    // public function show(Ortu $ortu)
    // {
    //     //
    //     return view('ortus.show',compact('ortu'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Ortu  $ortu
    //  * @return \Illuminate\Http\Response
    //  */
    public function edit(Hasil $hasil)
    {
        // Pastikan eager loading relasi
        $hasil->load(['santri', 'ujian']);
        return view('hasils.edit', compact('hasil'));
    }


    public function update(Request $request, Hasil $hasil)
    {
        $request->validate([
            'santri_id' => 'required',
            'ujian_id' => 'required',
            'jumlah_soal' => 'required',
            'jawaban_benar' => 'required',
            'jawaban_salah' => 'required',
            'total_nilai_kategori' => 'required',
            'keterangan' => 'required',
        ]);

        $hasil->update($request->only([
            'santri_id',
            'ujian_id',
            'jumlah_soal',
            'jawaban_benar',
            'jawaban_salah',
            'total_nilai_kategori',
            'keterangan'
        ]));

        // ===== Tambahan: Update total_hasils jika semua ujian selesai =====
        $santri_id = $request->santri_id;

        // Cari jenjang santri
        $jenjang = $hasil->santri->jenjang_pendidikan;

        // Hitung total ujian sesuai jenjang
        $totalUjianJenjang = DB::table('ujians')
            ->where('jenjang_pendidikan', $jenjang)
            ->count();

        // Hitung jumlah hasil ujian yang sudah dikerjakan oleh santri (distinct ujian_id)
        $jumlahHasil = DB::table('hasils')
            ->where('santri_id', $santri_id)
            ->distinct('ujian_id')
            ->count('ujian_id');

        // Jika santri sudah menyelesaikan semua ujian
        if ($jumlahHasil == $totalUjianJenjang) {
            $rataRata = DB::table('hasils')
                ->where('santri_id', $santri_id)
                ->avg('total_nilai_kategori');

            $statusKelulusan = $rataRata >= 75 ? 'Lulus' : 'Tidak Lulus';

            DB::table('total_hasils')->updateOrInsert(
                ['santri_id' => $santri_id],
                [
                    'rata_rata' => $rataRata,
                    'status' => $statusKelulusan,
                    'updated_at' => now(), // optional
                ]
            );
        }

        return redirect()->route('hasils.index')
            ->with('success', 'Data Hasil Ujian Santri Berhasil Diupdate');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Ortu  $ortu
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Ortu $ortu)
    // {
    //     //
    //     $ortu->delete();
    //     return redirect()->route('ortus.index')
    //     ->with('success','Data Orang Tua Berhasil Dihapus');
    // }
}

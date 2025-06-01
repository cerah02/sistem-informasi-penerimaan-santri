<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Santri;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:dokumen-list|dokumen-create|dokumen-edit|dokumen-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:dokumen-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:dokumen-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:dokumen-delete', ['only' => ['destroy']]);
    }
    public function index_old()
    {
        //
        $dokumens = dokumen::latest()->paginate(5);
        return view('dokumens.index', compact('dokumens'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Dokumen::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';

                    // Tombol "Lihat"
                    if (auth()->user()->can('dokumen-show')) {
                        $btn .= '<a href="' . route('dokumens.show', $row->id) . '" class="btn btn-info btn-sm mx-1"><i class="bi bi-eye"></i> Lihat</a>';
                    }

                    // Tombol "Edit"
                    if (auth()->user()->can('dokumen-edit')) {
                        $btn .= '<a href="' . route('dokumens.edit', $row->id) . '" class="btn btn-primary btn-sm mx-1"><i class="bi bi-pencil"></i> Edit</a>';
                    }

                    // Tombol "Hapus"
                    if (auth()->user()->can('dokumen-delete')) {
                        $btn .= '<button type="button" class="btn btn-danger btn-sm mx-1" data-toggle="modal" data-target="#deleteModal" data-id="' . $row->id . '" data-nama="' . $row->nama . '"><i class="bi bi-trash"></i> Hapus</button>';
                    }

                    return $btn;
                })->addColumn('santri_nama', function ($row) {
                    return $row->santri->nama ?? 'N\A';
                })->addColumn('foto', function ($row) {
                    $path = asset('storage/' . $row->foto);
                    $extension = pathinfo($row->foto, PATHINFO_EXTENSION);

                    if (in_array(strtolower($extension), ['pdf', 'docx'])) {
                        return '
                            <div class="btn-group">
                                <a href="' . $path . '" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                <a href="' . $path . '" download class="btn btn-sm btn-success">Unduh</a>
                            </div>';
                    } else {
                        return '<img src="' . $path . '" width="50" />';
                    }
                })->addColumn('ijazah', function ($row) {
                    $path = asset('storage/' . $row->ijazah);
                    $extension = pathinfo($row->ijazah, PATHINFO_EXTENSION);

                    if (in_array(strtolower($extension), ['pdf', 'docx'])) {
                        return '
                            <div class="btn-group">
                                <a href="' . $path . '" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                <a href="' . $path . '" download class="btn btn-sm btn-success">Unduh</a>
                            </div>';
                    } else {
                        return '<img src="' . $path . '" width="50" />';
                    }
                })->addColumn('akta_kelahiran', function ($row) {
                    $path = asset('storage/' . $row->akta_kelahiran);
                    $extension = pathinfo($row->akta_kelahiran, PATHINFO_EXTENSION);

                    if (in_array(strtolower($extension), ['pdf', 'docx'])) {
                        return '
                            <div class="btn-group">
                                <a href="' . $path . '" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                <a href="' . $path . '" download class="btn btn-sm btn-success">Unduh</a>
                            </div>';
                    } else {
                        return '<img src="' . $path . '" width="50" />';
                    }
                })->addColumn('nilai_raport', function ($row) {
                    $path = asset('storage/' . $row->nilai_raport);
                    $extension = pathinfo($row->nilai_raport, PATHINFO_EXTENSION);

                    if (in_array(strtolower($extension), ['pdf', 'docx'])) {
                        return '
                            <div class="btn-group">
                                <a href="' . $path . '" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                <a href="' . $path . '" download class="btn btn-sm btn-success">Unduh</a>
                            </div>';
                    } else {
                        return '<img src="' . $path . '" width="50" />';
                    }
                })->addColumn('kk', function ($row) {
                    $path = asset('storage/' . $row->kk);
                    $extension = pathinfo($row->kk, PATHINFO_EXTENSION);

                    if (in_array(strtolower($extension), ['pdf', 'docx'])) {
                        return '
                            <div class="btn-group">
                                <a href="' . $path . '" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                <a href="' . $path . '" download class="btn btn-sm btn-success">Unduh</a>
                            </div>';
                    } else {
                        return '<img src="' . $path . '" width="50" />';
                    }
                })->addColumn('ktp_ayah', function ($row) {
                    $path = asset('storage/' . $row->ktp_ayah);
                    $extension = pathinfo($row->ktp_ayah, PATHINFO_EXTENSION);

                    if (in_array(strtolower($extension), ['pdf', 'docx'])) {
                        return '
                            <div class="btn-group">
                                <a href="' . $path . '" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                <a href="' . $path . '" download class="btn btn-sm btn-success">Unduh</a>
                            </div>';
                    } else {
                        return '<img src="' . $path . '" width="50" />';
                    }
                })->addColumn('ktp_ibu', function ($row) {
                    $path = asset('storage/' . $row->ktp_ibu);
                    $extension = pathinfo($row->ktp_ibu, PATHINFO_EXTENSION);

                    if (in_array(strtolower($extension), ['pdf', 'docx'])) {
                        return '
                            <div class="btn-group">
                                <a href="' . $path . '" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                <a href="' . $path . '" download class="btn btn-sm btn-success">Unduh</a>
                            </div>';
                    } else {
                        return '<img src="' . $path . '" width="50" />';
                    }
                })->addColumn('skhun', function ($row) {
                    $path = asset('storage/' . $row->skhun);
                    $extension = pathinfo($row->skhun, PATHINFO_EXTENSION);

                    if (in_array(strtolower($extension), ['pdf', 'docx'])) {
                        return '
                            <div class="btn-group">
                                <a href="' . $path . '" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                <a href="' . $path . '" download class="btn btn-sm btn-success">Unduh</a>
                            </div>';
                    } else {
                        return '<img src="' . $path . '" width="50" />';
                    }
                })
                ->rawColumns(['foto', 'ijazah', 'akta_kelahiran', 'nilai_raport', 'kk', 'ktp_ayah', 'ktp_ibu', 'skhun', 'action'])
                ->make(true);
        }

        return view('dokumens.index'); // Tidak perlu mengirim $dokumens
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $santris = Santri::doesntHave('dokumen')->get();
        return view('dokumens.create', compact('santris'));
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
            'santri_id' => 'required',
            'ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
            'akta_kelahiran' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
            'nilai_raport' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
            'skhun' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
            'foto' => 'required|file|mimes:jpg,jpeg,png,docx|max:5120',
            'kk' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
            'ktp_ayah' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
            'ktp_ibu' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
        ]);

        // Inisialisasi array untuk menyimpan data file
        $data = [
            'santri_id' => $request->santri_id,
        ];

        // Daftar kolom file yang perlu diproses
        $fileColumns = ['ijazah', 'nilai_raport', 'akta_kelahiran', 'skhun', 'foto', 'kk', 'ktp_ayah', 'ktp_ibu'];

        // Proses setiap file
        foreach ($fileColumns as $column) {
            if ($request->hasFile($column)) {
                $file = $request->file($column);
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Menggunakan storage
                $path = $file->storeAs("uploads/{$column}", $fileName, 'public');
                $data[$column] = $path;
            }
        }

        // Simpan data ke database
        Dokumen::create($data);

        // Redirect dengan pesan sukses
        return redirect()->route('dokumens.index')
            ->with('success', 'Dokumen Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function show(Dokumen $dokumen)
    {
        //
        return view('dokumens.show', compact('dokumen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokumen $dokumen)
    {
        //
        return view('dokumens.edit', compact('dokumen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokumen $dokumen)
    {
        $request->validate([
            'santri_id' => 'required',
            'ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
            'akta_kelahiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
            'nilai_raport' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
            'skhun' => 'nullable|file|mimes:pdf,jpg,jpeg,png,,docx|max:5120',
            'foto' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
            'kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
            'ktp_ayah' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
            'ktp_ibu' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
        ]);

        $data = [
            'santri_id' => $request->santri_id,
        ];

        foreach (['ijazah', 'akta_kelahiran', 'nilai_raport', 'skhun', 'foto', 'kk', 'ktp_ayah', 'ktp_ibu'] as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('dokumen', 'public');
                $data[$field] = $path;
            }
        }

        $dokumen->update($data);

        return redirect()->route('dokumens.index') // pastikan ini bukan typo: 'dokumenss'
            ->with('success', 'Dokumen Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokumen $dokumen)
    {
        //
        $dokumen->delete();
        return redirect()->route('dokumens.index')
            ->with('success', 'Dokumen Berhasil Dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:guru-list|guru-create|guru-edit|guru-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:guru-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:guru-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:guru-delete', ['only' => ['destroy']]);
    }
    public function index_old()
    {
        //
        $gurus = guru::latest()->paginate(5);
        return view('gurus.index', compact('gurus'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query_data = new Guru();
            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('nama', 'like', $search_value)
                        ->orwhere('nip', 'like', $search_value);
                });
            }
            $data = $query_data->orderBy('nama', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $btn = '';

                    // Cek permission 'view santri'
                    if (auth()->user()->can('guru-show')) {
                        $btn .= '<a class="btn btn-info" href="' . route('gurus.show', $row->id) . '">Show</a> ';
                    }

                    // Cek permission 'edit guru'
                    if (auth()->user()->can('guru-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('gurus.edit', $row->id) . '">Edit</a> ';
                    }

                    // Cek permission 'delete guru'
                    if (auth()->user()->can('guru-delete')) {
                        $btn .= '
                    <form action="' . route('gurus.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>';
                    }

                    return $btn;
                })
                ->rawColumns(['aksi', 'foto'])
                ->make(true);
        }
        return view('gurus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('gurus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        //
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'email' => 'required',
            'foto' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'status_guru' => 'required',
        ]);
        $input = $request->all();
        $input['ttl'] = $request->tempat_lahir . ' ' . $request->tanggal_lahir;
        if ($request->hasFile('foto')) {
            // Construct the file name with the correct extension
            $fileName = time() . '_' . $request->nama . '.' . $request->file('foto')->getClientOriginalExtension();

            // Move the uploaded file to the desired location
            $fotoPath = $request->file('foto')->move(public_path('uploads/guru/foto'), $fileName);

            // Save the file path to the $data array
            $input['foto'] = 'uploads/guru/foto/' . $fileName;
        }

        $status = Guru::create($input);
        return redirect()->route('gurus.index')
            ->with('success', 'Data Guru Berhasil Disimpan.');
    }

    public function tampilanGuru()
    {
        $gurus = Guru::all(); // Mengambil semua data guru dari database
        return view('tampilan_guru', compact('gurus')); // Mengirimkan data ke view 'gurus.tampilan_guru'
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(Guru $guru)
    {
        //
        return view('gurus.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        //
        return view('gurus.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guru $guru)
    {
        //
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jenis_kelamin' => 'required',
            'ttl' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'email' => 'required',
            'foto' => 'required',
            'status_guru' => 'required',
        ]);

        $guru->update($request->all());
        return redirect()->route('gurus.index')
            ->with('success', 'Data Guru Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {
        //
        $guru->delete();
        return redirect()->route('gurus.index')
            ->with('success', 'Data Guru Berhasil Dihapus');
    }
}

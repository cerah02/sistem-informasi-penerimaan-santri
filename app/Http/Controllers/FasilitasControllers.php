<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class FasilitasControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:fasilitas-list|fasilitas-create|fasilitas-edit|fasilitas-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:fasilitas-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:fasilitas-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:fasilitas-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query_data = new Fasilitas();
            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('nama_fasilitas', 'like', $search_value)
                        ->orwhere('foto_fasilitas', 'like', $search_value);
                });
            }
            $data = $query_data->orderBy('nama_fasilitas', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $btn = '';


                    if (auth()->user()->can('fasilitas-show')) {
                        $btn .= '<a class="btn btn-info" href="' . route('fasilitas.show', $row->id) . '">Show</a> ';
                    }

                    // Cek permission 'edit fasilitas'
                    if (auth()->user()->can('fasilitas-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('fasilitas.edit', $row->id) . '">Edit</a> ';
                    }

                    // Cek permission 'delete fasilitas'
                    if (auth()->user()->can('fasilitas-delete')) {
                        $btn .= '
                        <form action="' . route('fasilitas.destroy', $row->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>';
                    }

                    return $btn;
                })
                ->rawColumns(['aksi', 'foto_fasilitas'])
                ->make(true);
        }
        return view('fasilitas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fasilitas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required',
            'foto_fasilitas' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
        ]);

        $input = $request->except('foto_fasilitas'); // Hindari duplikasi input

        if ($request->hasFile('foto_fasilitas')) {
            // Pastikan nama file aman dengan Str::slug()
            $fileName = time() . '_' . Str::slug($request->nama_fasilitas) . '.' . $request->file('foto_fasilitas')->getClientOriginalExtension();

            // Simpan file ke dalam storage (bukan public_path untuk keamanan)
            $fotoPath = $request->file('foto_fasilitas')->storeAs('public/uploads/fasilitas', $fileName);

            // Simpan path ke database (tanpa "public/")
            $input['foto'] = 'uploads/fasilitas/' . $fileName;
        }

        // Simpan ke database
        Fasilitas::create($input);

        return redirect()->route('fasilitas.index')
            ->with('success', 'Data Fasilitas Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
    public function show(Fasilitas $fasilitas)
    {
        return view('fasilitas.show', compact('fasilitas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
    public function edit(Fasilitas $fasilitas)
    {
        return view('fasilitas.edit', compact('fasilitas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fasilitas $fasilitas)
    {
        $request->validate([
            'nama_fasilitas' => 'required',
            'foto_fasilitas' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
        ]);
        $fasilitas->update($request->all());
        return redirect()->route('fasilitas.index')
            ->with('success', 'Data Fasilitas Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->delete();
        return redirect()->route('fasilitas.index')
            ->with('success', 'Data Fasilitas Berhasil Dihapus');
    }
}

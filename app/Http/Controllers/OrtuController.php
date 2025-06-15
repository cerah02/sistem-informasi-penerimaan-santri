<?php

namespace App\Http\Controllers;

use App\Models\Ortu;
use App\Models\Santri;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrtuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:ortu-list|ortu-create|ortu-edit|ortu-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:ortu-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:ortu-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:ortu-delete', ['only' => ['destroy']]);
    }
    public function index_old()
    {
        //
        $ortus = Ortu::latest()->paginate(5);
        return view('ortus.index', compact('ortus'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query_data = Ortu::with('santri'); // memuat relasi dengan santri

            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('santri_id', 'like', $search_value)
                        ->orWhere('nama_ayah', 'like', $search_value)
                        ->orWhere('nama_ibu', 'like', $search_value);
                });
            }

            $data = $query_data->orderBy('santri_id', 'asc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_santri', function ($row) {
                    return $row->santri->nama ?? '-'; // sesuaikan nama kolom
                })
                ->addColumn('aksi', function ($row) {
                    $btn = '';

                    if (auth()->user()->can('ortu-show')) {
                        $btn .= '<a class="btn btn-info" href="' . route('ortus.show', $row->id) . '">Show</a> ';
                    }

                    if (auth()->user()->can('ortu-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('ortus.edit', $row->id) . '">Edit</a> ';
                    }

                    if (auth()->user()->can('ortu-delete')) {
                        $btn .= '
                        <form action="' . route('ortus.destroy', $row->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>';
                    }

                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('ortus.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $santris = Santri::doesntHave('ortu')->get();
        return view('ortus.create', compact('santris'));
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
            'nama_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'nama_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'no_hp' => 'required',
            'alamat_ortu' => 'required',
        ]);
        Ortu::create($request->all());
        return redirect()->route('ortus.index')
            ->with('success', 'Data Orang Tua Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function show(Ortu $ortu)
    {
        //
        return view('ortus.show', compact('ortu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function edit(Ortu $ortu)
    {
        //
        return view('ortus.edit', compact('ortu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ortu $ortu)
    {
        //
        $request->validate([
            'santri_id' => 'required',
            'nama_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'nama_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'no_hp' => 'required',
            'alamat_ortu' => 'required',
        ]);

        $ortu->update($request->all());
        return redirect()->route('ortus.index')
            ->with('success', 'Data Orang Tua Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ortu $ortu)
    {
        //
        $ortu->delete();
        return redirect()->route('ortus.index')
            ->with('success', 'Data Orang Tua Berhasil Dihapus');
    }
}

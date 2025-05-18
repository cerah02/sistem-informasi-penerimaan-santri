<?php

namespace App\Http\Controllers;

use App\Models\Kesehatan;
use App\Models\Santri;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:kesehatan-list|kesehatan-create|kesehatan-edit|kesehatan-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:kesehatan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kesehatan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kesehatan-delete', ['only' => ['destroy']]);
    }
    public function index_old()
    {
        //
        $kesehatans = Kesehatan::latest()->paginate(5);
        return view('kesehatans.index', compact('kesehatans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function index(Request $request)
    {
        if ($request->ajax()){
            $query_data = Kesehatan::with('santri');

            if($request->sSearch){
                $search_value ='%'.$request->sSearch.'%';
                $query_data=$query_data->where(function($query)use ($search_value) {
                    $query->where('santri_id','like', $search_value);
                });
            }
            $data = $query_data->orderBy('santri_id','asc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_santri', function ($row) {
                return $row->santri->nama ?? '-'; // sesuaikan nama kolom
            })
            ->addColumn('aksi', function ($row) {
                $btn = '';
            
                
                if (auth()->user()->can('kesehatan-show')) {
                    $btn .= '<a class="btn btn-info" href="' . route('kesehatans.show', $row->id) . '">Show</a> ';
                }
            
            
                if (auth()->user()->can('kesehatan-edit')) {
                    $btn .= '<a class="btn btn-primary" href="' . route('kesehatans.edit', $row->id) . '">Edit</a> ';
                }
            
                if (auth()->user()->can('kesehatan-delete')) {
                    $btn .= '
                    <form action="' . route('kesehatans.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>';
                }
            
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('kesehatans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $santris = Santri::doesntHave('kesehatan')->get();
        return view('kesehatans.create', compact('santris'));
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
            'golongan_darah' => 'required',
            'tb'=>'required',
            'bb'=>'required',
            'riwayat_penyakit'=>'required',
            ]);
            Kesehatan::create($request->all());
            return redirect()->route('kesehatans.index')
            ->with('success','Data Kesehatan Santri Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kesehatan  $kesehatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kesehatan $kesehatan)
    {
        //
        return view('kesehatans.show',compact('kesehatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kesehatan  $kesehatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kesehatan $kesehatan)
    {
        //
        return view('kesehatans.edit',compact('kesehatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kesehatan  $kesehatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kesehatan $kesehatan)
    {
        //
        $request->validate([
            'santri_id' => 'required',
            'golongan_darah' => 'required',
            'tb'=>'required',
            'bb'=>'required',
            'riwayat_penyakit'=>'required',
            ]);

            $kesehatan->update($request->all());
            return redirect()->route('kesehatans.index')
            ->with('success','Data Kesehatan Santri Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kesehatan  $kesehatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kesehatan $kesehatan)
    {
        //
        $kesehatan->delete();
        return redirect()->route('kesehatans.index')
        ->with('success','Data Kesehatan Santri Berhasil Dihapus');
    }
}

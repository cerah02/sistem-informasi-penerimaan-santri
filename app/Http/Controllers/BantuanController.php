<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Models\Santri;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BantuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:bantuan-list|bantuan-create|bantuan-edit|bantuan-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:bantuan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:bantuan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:bantuan-delete', ['only' => ['destroy']]);
    }
    public function index_old()
    {
        //
        $bantuans = bantuan::latest()->paginate(5);
        return view('bantuans.index', compact('bantuans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function index(Request $request)
    {
        if ($request->ajax()){
            $query_data = Bantuan::with('santri');

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
            
                
                if (auth()->user()->can('bantuan-show')) {
                    $btn .= '<a class="btn btn-info" href="' . route('bantuans.show', $row->id) . '">Show</a> ';
                }
            
            
                if (auth()->user()->can('bantuan-edit')) {
                    $btn .= '<a class="btn btn-primary" href="' . route('bantuans.edit', $row->id) . '">Edit</a> ';
                }
            
                if (auth()->user()->can('bantuan-delete')) {
                    $btn .= '
                    <form action="' . route('bantuans.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>';
                }
            
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('bantuans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $santris = Santri::all();
        return view('bantuans.create', compact('santris'));
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
            'nama_bantuan' => 'required',
            'tingkat' =>'required',
            'no_kip' => 'required',
            ]);
            Bantuan::create($request->all());
            return redirect()->route('bantuans.index')
            ->with('success','Data Riwayat Bantuan Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bantuan  $bantuan
     * @return \Illuminate\Http\Response
     */
    public function show(Bantuan $bantuan)
    {
        //
        return view('bantuans.show',compact('bantuan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bantuan  $bantuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Bantuan $bantuan)
    {
        //
        return view('bantuans.edit',compact('bantuan'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bantuan  $bantuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bantuan $bantuan)
    {
        //
        $request->validate([
            'santri_id' => 'required',
            'nama_bantuan' => 'required',
            'tingkat' => 'required',
            'no_kip'=> 'required',
            ]);
            Bantuan::create($request->all());
            return redirect()->route('bantuans.index')
            ->with('success','Data Riwayat Bantuan Berhasil Disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bantuan  $bantuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bantuan $bantuan)
    {
        //
        $bantuan->delete();
        return redirect()->route('bantuans.index')
        ->with('success','Data Riwayat Bantuan Berhasil Dihapus');
    }
}

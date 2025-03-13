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

        return view('ujians.buat_soal', compact('ujians','jenjang'));
    }

    // public function indexMTS()
    // {
    //     $ujians = Ujian::where('jenjang', 'MTS')->get();
    //     return view('ujians.index', compact('ujians'));
    // }

    // public function indexMA()
    // {
    //     $ujians = Ujian::where('jenjang', 'MA')->get();
    //     return view('ujians.index', compact('ujians'));
    // }

    public function index(Request $request)
    {
        // if ($request->ajax()){
        //     $query_data = new ujian();

        //     if($request->sSearch){
        //         $search_value ='%'.$request->sSearch.'%';
        //         $query_data=$query_data->where(function($query)use ($search_value) {
        //             $query->where('nama_ujian','like', $search_value)
        //             ->orwhere('kategori','like', $search_value)
        //             ->orwhere('jenjang_pendidikan','like', $search_value);
        //         });
        //     }
        //     $data = $query_data->orderBy('nama_ujian','asc')->get();
        //     return DataTables::of($data)
        //     ->addIndexColumn()
        //     ->addColumn('aksi', function ($row) {
        //         $btn = '';


        //         if (auth()->user()->can('ujian-show')) {
        //             $btn .= '<a class="btn btn-info" href="' . route('ujians.show', $row->id) . '">Show</a> ';
        //         }


        //         if (auth()->user()->can('ujian-edit')) {
        //             $btn .= '<a class="btn btn-primary" href="' . route('ujians.edit', $row->id) . '">Edit</a> ';
        //         }

        //         if (auth()->user()->can('ujian-delete')) {
        //             $btn .= '
        //             <form action="' . route('ujians.destroy', $row->id) . '" method="POST" style="display:inline;">
        //                 ' . csrf_field() . method_field('DELETE') . '
        //                 <button type="submit" class="btn btn-danger">Hapus</button>
        //             </form>';
        //         }

        //         return $btn;
        //     })
        //     ->rawColumns(['aksi'])
        //     ->make(true);
        // }

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
        
        return view('ujians.create',compact('jenjang'));
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
            'nama_ujian' => 'required',
            'kategori' => 'required',
            'jenjang_pendidikan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'durasi' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        $input['durasi'] = $request->durasi * 60;
        Ujian::create($input);
        return redirect()->route('ujians.index')
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
        //
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
        //
        $request->validate([
            'nama_ujian' => 'required',
            'kategori' => 'required',
            'jenjang_pendidikan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'durasi' => 'required',
            'status' => 'required',
        ]);

        $ujian->update($request->all());
        return redirect()->route('ujians.index')
            ->with('success', 'Data Ujian Berhasil Diupdate');
    }

    public function form_buat_soal($id){    
        $ujian = Ujian::where('id','=',$id)->first();
        return view('soals.index',compact('ujian','id'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ujian  $ujian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ujian $ujian)
    {
        //
        $ujian->delete();
        return redirect()->route('ujians.index')
            ->with('success', 'Data Ujian Berhasil Dihapus');
    }
}

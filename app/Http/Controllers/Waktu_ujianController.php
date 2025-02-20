<?php

namespace App\Http\Controllers;

use App\Models\waktu_ujian;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Waktu_ujianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:waktu_ujian-list|waktu_ujian-create|waktu_ujian-edit|waktu_ujian-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:waktu_ujian-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:waktu_ujian-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:waktu_ujian-delete', ['only' => ['destroy']]);
    }
    public function index_old()
    {
        //
        $ujians = waktu_ujian::latest()->paginate(5);
        return view('waktu_ujians.index', compact('waktu_ujians'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function index(Request $request)
    {
        if ($request->ajax()){
            $query_data = new waktu_ujian();

            if($request->sSearch){
                $search_value ='%'.$request->sSearch.'%';
                $query_data=$query_data->where(function($query)use ($search_value) {
                    $query->where('santri_id','like', $search_value);
                });
            }
            $data = $query_data->orderBy('santri_id','asc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btn = '';
            
                
                if (auth()->user()->can('waktu_ujian-show')) {
                    $btn .= '<a class="btn btn-info" href="' . route('waktu_ujians.show', $row->id) . '">Show</a> ';
                }
            
            
                if (auth()->user()->can('waktu_ujian-edit')) {
                    $btn .= '<a class="btn btn-primary" href="' . route('waktu_ujians.edit', $row->id) . '">Edit</a> ';
                }
            
                if (auth()->user()->can('waktu_ujian-delete')) {
                    $btn .= '
                    <form action="' . route('waktu_ujians.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>';
                }
            
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('waktu_ujians.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('waktu_ujians.create');
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
            'waktu_mulai' => 'required',
            'waktu_selesai' =>'required',
        ]);
        waktu_ujian::create($request->all());
        return redirect()->route('waktu_ujians.index')
            ->with('success', 'Data waktu ujian Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\waktu_ujian  $waktu_ujian
     * @return \Illuminate\Http\Response
     */
    public function show(waktu_ujian $waktu_ujian)
    {
        //
        return view('waktu_ujians.show', compact('waktu_ujian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\waktu_ujian  $waktu_ujian
     * @return \Illuminate\Http\Response
     */
    public function edit(waktu_ujian $waktu_ujian)
    {
        //
        return view('waktu_ujians.edit', compact('waktu_ujian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\waktu_ujian  $waktu_ujian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, waktu_ujian $waktu_ujian)
    {
        //
        $request->validate([
            'santri_id' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' =>'required',
        ]);

        $waktu_ujian->update($request->all());
        return redirect()->route('waktu_ujians.index')
            ->with('success', 'Data waktu ujian Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\waktu_ujian  $waktu_ujian
     * @return \Illuminate\Http\Response
     */
    public function destroy(waktu_ujian $waktu_ujian)
    {
        //
        $waktu_ujian->delete();
        return redirect()->route('waktu_ujians.index')
            ->with('success', 'Data waktu ujian Berhasil Dihapus');
    }
}

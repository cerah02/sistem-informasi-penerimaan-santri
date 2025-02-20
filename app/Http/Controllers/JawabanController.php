<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:jawaban-list|jawaban-create|jawaban-edit|jawaban-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:jawaban-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:jawaban-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:jawaban-delete', ['only' => ['destroy']]);
    }
    public function index_old()
    {
        //
        $jawabans = Jawaban::latest()->paginate(5);
        return view('jawabans.index',compact('jawabans'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function index(Request $request)
    {
             if ($request->ajax()) {
            $query_data = new Jawaban();

            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('santri_id', 'like', $search_value)
                        ->orwhere('soals', 'like', $search_value)
                        ->orwhere('status_jawaban', 'like', $search_value);
                });
            }
            $data = $query_data->orderBy('santri_id', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $btn = '';
                
                    // Cek permission 'view santri'
                    if (auth()->user()->can('jawaban-show')) {
                        $btn .= '<a class="btn btn-info" href="' . route('jawabans.show', $row->id) . '">Show</a> ';
                    }
                
                    // Cek permission 'edit jawaban'
                    if (auth()->user()->can('jawaban-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('jawabans.edit', $row->id) . '">Edit</a> ';
                    }
                
                    // Cek permission 'delete jawaban'
                    if (auth()->user()->can('jawaban-delete')) {
                        $btn .= '
                        <form action="' . route('jawabans.destroy', $row->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>';
                    }
                
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('jawabans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jawabans.create');
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
            'soal_id' => 'required',
            'jawaban' => 'required',
            'status_jawaban' => 'required',
            ]);
            Jawaban::create($request->all());
            return redirect()->route('jawabans.index')
            ->with('success','Data Jawaban Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function show(Jawaban $jawaban)
    {
        //
        return view('jawabans.show', compact('jawaban'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    
    public function edit(Jawaban $jawaban)
    {
        return view('jawabans.edit', compact('jawaban'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jawaban $jawaban)
    {
        //
        $request->validate([
            'santri_id' => 'required',
            'soal_id' => 'required',
            'jawaban' => 'required',
            'status_jawaban' => 'required',
            ]);
            $jawaban->update($request->all());
            return redirect()->route('jawabans.index')
            ->with('success', 'Data Jawaban Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jawaban  $jawaban
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jawaban $jawaban)
    {
        //
        $jawaban->delete();
        return redirect()->route('jawabans.index')
        ->with('success','Data Jawaban Berhasil Dihapus');
    }
}

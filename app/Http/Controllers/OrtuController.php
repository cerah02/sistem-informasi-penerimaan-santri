<?php

namespace App\Http\Controllers;

use App\Models\Ortu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrtuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_old()
    {
        //
        $ortus = Ortu::latest()->paginate(5);
        return view('ortus.index', compact('ortus'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function index(Request $request)
    {
        if ($request->ajax()){
            $query_data = new Ortu();

            if($request->sSearch){
                $search_value ='%'.$request->sSearch.'%';
                $query_data=$query_data->where(function($query)use ($search_value) {
                    $query->where('santri_id','like', $search_value)
                    ->orwhere('nama_ayah','like', $search_value)
                    ->orwhere('nama_ibu','like', $search_value);
                });
            }
            $data = $query_data->orderBy('santri_id','asc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($row){
                $btn='
                <form action="'.route('ortus.destroy',$row->id).'" method="POST">
                <a class="btn btn-info" href="'.route('ortus.show',$row->id).'">Show</a>
                <a class="btn btn-primary" href="'.route('ortus.edit',$row->id).'">Edit</a>
                '.csrf_field().method_field('DELETE').'
                <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                ';
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
        //
        return view('ortus.create');
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
            'pendidikan_ayah'=>'required',
            'pekerjaan_ayah'=>'required',
            'nama_ibu'=>'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required',
            ]);
            Ortu::create($request->all());
            return redirect()->route('ortus.index')
            ->with('success','Data Orang Tua Berhasil Disimpan.');
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
        return view('ortus.show',compact('ortu'));
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
        return view('ortus.edit',compact('ortu'));
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
            'pendidikan_ayah'=>'required',
            'pekerjaan_ayah'=>'required',
            'nama_ibu'=>'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required',
            ]);

            $ortu->update($request->all());
            return redirect()->route('ortus.index')
            ->with('success','Data Orang Tua Berhasil Diupdate');
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
        ->with('success','Data Orang Tua Berhasil Dihapus');
    }
}

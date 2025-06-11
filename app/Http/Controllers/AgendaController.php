<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:agenda-list|agenda-create|agenda-edit|agenda-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:agenda-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:agenda-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:agenda-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query_data = new Agenda();
            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('nama_agenda', 'like', $search_value)
                        ->orwhere('tanggal_agenda', 'like', $search_value);
                });
            }
            $data = $query_data->orderBy('tanggal_agenda', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $btn = '';

                    // Cek permission 'view santri'
                    if (auth()->user()->can('agenda-show')) {
                        $btn .= '<a class="btn btn-info" href="' . route('agendas.show', $row->id) . '">Show</a> ';
                    }

                    // Cek permission 'edit agenda'
                    if (auth()->user()->can('agenda-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('agendas.edit', $row->id) . '">Edit</a> ';
                    }

                    // Cek permission 'delete agenda'
                    if (auth()->user()->can('agenda-delete')) {
                        $btn .= '
                        <form action="' . route('agendas.destroy', $row->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>';
                    }

                    return $btn;
                })
                ->rawColumns(['aksi', 'foto_agenda'])
                ->make(true);
        }
        return view('agendas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agendas.create');
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
            'nama_agenda' => 'required',
            'jam_agenda' => 'required',
            'tanggal_agenda' => 'required',
            'tempat_agenda' => 'required',
            // 'status_agenda' => 'required',
            'foto_agenda' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
        ]);
        $input = $request->all();
        if ($request->hasFile('foto_agenda')) {
            // Construct the file name with the correct extension
            $fileName = time() . '_' . $request->nama_agenda . '.' . $request->file('foto_agenda')->getClientOriginalExtension();

            // Move the uploaded file to the desired location
            $fotoPath = $request->file('foto_agenda')->move(public_path('uploads/agenda/foto_agenda'), $fileName);

            // Save the file path to the $data array
            $input['foto_agenda'] = 'uploads/agenda/foto_agenda/' . $fileName;
        }

        $status = Agenda::create($input);
        return redirect()->route('agendas.index')
            ->with('success', 'Data Agenda Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        return view('agendas.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        return view('agendas.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'nama_agenda' => 'required',
            'jam_agenda' => 'required',
            'tanggal_agenda' => 'required',
            'tempat_agenda' => 'required',
            // 'status_agenda' => 'required',
            'foto_agenda' => 'required',
        ]);

        $agenda->update($request->all());
        return redirect()->route('agendas.index')
            ->with('success', 'Data Agenda Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('agendas.index')
            ->with('success', 'Data Agenda Berhasil Dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Contracts\Service\Attribute\Required;
use Yajra\DataTables\Facades\DataTables;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:santri-list|santri-create|santri-edit|santri-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:santri-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:santri-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:santri-delete', ['only' => ['destroy']]);
    }
    public function index_old()
    {
        //
        $santris = santri::latest()->paginate(5);
        return view('santris.index', compact('santris'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query_data = new Santri();

            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('nama', 'like', $search_value)
                        ->orwhere('nik', 'like', $search_value)
                        ->orwhere('nisn', 'like', $search_value);
                });
            }
            $data = $query_data->orderBy('nama', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $btn = '';

                    // Cek permission 'view santri'
                    if (auth()->user()->can('santri-show')) {
                        $btn .= '<a class="btn btn-info" href="' . route('santris.show', $row->id) . '">Show</a> ';
                    }

                    // Cek permission 'edit santri'
                    if (auth()->user()->can('santri-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('santris.edit', $row->id) . '">Edit</a> ';
                    }

                    // Cek permission 'delete santri'
                    if (auth()->user()->can('santri-delete')) {
                        $btn .= '
                            <form action="' . route('santris.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>';
                    }

                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('santris.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('santris.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tambah(Request $request)
    {

        $request->validate([
            'nama' => 'nullable',
            'nisn' => 'nullable',
            'nik' => 'nullable',
            'asal_sekolah' => 'nullable',
            'jenis_kelamin' => 'nullable',
            'kondisi' => 'nullable',
            'kondisi_ortu' => 'nullable',
            'status_dkluarga' => 'nullable',
            'tempat_tinggal' => 'nullable',
            'kewarganegaraan' => 'nullable',
            'anak_ke' => 'nullable',
            'jumlah_saudara' => 'nullable',
            'alamat' => 'nullable',
            'tanggal_lahir' => 'nullable',
            'tempat_lahir' => 'nullable',
            'nomor_telpon' => 'nullable',
            'email' => 'nullable',
            'jenjang_pendidikan' => 'nullable',
            'tahun_masuk' => 'nullable'
        ]);
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make('12341234')
        ]);
        $role = Role::where('name', '=', 'Santri')->orWhere('name', '=', 'santri')->first();
        $user->assignRole([$role->id]);
        $input = $request->all();
        $input['user_id'] = $user->id;
        $input['ttl'] = $request->tempat_lahir . '|' . $request->tanggal_lahir; // Menggunakan pemisah '|'
        Santri::create($input);
        return redirect()->route('santris.index')
            ->with('success', 'Data Santri Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function show(Santri $santri)
    {
        //
        return view('santris.show', compact('santri'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function edit(Santri $santri)
    {
        //
        return view('santris.edit', compact('santri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function ubah(Request $request, Santri $santri)
    {
        $request->validate([
            'nama' => 'required',
            'nisn' => 'required',
            'nik' => 'required',
            'asal_sekolah' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'kondisi' => 'required',
            'kondisi_ortu' => 'required',
            'status_dkluarga' => 'required',
            'tempat_tinggal' => 'required',
            'kewarganegaraan' => 'required',
            'anak_ke' => 'required|integer',
            'jumlah_saudara' => 'required|integer',
            'alamat' => 'required',
            'nomor_telpon' => 'required|numeric',
            'email' => 'required|email',
            'jenjang_pendidikan' => 'required',
            'tahun_masuk' => 'required',
        ]);

        // Pastikan user dengan email yang diberikan ada
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'User tidak ditemukan.']);
        }

        // Update data user
        $user->update([
            'name' => $request->nama,
            'email' => $request->email
        ]);

        // Update data santri
        $santri->update([
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'nik' => $request->nik,
            'asal_sekolah' => $request->asal_sekolah,
            'jenis_kelamin' => $request->jenis_kelamin,
            'ttl' => $request->tempat_lahir . '|' . $request->tanggal_lahir,
            'kondisi' => $request->kondisi,
            'kondisi_ortu' => $request->kondisi_ortu,
            'status_dkluarga' => $request->status_dkluarga,
            'tempat_tinggal' => $request->tempat_tinggal,
            'kewarganegaraan' => $request->kewarganegaraan,
            'anak_ke' => $request->anak_ke,
            'jumlah_saudara' => $request->jumlah_saudara,
            'alamat' => $request->alamat,
            'nomor_telpon' => $request->nomor_telpon,
            'jenjang_pendidikan' => $request->jenjang_pendidikan,
            'tahun_masuk' => $request->tahun_masuk,
            'user_id' => $user->id,
        ]);

        return redirect()->route('santris.index')
            ->with('success', 'Data Santri Berhasil Diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Santri $santri)
    {
        //
        $santri->delete();
        return redirect()->route('santris.index')
            ->with('success', 'Data Santri Berhasil Dihapus');
    }
}

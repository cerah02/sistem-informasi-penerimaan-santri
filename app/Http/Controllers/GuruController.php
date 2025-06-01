<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:guru-list|guru-create|guru-edit|guru-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:guru-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:guru-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:guru-delete', ['only' => ['destroy']]);
    }
    public function index_old()
    {
        //
        $gurus = guru::latest()->paginate(5);
        return view('gurus.index', compact('gurus'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query_data = new Guru();
            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('nama', 'like', $search_value)
                        ->orwhere('nip', 'like', $search_value);
                });
            }
            $data = $query_data->orderBy('nama', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $btn = '';

                    // Cek permission 'view santri'
                    if (auth()->user()->can('guru-show')) {
                        $btn .= '<a class="btn btn-info" href="' . route('gurus.show', $row->id) . '">Show</a> ';
                    }

                    // Cek permission 'edit guru'
                    if (auth()->user()->can('guru-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('gurus.edit', $row->id) . '">Edit</a> ';
                    }

                    // Cek permission 'delete guru'
                    if (auth()->user()->can('guru-delete')) {
                        $btn .= '
                    <form action="' . route('gurus.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>';
                    }

                    return $btn;
                })->addColumn('foto', function ($row) {
                    $path = asset('storage/' . $row->foto);
                    $extension = pathinfo($row->foto, PATHINFO_EXTENSION);

                    if (in_array(strtolower($extension), ['pdf', 'docx'])) {
                        return '
                            <div class="btn-group">
                                <a href="' . $path . '" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                <a href="' . $path . '" download class="btn btn-sm btn-success">Unduh</a>
                            </div>';
                    } else {
                        return '<img src="' . $path . '" width="50" />';
                    }
                })
                ->rawColumns(['aksi', 'foto'])
                ->make(true);
        }
        return view('gurus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('gurus.create');
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
            'nama' => 'required',
            'nip' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'email' => 'required|email',
            'foto' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'status_guru' => 'required',
        ]);

        // Cek apakah ingin membuat akun
        if ($request->has('buat_akun')) {
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make('12341234') // Default password
            ]);

            $role = Role::where('name', 'Guru')->orWhere('name', 'guru')->first();
            if ($role) {
                $user->assignRole([$role->id]);
            }

            // Simpan user_id ke request agar bisa digabung ke input
            $request->merge(['user_id' => $user->id]);
        }

        $input = $request->except(['tempat_lahir', 'tanggal_lahir', 'foto']); // kecuali ini karena akan diproses khusus
        $input['ttl'] = $request->tempat_lahir . '|' . $request->tanggal_lahir;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $request->nama . '.' . $file->getClientOriginalExtension();

            // Simpan menggunakan Storage facade ke disk publik
            $path = $file->storeAs('uploads/guru/foto', $fileName, 'public');
            $input['foto'] = $path; // Simpan path ke database
        }

        Guru::create($input);

        return redirect()->route('gurus.index')
            ->with('success', 'Data Guru Berhasil Disimpan.');
    }


    public function tampilanGuru()
    {
        $gurus = Guru::all(); // Mengambil semua data guru dari database
        return view('tampilan_guru', compact('gurus')); // Mengirimkan data ke view 'gurus.tampilan_guru'
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(Guru $guru)
    {
        //
        return view('gurus.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        //
        return view('gurus.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'email' => 'required|email',
            'foto' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
            'status_guru' => 'required',
        ]);

        // Update user juga jika email cocok
        $user = User::where('email', $guru->email)->first(); // Lebih aman pakai $guru->email
        if ($user) {
            $user->update([
                'name' => $request->nama,
                'email' => $request->email
            ]);
        }

        // Siapkan data input
        $input = $request->except(['tempat_lahir', 'tanggal_lahir', 'foto']);
        $input['ttl'] = $request->tempat_lahir . '|' . $request->tanggal_lahir;

        // Jika ada file foto baru
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $request->nama . '.' . $file->getClientOriginalExtension();

            // Simpan ke Storage
            $path = $file->storeAs('uploads/guru/foto', $fileName, 'public');
            $input['foto'] = $path;

            // Hapus foto lama dari storage jika ada
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }
        }

        $guru->update($input);

        return redirect()->route('gurus.index')
            ->with('success', 'Data Guru Berhasil Diupdate');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {
        //
        $guru->delete();
        return redirect()->route('gurus.index')
            ->with('success', 'Data Guru Berhasil Dihapus');
    }
}

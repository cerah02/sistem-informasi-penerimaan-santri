<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PengumumanController extends Controller
{
    
    function __construct()
    {
        $this->middleware(
            'permission:pengumuman-list|pengumuman-create|pengumuman-edit|pengumuman-delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:pengumuman-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pengumuman-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pengumuman-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query_data = new Pengumuman();

            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('judul', 'like', $search_value)
                        ->orwhere('tanggal_rilis', 'like', $search_value)
                        ->orwhere('is_active', 'like', $search_value);
                });
            }
            $data = $query_data->orderBy('judul', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $btn = '';


                    if (auth()->user()->can('pengumuman-show')) {
                        $btn .= '<a class="btn btn-info" href="' . route('pengumuman.show', $row->id) . '">Show</a> ';
                    }


                    if (auth()->user()->can('pengumuman-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('pengumuman.edit', $row->id) . '">Edit</a> ';
                    }

                    if (auth()->user()->can('pengumuman-delete')) {
                        $btn .= '
                    <form action="' . route('pengumuman.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>';
                    }

                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pengumuman.index');
    }
    public function create()
    {
        //
        return view('pengumuman.create');
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal_rilis' => 'required|date',
            'is_active' => 'required|boolean',
        ]);
        Pengumuman::create($request->all());
        return redirect()->route('pengumuman.index')
            ->with('success', 'Data Pengumuman Berhasil Disimpan.');
    }

    public function show(Pengumuman $pengumuman)
    {
        //
        return view('pengumuman.show', compact('pengumuman'));
    }

    public function edit(Pengumuman $pengumuman)
    {
        //
        return view('pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        //
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal_rilis' => 'required|date',
            'is_active' => 'required|boolean',
        ]);

        $pengumuman->update($request->all());
        return redirect()->route('pengumuman.index')
            ->with('success', 'Data Pengumuman Berhasil Diupdate');
    }
    public function destroy(Pengumuman $pengumuman)
    {
        //
        $pengumuman->delete();
        return redirect()->route('pengumuman.index')
            ->with('success', 'Data Pengumuman Berhasil Dihapus');
    }

    public function showKelulusan()
    {
        $pengumuman = Pengumuman::where('is_active', true)
            ->where('tanggal_rilis', '<=', now())
            ->first();

        if (!$pengumuman) {
            return view('pengumuman-belum');
        }

        $data_hasil = Hasil::with(['santri', 'ujian'])->get();

        $data_pengumuman = $data_hasil->groupBy('santri_id')->map(function ($group) {
            $santri = $group->first()->santri;
            $jenjang = $santri->jenjang_pendidikan;

            $hasil_sesuai_jenjang = $group->filter(function ($item) use ($jenjang) {
                return $item->ujian->jenjang_pendidikan == $jenjang;
            });

            $total_nilai = $hasil_sesuai_jenjang->sum('total_nilai_kategori');
            $jumlah_ujian = $hasil_sesuai_jenjang->count();
            $rata_rata = $jumlah_ujian > 0 ? $total_nilai / $jumlah_ujian : 0;
            $status = $rata_rata >= 70 ? 'Lulus' : 'Tidak Lulus';

            return [
                'nama_santri' => $santri->nama,
                'jenjang' => $jenjang,
                'total_nilai' => $total_nilai,
                'rata_rata' => round($rata_rata, 2),
                'status_kelulusan' => $status,
            ];
        })->values();

        return view('pengumuman-index', compact('data_pengumuman', 'pengumuman'));
    }
}
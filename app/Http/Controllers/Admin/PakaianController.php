<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PakaianController extends Controller
{
    public function index()
    {
        $pakaian = Pakaian::all();
        return view('pakaian.index', compact('pakaian'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pakaian' => 'required|max:25',
            'foto_pakaian' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'jenis_kelamin' => 'required',
            'jenjang_pendidikan' => 'required',
            'keterangan' => 'required'
        ]);

        if ($request->hasFile('foto_pakaian')) {
            $file = $request->file('foto_pakaian');
            $path = $file->store('pakaian', 'public');
            $validated['foto_pakaian'] = $path;
        }

        Pakaian::create($validated);

        return redirect()->route('pakaian_edit.index')->with('success', 'Pakaian berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $pakaian = Pakaian::findOrFail($id);

        $validated = $request->validate([
            'nama_pakaian' => 'required|max:25',
            'foto_pakaian' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'jenis_kelamin' => 'required',
            'jenjang_pendidikan' => 'required',
            'keterangan' => 'required'
        ]);

        if ($request->hasFile('foto_pakaian')) {
            if ($pakaian->foto_pakaian && Storage::disk('public')->exists($pakaian->foto_pakaian)) {
                Storage::disk('public')->delete($pakaian->foto_pakaian);
            }
            $file = $request->file('foto_pakaian');
            $path = $file->store('pakaian', 'public');
            $validated['foto_pakaian'] = $path;
        }

        $pakaian->update($validated);

        return redirect()->route('pakaian_edit.index')->with('success', 'Pakaian berhasil diupdate.');
    }

    public function destroy($id)
    {
        $pakaian = Pakaian::findOrFail($id);

        if ($pakaian->foto_pakaian && Storage::disk('public')->exists($pakaian->foto_pakaian)) {
            Storage::disk('public')->delete($pakaian->foto_pakaian);
        }

        $pakaian->delete();

        return redirect()->route('pakaian_edit.index')->with('success', 'Pakaian berhasil dihapus.');
    }



    public function pakaian()
    {
        $pakaian = pakaian::all();
        return view('pakaian', compact('pakaian'));
    }

    public function pakaianPutra()
    {
        $pakaian = \App\Models\Pakaian::where('jenis_kelamin', 'laki-laki')
            ->orderBy('jenjang_pendidikan')
            ->get()
            ->groupBy('jenjang_pendidikan');

        return view('pakaian_putra', compact('pakaian'));
    }

    public function pakaianPutri()
    {
        $pakaian = \App\Models\Pakaian::where('jenis_kelamin', 'perempuan')
            ->orderBy('jenjang_pendidikan')
            ->get()
            ->groupBy('jenjang_pendidikan');

        return view('pakaian_putri', compact('pakaian'));
    }
}

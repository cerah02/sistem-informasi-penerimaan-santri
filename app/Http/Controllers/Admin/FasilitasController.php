<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return view('fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.fasilitas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'required|max:25',
            'foto_fasilitas' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'keterangan'     => 'required'
        ]);

        if ($request->hasFile('foto_fasilitas')) {
            $file = $request->file('foto_fasilitas');
            $path = $file->store('fasilitas', 'public');
            $validated['foto_fasilitas'] = $path;
        }

        Fasilitas::create($validated);

        return redirect()->route('fasilitas_edit.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Fasilitas $fasilitas)
    {
        return view('fasilitas', compact('fasilitas'));
    }

    public function update(Request $request, Fasilitas $fasilitas)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'required|max:25',
            'foto_fasilitas' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'keterangan'     => 'required'
        ]);

        if ($request->hasFile('foto_fasilitas')) {
            $file = $request->file('foto_fasilitas');
            $path = $file->store('fasilitas', 'public');
            $validated['foto_fasilitas'] = $path;
        }

        $fasilitas->update($validated);

        return redirect()->route('fasilitas_edit.index')->with('success', 'Fasilitas berhasil diupdate.');
    }

    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->delete();
        return redirect()->route('fasilitas_edit.index')->with('success', 'Fasilitas berhasil dihapus.');
    }

    public function fasilitas()
    {
        $fasilitas = Fasilitas::all();
        return view('fasilitas', compact('fasilitas'));
    }
}

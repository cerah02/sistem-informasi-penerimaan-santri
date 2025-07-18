<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brosur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrosurController extends Controller
{
    public function index()
    {
        $brosur = Brosur::all();
        return view('brosur.index', compact('brosur'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'foto_brosur' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'jenjang_pendidikan' => 'required|in:SD,MTS,MA|unique:brosur,jenjang_pendidikan',
        ]);

        // Upload gambar
        if ($request->hasFile('foto_brosur')) {
            $path = $request->file('foto_brosur')->store('brosur', 'public');
            $validated['foto_brosur'] = $path;
        }

        Brosur::create($validated);

        return redirect()->route('brosur_edit.index')->with('success', 'Brosur berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $brosur = Brosur::findOrFail($id);

        $validated = $request->validate([
            'foto_brosur' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'jenjang_pendidikan' => 'required'
        ]);

        if ($request->hasFile('foto_brosur')) {
            if ($brosur->foto_brosur && Storage::disk('public')->exists($brosur->foto_brosur)) {
                Storage::disk('public')->delete($brosur->foto_brosur);
            }
            $file = $request->file('foto_brosur');
            $path = $file->store('brosur', 'public');
            $validated['foto_brosur'] = $path;
        }

        $brosur->update($validated);

        return redirect()->route('brosur_edit.index')->with('success', 'Brosur berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $brosur = Brosur::findOrFail($id);
        if ($brosur->foto_brosur && Storage::disk('public')->exists($brosur->foto_brosur)) {
            Storage::disk('public')->delete($brosur->foto_brosur);
        }

        $brosur->delete();

        return redirect()->route('brosur_edit.index')->with('success', 'Brosur berhasil dihapus.');
    }

    public function brosur()
    {
        $brosur = Brosur::all();
        return view('brosur', compact('brosur'));
    }
}

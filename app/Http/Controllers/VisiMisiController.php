<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisi;

class VisiMisiController extends Controller
{
    public function edit()
    {
        $contents = VisiMisi::all()->keyBy('key');
        return view('visi_misi.edit', compact('contents'));
    }

    public function update(Request $request)
    {
        $visi = $request->input('visi');
        $quote = $request->input('quote');
        $misi = $request->input('misi'); // array
        $nilai = $request->input('nilai'); // array of cards

        VisiMisi::updateOrCreate(['key' => 'visi'], ['value' => $visi]);
        VisiMisi::updateOrCreate(['key' => 'quote'], ['value' => $quote]);
        VisiMisi::updateOrCreate(['key' => 'misi'], ['value' => json_encode($misi)]);
        VisiMisi::updateOrCreate(['key' => 'nilai'], ['value' => json_encode($nilai)]);

        return redirect()->back()->with('success', 'Konten Visi Misi berhasil diperbarui.');
    }
}

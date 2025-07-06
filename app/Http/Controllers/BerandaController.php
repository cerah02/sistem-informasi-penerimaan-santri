<?php

namespace App\Http\Controllers;

use App\Models\Beranda;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $contents = Beranda::all()->keyBy('key');
        return view('beranda.index', compact('contents'));
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            Beranda::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return redirect()->back()->with('success', 'Konten beranda berhasil diperbarui.');
    }
}

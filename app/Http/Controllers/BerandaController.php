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
        $data = Beranda::all()->keyBy('key');

        foreach ($data as $key => $item) {
            if ($request->hasFile($key)) {
                // Hapus file lama jika ada
                if ($item->value && file_exists(public_path($item->value))) {
                    unlink(public_path($item->value));
                }

                // Simpan file baru
                $file = $request->file($key);
                $filename = $key . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = 'landing_assets/img/' . $filename;
                $file->move(public_path('landing_assets/img'), $filename);

                // Update value di DB
                $item->update(['value' => $path]);
            } elseif ($request->filled($key)) {
                $item->update(['value' => $request->input($key)]);
            }
        }

        return redirect()->back()->with('success', 'Konten Beranda berhasil diperbarui.');
    }
}

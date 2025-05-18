<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TotalHasilController extends Controller
{
    public function laporan(Request $request)
    {
        $jenjang = $request->input('jenjang');
        $tahun_masuk = $request->input('tahun_masuk');

        $query = Santri::with(['pendaftaran', 'total_hasil']);

        if ($jenjang) {
            $query->where('jenjang_pendidikan', $jenjang);
        }

        if ($tahun_masuk) {
            $query->where('tahun_masuk', $tahun_masuk);
        }

        $santris = $query->get();

        // Get available years for filter dropdown
        $availableYears = Santri::select('tahun_masuk')
            ->distinct()
            ->orderBy('tahun_masuk', 'desc')
            ->pluck('tahun_masuk');

        return view('laporan.index', compact('santris', 'jenjang', 'tahun_masuk', 'availableYears'));
    }

    public function cetakPdf(Request $request)
    {
        $jenjang = $request->input('jenjang');

        $query = Santri::with(['pendaftaran', 'total_hasil']);

        if ($jenjang) {
            $query->where('jenjang_pendidikan', $jenjang);
        }

        $santris = $query->get();

        $pdf = Pdf::loadView('laporan.pdf', compact('santris', 'jenjang'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('laporan-santri.pdf');
    }
}

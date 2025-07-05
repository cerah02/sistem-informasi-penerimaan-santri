<?php

namespace App\Http\Controllers;

use App\Models\PassingGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PassingGradeController extends Controller
{
    public function index()
    {
        $passingGrades = PassingGrade::all();
        return view('passing_grades.index', compact('passingGrades'));
    }

    public function edit() {}

    public function update(Request $request, $id)
    {
        $request->validate([
            'passing_grade' => 'required|integer|min:0|max:100',
        ]);

        $passingGrade = PassingGrade::findOrFail($id);

        // Update passing grade
        $passingGrade->passing_grade = $request->passing_grade;
        $passingGrade->save();

        // Ambil jenjang yang diupdate
        $jenjang = $passingGrade->jenjang;
        $newPassingGrade = $passingGrade->passing_grade;

        // Ambil semua santri pada jenjang ini dari total_hasils
        $totalHasils = DB::table('total_hasils')
            ->join('santris', 'total_hasils.santri_id', '=', 'santris.id')
            ->where('santris.jenjang_pendidikan', $jenjang)
            ->select('total_hasils.id', 'total_hasils.rata_rata')
            ->get();

        foreach ($totalHasils as $hasil) {
            $status = $hasil->rata_rata >= $newPassingGrade ? 'Lulus' : 'Tidak Lulus';

            // Update status kelulusan di total_hasils
            DB::table('total_hasils')
                ->where('id', $hasil->id)
                ->update([
                    'status' => $status,
                    'updated_at' => now()
                ]);
        }

        return response()->json(['success' => true, 'message' => 'Passing grade dan status kelulusan berhasil diperbarui.']);
    }
}

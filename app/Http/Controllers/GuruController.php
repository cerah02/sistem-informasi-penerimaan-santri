<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gurus = Guru::latest()->paginate(5);
        return view('gurus.index', compact('gurus'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
        // dd($request->all());
        //
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'email' => 'required',
            'foto' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
            'status_guru' => 'required',
        ]);
        $input = $request->all();
        $input['ttl'] = $request->tempat_lahir . ' ' . $request->tanggal_lahir;
        if ($request->hasFile('foto')) {
            // Construct the file name with the correct extension
            $fileName = time() . '_' . $request->nama . '.' . $request->file('foto')->getClientOriginalExtension();

            // Move the uploaded file to the desired location
            $fotoPath = $request->file('foto')->move(public_path('uploads/guru/foto'), $fileName);

            // Save the file path to the $data array
            $input['foto'] = 'uploads/guru/foto/' . $fileName;
        }

        Guru::create($input);
        return redirect()->route('gurus.index')
            ->with('success', 'Data Guru Berhasil Disimpan.');
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
        //
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jenis_kelamin' => 'required',
            'ttl' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'email' => 'required',
            'foto' => 'required',
            'status_guru' => 'required',
        ]);

        $guru->update($request->all());
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

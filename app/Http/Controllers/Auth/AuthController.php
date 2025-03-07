<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Pendaftaran;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only(
            'email',
            'password'
        );
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully loggedin');
        }
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data = $request->all();
        $check = $this->create($data);
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    public function edit_profile()
    {
        return View('auth.edit_profile');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        $guru = "";
        $santri = "";
        if (Auth::check()) {
            if (Auth::user()->hasRole('guru')) {
                $guru = Guru::where('email', "=", auth()->user()->email)->first();
            }
            if (Auth::user()->hasRole('santri')) {
                $santri = Guru::where('email', "=", auth()->user()->email)->first();
            }
            $jumlah_santri = Santri::count();
            $jumlah_santri_mendaftar_tahun_ini = Santri::where('created_at', '>=' . Carbon::now())->count();
            $santri_sd = Santri::where('jenjang_pendidikan','=','SD')->count();
            $santri_mts = Santri::where('jenjang_pendidikan','=','MTS')->count();
            $santri_ma = Santri::where('jenjang_pendidikan','=','MA')->count();
            $jumlah_santri_yang_sudah_disetujui = Pendaftaran::where('status', '=', 'disetujui')->count();
            $jumlah_santri_yang_menunggu_disetujui = Pendaftaran::where('status', '=', 'proses')->count();
            return view('auth.dashboard', compact('guru', 'jumlah_santri', 'jumlah_santri_mendaftar_tahun_ini', 'jumlah_santri_yang_sudah_disetujui', 'jumlah_santri_yang_menunggu_disetujui','santri','guru','santri_sd',
        'santri_sd', 'santri_mts','santri_ma'));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Validasi gambar
            'password' => 'nullable|string'
        ]);

        // dd($request->all());

        $user = auth()->user();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        // Handle upload gambar
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/profil', $filename);

            // Hapus gambar lama jika ada
            if ($user->profile_image && file_exists(storage_path('app/public/profil/' . $user->foto))) {
                unlink(storage_path('app/public/profil/' . $user->foto));
            }

            // Simpan nama file ke database
            $data['foto'] = $filename;
        }

        // Update user
        $user->update($data);

        return redirect()->route('dashboard')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}

<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
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
        return view('auth.login_test');
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
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if (Auth::check()) {
            $jumlah_santri = Santri::count();
            $jumlah_santri_mendaftar_tahun_ini = Santri::where('created_at','>='.Carbon::now())->count();
            $jumlah_santri_yang_sudah_disetujui = Pendaftaran::where('status','=','disetujui')->count();
            $jumlah_santri_yang_menunggu_disetujui = Pendaftaran::where('status','=','proses')->count();
            return view('auth.dashboard',compact('jumlah_santri','jumlah_santri_mendaftar_tahun_ini','jumlah_santri_yang_sudah_disetujui','jumlah_santri_yang_menunggu_disetujui'));
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

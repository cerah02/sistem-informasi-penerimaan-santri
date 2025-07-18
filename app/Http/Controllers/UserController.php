<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query();

            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $users->where(function ($query) use ($search_value) {
                    $query->where('name', 'like', $search_value)
                        ->orWhere('email', 'like', $search_value)
                        ->orWhere('nomor_telpon', 'like', $search_value);
                });
            }

            return datatables()->of($users)
                ->addIndexColumn()
                ->addColumn('roles', function ($row) {
                    $roles = $row->getRoleNames();
                    if (count($roles) > 0) {
                        return $roles->map(fn($r) => '<span class="badge bg-success">' . $r . '</span>')->implode(' ');
                    }
                    return '<span class="text-muted">No roles</span>';
                })
                ->addColumn('aksi', function ($row) {
                    $btn = '';
                    if (auth()->user()->can('user-show')) {
                        $btn .= '<a class="btn btn-info btn-sm me-1" href="' . route('users.show', $row->id) . '">Show</a>';
                    }
                    if (auth()->user()->can('user-edit')) {
                        $btn .= '<a class="btn btn-primary btn-sm me-1" href="' . route('users.edit', $row->id) . '">Edit</a>';
                    }
                    if (auth()->user()->can('user-delete')) {
                        $btn .= '<form action="' . route('users.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin hapus user ini?\')">Hapus</button>
                             </form>';
                    }
                    return $btn;
                })
                ->rawColumns(['roles', 'aksi'])
                ->make(true);
        }

        return view('users.index');
    }


    /*** Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nomor_telpon' => 'required|digits_between:10,15|unique:users,nomor_telpon',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'nomor_telpon' => 'required|nomor_telpon|unique:users,nomor_telpon,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}

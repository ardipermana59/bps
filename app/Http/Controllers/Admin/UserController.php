<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('pages.admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatan = Position::all();
        return view('pages.admin.user.add', compact('jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
            'role' => 'required|string|in:admin,staff,pegawai,penilai',
            'jabatan' => 'required|string|exists:positions,id',
            'nip' => 'required|string|unique:employees,nip',
        ]);

        // insert data ke table users
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        // insert data ke table employees
        Employee::create([
            'user_id' => $user->id,
            'position_id' => $request->jabatan,
            'nip' => $request->nip,
            'full_name' => $request->name,
        ]);

        return redirect()->route('user.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        // cari user berdasarkan id
        $user = User::find($id);

        // cek apakah user ada atau tidak
        if ($user == null) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }
        return view('pages.admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|string|max:255|in:active,inactive',
            'role' => 'required|string|max:255|in:admin,staff,pegawai,penilai',
        ]);
      
        $user = User::find($id);

        // cek apakah user ada atau tidak
        if ($user == null) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        // update data user
        $user->status = $request->status;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('user.index')->with('success', 'User berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // cari user berdasarkan id
        $user = User::find($id);

        // cek user ada tidak
        if ($user == null) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        // // hapus user
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }
}

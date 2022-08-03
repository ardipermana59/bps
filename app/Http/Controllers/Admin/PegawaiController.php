<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Employee::join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->select('employees.*', 'positions.name as position', 'users.email as email')
            ->get();
        return view('pages.admin.employee.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Employee::find($id);

        // cek pegawai ada tidak
        if ($data == null) {
            return redirect()->back()->with('error', 'Pegawai tidak ditemukan');
        }

        $jabatan = Position::all();

        if ($jabatan == null) {
            return redirect()->route('position.index')->with('error', 'Harap tambahkan jabatan terlebih dahulu');
        }
        return view('pages.admin.employee.edit', compact('data', 'jabatan'));
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
            'jabatan' => 'required|exists:positions,id',
            'full_name' => 'required|string|max:255',
            'gender' => 'in:Perempuan,Laki-laki',
            'hp' => 'max:20',
            'address' => 'max:255',
        ]);
        $employee = Employee::find($id);

        if ($employee == null) {
            return redirect()->back()->with('error', 'Data Pegawai Tidak Ditemukan');
        }

        $employee->position_id = $request->jabatan;
        $employee->full_name = $request->full_name;
        $employee->gender = $request->gender;
        $employee->hp = $request->hp;
        $employee->address = $request->address;
        $employee->save();

        return redirect()->route('employee.index')->with('success', 'Data Pegawai Berhasil Disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // cari pegawai berdasarkan id
        $employee = Employee::find($id);

        // cek pegawai ada tidak
        if ($employee == null) {
            return redirect()->back()->with('error', 'Pegawai tidak ditemukan');
        }

        // // hapus user sekaligus pegawai 
        User::find($employee->user_id)->delete();
        return redirect()->route('employee.index')->with('success', 'Pegawai berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Evaluator;
use App\Models\User;
use Illuminate\Http\Request;

class PenilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Evaluator::join('employees', 'employees.id', '=', 'evaluators.employee_id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->select('employees.*', 'evaluators.id as id_evaluator', 'positions.name as position')
            ->get();

        return view('pages.admin.penilai.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::join('positions', 'employees.position_id', '=', 'positions.id')
            ->select('employees.*', 'positions.name as position')
            ->get();
        return view('pages.admin.penilai.add', compact('employees'));
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
            'penilai' => 'required|exists:employees,id',
        ]);

        $evaluator = Evaluator::create([
            'employee_id' => $request->penilai,
        ]);

        // ubah role di table users
        $employee = Employee::find($evaluator->employee_id);
        $user = User::find($employee->user_id);
        $user->role = 'penilai';
        $user->save();

        return redirect()->route('penilai.index')->with('success', 'Data Penilai Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Evaluator::find($id);
        return view('pages.admin.penilai.edit', compact('data'));
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
            'name' => 'required|string|max:255',
        ]);

        $penilai = Evaluator::find($id);

        if ($penilai == null) {
            return redirect()->back()->with('error', 'Data Penilai Tidak Ditemukan');
        }

        $penilai->name = $request->name;
        $penilai->save();

        return redirect()->route('activity.index')->with('success', 'Data Penilai Berhasil Disimpan.');
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
        $penilai = Evaluator::find($id);

        // cek user ada tidak
        if ($penilai == null) {
            return redirect()->back()->with('error', 'Data Penilai Tidak Ditemukan');
        }

        // // hapus user
        $penilai->delete();

        // ubah role di table users
        $employee = Employee::find($penilai->employee_id);
        $user = User::find($employee->user_id);
        $user->role = 'staff';
        $user->save();
        
        return redirect()->route('penilai.index')->with('success', 'Data Penilai Berhasil Dihapus');
    }
}

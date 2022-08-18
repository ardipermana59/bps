<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Evaluator;
use App\Models\PenilaiPegawai;
use Illuminate\Http\Request;

class PenilaiPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PenilaiPegawai::join('employees', 'penilai_pegawais.employee_id', '=', 'employees.id')
            ->join('evaluators', 'penilai_pegawais.evaluator_id', '=', 'evaluators.id')
            ->join('employees as penilai', 'evaluators.employee_id', '=', 'penilai.id')
            ->join('positions', 'positions.id', '=', 'penilai.position_id')
            ->select('penilai_pegawais.id', 'employees.full_name as employee_name', 'positions.name as evaluator_position', 'penilai.full_name as evaluator_name')
            ->orderBy('evaluator_name')
            ->get();
        return view('pages.admin.struktur.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // mengambil seluruh data penilai
        $evaluators = $this->getEvaluators();

        // mengambil seluruh data pegawai yang bukan penilai
        $employees = $this->ge[]tEmployees();

        return view('pages.admin.struktur.add', compact('employees', 'evaluators'));
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
            // cek apakah data yang diinputkan ada di table employees atau tidak
            'pegawai' => 'required|exists:employees,id',
            // cek apakah data yang diinputkan ada di table evaluators atau tidak
            'penilai' => 'required|exists:evaluators,id',
        ]);

        PenilaiPegawai::create([
            'employee_id' => $request->pegawai,
            'evaluator_id' => $request->penilai,
        ]);

        return redirect()->route('struktur.index')->with('success', 'Berhasil menambahkan struktur baru');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  // mengambil seluruh data penilai
        $evaluators = $this->getEvaluators();

        // mengambil seluruh data pegawai yang bukan penilai
        $employees = $this->getEmployees();
        $struktur = PenilaiPegawai::find($id);

        if ($struktur == null) {
            return redirect()->route('struktur.index')->with('error', 'Data tidak ditemukan');
        }

        return view('pages.admin.struktur.edit', compact('employees', 'evaluators', 'struktur'));
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
            // cek apakah data yang diinputkan ada di table employees atau tidak
            'pegawai' => 'required|exists:employees,id',
            // cek apakah data yang diinputkan ada di table evaluators atau tidak
            'penilai' => 'required|exists:evaluators,id',
        ]);
        $struktur = PenilaiPegawai::find($id);

        if ($struktur == null) {
            return redirect()->route('struktur.index')->with('error', 'Data tidak ditemukan');
        }

        $struktur->update([
            'employee_id' => $request->pegawai,
            'evaluator_id' => $request->penilai,
        ]);

        return redirect()->route('struktur.index')->with('success', 'Berhasil mengubah struktur baru');
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
        $data = PenilaiPegawai::find($id);

        // cek user ada tidak
        if ($data == null) {
            return redirect()->back()->with('error', 'Struktur tidak ditemukan');
        }

        // // hapus user
        $data->delete();
        return redirect()->route('struktur.index')->with('success', 'Struktur berhasil dihapus');
    }

    /**
     * Get all evaluators.
     */
    private function getEvaluators()
    {
        return Evaluator::join('employees', 'evaluators.employee_id', '=', 'employees.id')
            ->join('positions', 'positions.id', '=', 'employees.position_id')
            ->select('evaluators.id', 'employees.full_name as evaluator_name', 'positions.name as position_name')
            ->orderBy('evaluator_name')
            ->get();
    }

    /**
     * Get all employees except evaluators.
     */
    private function getEmployees()
    {
        return Employee::join('positions', 'positions.id', '=', 'employees.position_id')
            ->leftJoin('evaluators', 'evaluators.employee_id', '=', 'employees.id')
            ->whereNull('evaluators.employee_id')
            ->select('employees.id', 'employees.full_name as employee_name', 'positions.name as position_name')
            ->orderBy('employee_name')
            ->get();
    }
}

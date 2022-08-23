<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Activity;
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
        // $data = PenilaiPegawai::join('employees', 'penilai_pegawais.employee_id', '=', 'employees.id') // penilai_pegawais join employees
        //     ->join('evaluators', 'penilai_pegawais.evaluator_id', '=', 'evaluators.id')                // penilai_pegawais join evaluators
        //     ->join('employees as penilai', 'evaluators.employee_id', '=', 'penilai.id')                // evaluators join employees
        //     ->join('positions', 'positions.id', '=', 'penilai.position_id')                            // employees  join positions
        //     ->select('penilai_pegawais.id', 'employees.full_name as employee_name', 'positions.name as evaluator_position', 'penilai.full_name as evaluator_name')
        //     ->orderBy('evaluator_name')
        //     ->get();

        
        // SYNTAX CMD
        // SELECT penilai_pegawais.id, activities.name FROM employees 
        //     JOIN penilai_pegawais ON penilai_pegawais.employee_id = employees.id 
        //     JOIN evaluators ON penilai_pegawais.evaluator_id = evaluators.id 
        //     JOIN positions ON positions.id = employees.position_id 
        //     JOIN ambil_kegiatans ON employees.id = ambil_kegiatans.employee_id 
        //     JOIN activities ON activities.id = ambil_kegiatans.activity_id

        $data = PenilaiPegawai::join('employees', 'penilai_pegawais.employee_id', '=', 'employees.id')
            ->join('evaluators',        'penilai_pegawais.evaluator_id', '=', 'evaluators.id')
            ->join('positions',         'employees.position_id',         '=', 'positions.id')            
            ->join('ambil_kegiatans',   'employees.id',                  '=', 'ambil_kegiatans.employee_id')            
            ->join('activities',        'activities.id',                 '=', 'ambil_kegiatans.activity_id')            
            ->join('employees as e',    'evaluators.employee_id',        '=', 'e.id')
            // Ambil Kegiatans dan Employee
            // ->select('penilai_pegawais.id', 'employees.full_name as employee_name', 'positions.name as evaluator_position', 'e.full_name as evaluator_name')
            ->select('penilai_pegawais.id', 'activities.name as kegiatan','employees.full_name as employee_name' , 'positions.name as evaluator_position', 'e.full_name as evaluator_name')
            ->orderBy('kegiatan')
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

         //mengambil seluruh data kegiatan
        $activities = $this->getActivies();

        // mengambil seluruh data pegawai yang bukan penilai
        // $employees = $this->getEmployees();
        $employees = $this->getEmployees();
        return view('pages.admin.struktur.add', compact('employees', 'evaluators', 'activities'));
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
            // cek apakah data yang diinputkan ada table activity
            'kegiatan' => 'required|exists:activities,id',

        ]);

        PenilaiPegawai::create([
            'employee_id' => $request->pegawai,
            'evaluator_id' => $request->penilai,
            'activity_id' => $request->kegiatan,
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

        //mengambil seluruh data kegiatan
        $activities = $this->getActivies();

        // mengambil seluruh data pegawai yang bukan penilai
        $employees = $this->getEmployees();
        $struktur = PenilaiPegawai::find($id);

        if ($struktur == null) {
            return redirect()->route('struktur.index')->with('error', 'Data tidak ditemukan');
        }

        return view('pages.admin.struktur.edit', compact('employees', 'evaluators', 'activities', 'struktur'));
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

            'kegiatan' => 'required|exists:activities,id',
        ]);
        $struktur = PenilaiPegawai::find($id);

        if ($struktur == null) {
            return redirect()->route('struktur.index')->with('error', 'Data tidak ditemukan');
        }

        $struktur->update([
            'employee_id' => $request->pegawai,
            'evaluator_id' => $request->penilai,
            'activity_id' => $request->kegiatan,
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

    private function getActivies() {
        return Activity::select('activities.name as nama_kegiatan')->get();


    }

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

<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\AmbilKegiatan;
use App\Models\Employee;
use Illuminate\Http\Request;

class KegiatanPegawaiController extends Controller
{
    public function index(Request $request)
    {
        $employee = Employee::where('user_id', auth()->user()->id)->first();

        $data = AmbilKegiatan::where('employee_id', $employee->id)
        ->join('activities', 'ambil_kegiatans.activity_id', 'activities.id')
        ->select('ambil_kegiatans.id','activities.name as activity_name', 'ambil_kegiatans.url_file as url_file')
        ->get();

        return view('pages.pegawai.kegiatan.index', compact('data'));
    }

    public function uploadFile(Request $request, $id)
    {
       $this->validate($request, [
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:2048',
        ]);
        
        $file = $request->file('file');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'file_kegiatan';
        $file->move($tujuan_upload,$nama_file);

        AmbilKegiatan::where('id', $id)->update([
            'url_file' => $nama_file
        ]);

        return redirect()->route('pegawai.kegiatan.index')->with('success', 'File berhasil diupload');
    }

     public function create()
    {
        $employees = Employee::join('positions', 'employees.position_id', '=', 'positions.id')
            ->select('employees.*', 'positions.name as position')
            ->get();
        return view('pages.pegawai.kegiatan.add', compact('employees'));
    }

     public function __invoke(Request $request)
    {
        $evaluator = Employee::where('user_id', auth()->user()->id)->first();

        $response = Nilai::join('ambil_kegiatans', 'ambil_kegiatans.id', 'nilais.ambil_kegiatan_id')
            ->join('activities', 'activities.id', 'ambil_kegiatans.activity_id')
            ->join('employees', 'employees.id', 'ambil_kegiatans.employee_id')
            ->join('penilai_pegawais', 'penilai_pegawais.employee_id', 'employees.id')
            ->join('evaluators', 'evaluators.id', 'penilai_pegawais.evaluator_id')
            ->join('employees as pengawas', 'pengawas.id', 'evaluators.employee_id')
            ->where('employees.id', $evaluator->id)
            ->select('pengawas.full_name as evaluator_name', 'employees.full_name', 'employees.nip', 'activities.name as activity_name', 'nilais.id', 'nilais.target_realisasi as target', 'nilais.kerjasama', 'nilais.ketepatan_waktu', 'nilais.kualitas')
            ->orderBy('full_name')
            ->get();

         // cek datanya ada atau tidak
        if (count($response) == 0) {
            return redirect()->back()->with('error', 'Gagal export PDF karena data kosong');
        }

}

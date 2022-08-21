<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\AmbilKegiatan;
use App\Models\Employee;
use App\Models\Nilai;
use App\Models\PenilaiPegawai;
use Illuminate\Http\Request;

class KegiatanPegawaiController extends Controller
{
    public function index(Request $request)
    {
        $employee = Employee::where('user_id', auth()->user()->id)->first();

        $data = AmbilKegiatan::where('employee_id', $employee->id)
            ->join('activities', 'ambil_kegiatans.activity_id', 'activities.id')
            ->select('ambil_kegiatans.*', 'activities.name as activity_name')
            ->get();

            $penilai = PenilaiPegawai::where('penilai_pegawais.employee_id', $employee->id)
            ->join('evaluators', 'evaluators.id', '=', 'penilai_pegawais.evaluator_id')
            ->join('employees as penilai', 'penilai.id', '=', 'evaluators.employee_id')
            ->select('penilai.full_name')
            ->first();
        return view('pages.pegawai.kegiatan.index', compact('data','penilai'));
    }

    public function uploadFile(Request $request, $id)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('file');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'file_kegiatan';
        $file->move($tujuan_upload, $nama_file);

        AmbilKegiatan::where('id', $id)->update([
            'url_file' => $nama_file
        ]);

        return redirect()->route('pegawai.kegiatan.index')->with('success', 'File berhasil diupload');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $activities = Activity::all();
        $pegawai = Employee::where('user_id', auth()->user()->id)->first();
        $activities = AmbilKegiatan::where('employee_id', $pegawai->id)
            ->join('activities', 'ambil_kegiatans.activity_id', 'activities.id')
            ->select('activities.id', 'activities.name')
            ->get();

        // kalo belum ada kegiatan
        if ($activities->count() == 0) {
            return redirect()->back()->with('error', 'Anda belum memiliki kegiatan');
        }

        $penilai = PenilaiPegawai::where('penilai_pegawais.employee_id', $pegawai->id)
            ->join('evaluators', 'evaluators.id', '=', 'penilai_pegawais.evaluator_id')
            ->join('employees as penilai', 'penilai.id', '=', 'evaluators.employee_id')
            ->select('penilai.id as id', 'penilai.full_name as name')
            ->first();

        return view('pages.pegawai.kegiatan.add', compact('activities', 'penilai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan' => 'required|exists:activities,id',
            'target' => 'required|integer|min:1|max:5',
            'realisasi' => 'required|integer|min:1|max:5',
            'mulai_kegiatan' => 'required|date',
            'selesai_kegiatan' => 'required|date',
        ]);

        // simpen ke database
        $pegawai = Employee::where('user_id', auth()->user()->id)->first();
        $kegiatan =  AmbilKegiatan::where('ambil_kegiatans.employee_id', $pegawai->id)
        ->where('activity_id', $request->kegiatan)
        ->first();

        // jika belum ada kegiatan
        if ($kegiatan == null) {
            return redirect()->back()->with('error', 'Kegiatan tidak ditemukan');
        }
        $kegiatan->target = $request->target;
        $kegiatan->realisasi = $request->realisasi;
        $kegiatan->mulai_kegiatan = $request->mulai_kegiatan;
        $kegiatan->selesai_kegiatan = $request->selesai_kegiatan;

        $kegiatan->save();
        return redirect()->route('pegawai.kegiatan.index')->with('success', 'Data berhasil disimpan');
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
}

<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\AmbilKegiatan;
use App\Models\Employee;
use App\Models\Nilai;
use App\Models\PenilaiPegawai;
use Illuminate\Http\Request;
use DB;

class KegiatanPegawaiController extends Controller
{
    public function index(Request $request)
    {
        $employee = Employee::where('user_id', auth()->user()->id)->first();

        // $data = AmbilKegiatan::where('employee_id', $employee->id)
        //     ->join('activities', 'ambil_kegiatans.activity_id', 'activities.id')
        //     ->select('ambil_kegiatans.*', 'activities.name as activity_name')
        //     ->get();

        // Ambil Penilai Secara Dinamis
        // $data = PenilaiPegawai::where('employees.id', $employee->id)
        // ->join('employees', 'penilai_pegawais.employee_id', '=', 'employees.id')
        // ->join('evaluators',        'penilai_pegawais.evaluator_id', '=', 'evaluators.id')
        // ->join('activities as act', 'penilai_pegawais.activity_id', '=', 'act.id')
        // ->join('positions',         'employees.position_id',         '=', 'positions.id')            
        // ->join('employees as e',    'evaluators.employee_id',        '=', 'e.id')
        // ->select('act.name as activity_name', 'e.full_name')
        // ->get();

        $data = AmbilKegiatan::where('employees.id', $employee->id)
            ->join('activities', 'ambil_kegiatans.activity_id', '=', 'activities.id')
            ->join('employees', 'employees.id', '=', 'ambil_kegiatans.employee_id')
            ->join('penilai_pegawais', 'penilai_pegawais.employee_id', '=','employees.id')
            ->join('evaluators', 'penilai_pegawais.evaluator_id', '=', 'evaluators.id')
            ->join('employees as e', 'evaluators.employee_id','=','e.id')
            ->distinct()
<<<<<<< HEAD
            ->select('ambil_kegiatans.id', 'activities.name as activity_name', 'ambil_kegiatans.nama_penilai as full_name', 'ambil_kegiatans.target', 'ambil_kegiatans.realisasi', 'ambil_kegiatans.target', 'ambil_kegiatans.mulai_kegiatan', 'ambil_kegiatans.selesai_kegiatan')
=======
            ->select('activities.name as activity_name', 'ambil_kegiatans.nama_penilai as full_name', 'ambil_kegiatans.target', 'ambil_kegiatans.realisasi', 'ambil_kegiatans.target', 'ambil_kegiatans.mulai_kegiatan', 'ambil_kegiatans.selesai_kegiatan')
>>>>>>> b0ba0ead89f38dc2e6c790a0867345eecf1a471e
            ->get();


        $penilai = PenilaiPegawai::where('penilai_pegawais.employee_id', $employee->id)
        ->join('evaluators', 'evaluators.id', '=', 'penilai_pegawais.evaluator_id')
        ->join('employees as penilai', 'penilai.id', '=', 'evaluators.employee_id')
        ->select('penilai.full_name')
        ->first();
        return view('pages.pegawai.kegiatan.index', compact('data'));
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
        // $activities = AmbilKegiatan::where('employee_id', $pegawai->id)
        //     ->join('activities', 'ambil_kegiatans.activity_id', 'activities.id')
        //     ->select('activities.id', 'activities.name')
        //     ->get();

        $activities = PenilaiPegawai::where('employees.id', $pegawai->user_id)
        ->join('employees', 'penilai_pegawais.employee_id', '=', 'employees.id')
        ->join('evaluators',        'penilai_pegawais.evaluator_id', '=', 'evaluators.id')
        ->join('activities', 'penilai_pegawais.activity_id', '=',          'activities.id')
        ->join('positions',         'employees.position_id',         '=', 'positions.id')            
        ->join('employees as e',    'evaluators.employee_id',        '=', 'e.id')
        ->select('activities.name', 'activities.id', 'e.full_name')
        ->get();

        // kalo belum ada kegiatan
        if ($activities->count() == 0) {
            return redirect()->back()->with('error', 'Anda belum memiliki kegiatan');
        }

        // $penilai = PenilaiPegawai::where('penilai_pegawais.employee_id', $pegawai->id)
        //     ->join('evaluators', 'evaluators.id', '=', 'penilai_pegawais.evaluator_id')
        //     ->join('employees as penilai', 'penilai.id', '=', 'evaluators.employee_id')
        //     ->select('penilai.id as id', 'penilai.full_name as name')
        //     ->first();

        $penilai = PenilaiPegawai::where('employees.id', $pegawai->user_id)
        ->join('employees', 'penilai_pegawais.employee_id', '=', 'employees.id')
        ->join('evaluators',        'penilai_pegawais.evaluator_id', '=', 'evaluators.id')
        ->join('activities', 'penilai_pegawais.activity_id', '=',          'activities.id')
        ->join('positions',         'employees.position_id',         '=', 'positions.id')            
        ->join('employees as penilai',    'evaluators.employee_id',        '=', 'penilai.id')
        ->select('penilai.id as id', 'penilai.full_name as name')    
        ->first();
<<<<<<< HEAD
=======

>>>>>>> b0ba0ead89f38dc2e6c790a0867345eecf1a471e

        return view('pages.pegawai.kegiatan.add', compact('activities', 'penilai'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Hapus Kegiatan
    
    public function destroy($id)
    {
        dd($id);
        $data = AmbilKegiatan::find($id);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        
=======
>>>>>>> b0ba0ead89f38dc2e6c790a0867345eecf1a471e
        // Ambil Inputan User
        $request->validate([
            'penilai' => 'required',
            'kegiatan' => 'required|exists:activities,id',
            'target' => 'required|integer|min:1|max:50',
            'realisasi' => 'required|integer|min:1|max:50',
            'mulai_kegiatan' => 'required|date',
            'selesai_kegiatan' => 'required|date',
        ]);

        // Ambil User ID 
        $pegawai = Employee::where('user_id', auth()->user()->id)->first();
<<<<<<< HEAD
        
=======
>>>>>>> b0ba0ead89f38dc2e6c790a0867345eecf1a471e

        // ORM
        // $kegiatan =  AmbilKegiatan::where('ambil_kegiatans.employee_id', $pegawai->id)
        // ->where('activity_id', $request->kegiatan)
        // ->first();

        // // jika belum ada kegiatan
        // if ($kegiatan == null) {
        //     return redirect()->back()->with('error', 'Kegiatan tidak ditemukan');
        // }
        // $kegiatan->target = $request->target;
        // $kegiatan->realisasi = $request->realisasi;
        // $kegiatan->mulai_kegiatan = $request->mulai_kegiatan;
        // $kegiatan->selesai_kegiatan = $request->selesai_kegiatan;

        // $kegiatan->save();
        // return redirect()->route('pegawai.kegiatan.index')->with('success', 'Data berhasil disimpan');


        // Query Builder
        // Query Untuk Cek apakah User dengan kegiatan yang sama sudah ada di database
        $act = DB::table('ambil_kegiatans')->where(['activity_id' => $request->kegiatan, 'employee_id' => $pegawai->user_id])->exists();
                      
        // Jika Kegiatannya Sudah ada,
        if($act == true) {
<<<<<<< HEAD
            // Ambil ID Collectionnya
            $ambil_kegiatan = DB::table('ambil_kegiatans')->where(['activity_id' => $request->kegiatan, 'employee_id' => $pegawai->user_id])->get()->first();
            DB::table('ambil_kegiatans')
                        ->where('id', $ambil_kegiatan->id)
                        ->update([
                            'target' => $request->target,
                            'realisasi' => $request->realisasi,
                            'mulai_kegiatan' => $request->mulai_kegiatan,
                            'selesai_kegiatan' => $request->selesai_kegiatan,
                        ]);
            // return redirect()->back()->with('error', 'Kegiatan Sudah Ada');
            return redirect()->route('pegawai.kegiatan.index')->with('success', 'Data berhasil Diupdate');
=======
            return redirect()->back()->with('error', 'Kegiatan Sudah Ada');
>>>>>>> b0ba0ead89f38dc2e6c790a0867345eecf1a471e
        } 
        // Jika Belum Ada Tambahkan Ke Database
        else {
            // Insert
            DB::table('ambil_kegiatans')->insert([
                'employee_id' => $pegawai->user_id,
                'activity_id' => $request->kegiatan,
                'nama_penilai' => $request->penilai,
                'target' => $request->target,
                'realisasi' => $request->realisasi,
                'mulai_kegiatan' => $request->mulai_kegiatan,
                'selesai_kegiatan' => $request->selesai_kegiatan,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return redirect()->route('pegawai.kegiatan.index')->with('success', 'Data berhasil disimpan');
        }
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



    // PDF
    // public function exportPdf()
    // {
    //     $response = Nilai::join('ambil_kegiatans', 'ambil_kegiatans.id', 'nilais.ambil_kegiatan_id')
    //         ->join('activities', 'activities.id', 'ambil_kegiatans.activity_id')
    //         ->join('employees', 'employees.id', 'ambil_kegiatans.employee_id')
    //         ->select('ambil_kegiatans.nama_penilai as evaluator_name','employees.full_name', 'employees.nip', 'activities.name as activity_name', 'nilais.id', 'nilais.target_realisasi as target', 'nilais.kerjasama', 'nilais.ketepatan_waktu', 'nilais.kualitas') 
    //         ->orderBy('full_name')
    //         ->get();

    //     // cek datanya ada atau tidak
    //     if (count($response) == 0) {
    //         return redirect()->back()->with('error', 'Gagal export PDF karena data kosong');
    //     }

    //     $data = [];
    //     foreach ($response as $key => $value) {
    //         if (count($data) == 0) {
    //             $data[]['employee_name'] = $value->full_name;
    //             $dataIndex = count($data) - 1;
    //             $data[$dataIndex]['nip'] = $value->nip;
    //             $data[$dataIndex]['evaluator_name'] = $value->evaluator_name;
    //             $data[$dataIndex]['activities'][]['activity_name'] = $value->activity_name;
    //             $kegiatanIndex = count($data[$dataIndex]['activities']) - 1;
    //             $data[$dataIndex]['activities'][$kegiatanIndex]['target'] = $value->target;
    //             $data[$dataIndex]['activities'][$kegiatanIndex]['kerjasama'] = $value->kerjasama;
    //             $data[$dataIndex]['activities'][$kegiatanIndex]['ketepatan_waktu'] = $value->ketepatan_waktu;
    //             $data[$dataIndex]['activities'][$kegiatanIndex]['kualitas'] = $value->kualitas;
    //         } else {
                
    //             if ($value->nip == $response[$key - 1]->nip) {
    //                 // Kode tambahan
    //                 // -----------------------------------------------------------
    //                 $data[$key - 1]['employee_name'] = $value->full_name;
    //                 $data[$key - 1]['nip'] = $value->nip;
    //                 $data[$key - 1]['evaluator_name'] = $value->evaluator_name;
    //                 // -----------------------------------------------------------
                    
    //                 $data[$key - 1]['activities'][]['activity_name'] = $value->activity_name;
    //                 $kegiatanIndex = count($data[$key - 1]['activities']) - 1;
    //                 $data[$key - 1]['activities'][$kegiatanIndex]['target'] = $value->target;
    //                 $data[$key - 1]['activities'][$kegiatanIndex]['kerjasama'] = $value->kerjasama;
    //                 $data[$key - 1]['activities'][$kegiatanIndex]['ketepatan_waktu'] = $value->ketepatan_waktu;
    //                 $data[$key - 1]['activities'][$kegiatanIndex]['kualitas'] = $value->kualitas;
    //             } else {
                    
    //                 $data[]['employee_name'] = $value->full_name;
    //                 $dataIndex = count($data) - 1;
    //                 $data[$dataIndex]['nip'] = $value->nip;
    //                 $data[$dataIndex]['evaluator_name'] = $value->evaluator_name;
    //                 $data[$dataIndex]['activities'][]['activity_name'] = $value->activity_name;
    //                 $kegiatanIndex = count($data[$dataIndex]['activities']) - 1;
    //                 $data[$dataIndex]['activities'][$kegiatanIndex]['target'] = $value->target;
    //                 $data[$dataIndex]['activities'][$kegiatanIndex]['kerjasama'] = $value->kerjasama;
    //                 $data[$dataIndex]['activities'][$kegiatanIndex]['ketepatan_waktu'] = $value->ketepatan_waktu;
    //                 $data[$dataIndex]['activities'][$kegiatanIndex]['kualitas'] = $value->kualitas;
    //             }
    //         }
    //     }

        

    //     $pdf = Pdf::loadView('pages.penilai.pegawai.pdf-template', compact('data'));
    //     return $pdf->stream('laporan-nilai-pegawai.pdf');
    // }



}

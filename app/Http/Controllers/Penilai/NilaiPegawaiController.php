<?php

namespace App\Http\Controllers\Penilai;

use App\Http\Controllers\Controller;
use App\Models\AmbilKegiatan;
use App\Models\Employee;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;

class NilaiPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluator = Employee::where('user_id', auth()->user()->id)->first();
        $pegawai = Employee::where('user_id', auth()->user()->id)->first();
        

        $data = Nilai::join('ambil_kegiatans', 'ambil_kegiatans.id', 'nilais.ambil_kegiatan_id')
            ->join('activities', 'activities.id', 'ambil_kegiatans.activity_id')
            ->join('employees', 'employees.id', 'ambil_kegiatans.employee_id')
            ->where('ambil_kegiatans.nama_penilai', $evaluator->full_name)
            ->select('ambil_Kegiatans.id as print_pdf', 'ambil_kegiatans.nama_penilai','employees.full_name', 'employees.id as employee_id', 'activities.name as activity_name','ambil_kegiatans.target as target_kegiatan','ambil_kegiatans.realisasi', 'ambil_kegiatans.mulai_kegiatan', 'ambil_kegiatans.selesai_kegiatan', 'nilais.id', 'nilais.target_realisasi as target', 'nilais.kerjasama', 'nilais.ketepatan_waktu', 'nilais.kualitas')
            ->get();
        return view('pages.penilai.pegawai.index', compact('data'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil ID / Nama Dari User yang sedang dibuka
        $pegawai = Employee::where('user_id', auth()->user()->id)->first();

        // CMD 
        // ----------
        // select activities.name, employees.full_name FROM activities JOIN
        // ambil_kegiatans ON activities.id = ambil_kegiatans.activity_id JOIN employees ON
        // employees.id = ambil_kegiatans.employee_id WHERE nama_penilai = 'penilai 1';

        $activities = AmbilKegiatan::where('nama_penilai', $pegawai->full_name)
                    ->join('activities', 'ambil_kegiatans.activity_id', 'activities.id')
                    ->join('employees', 'employees.id', 'ambil_kegiatans.employee_id')
                    ->select('ambil_kegiatans.id', 'activities.name', 'employees.full_name')
                    ->get();
            
        return view('pages.penilai.pegawai.add', compact('activities'));
    }


    public function store(Request $request)
    {
        // Ambil Inputan User
        $request->validate([
            'ambil_kegiatan_id' => 'required',
            'target_realisasi' => 'required',
            'kerjasama' => 'required',
            'ketepatan_waktu' => 'required',
            'kualitas' => 'required',
        ]);

        // Ambil User ID 
        $pegawai = Employee::where('user_id', auth()->user()->id)->first();


        // Query Builder
        // Query Untuk Cek apakah User dengan kegiatan yang sama sudah ada di database
        $act = DB::table('nilais')->where(['ambil_kegiatan_id' => $request->ambil_kegiatan_id])->exists();
        
                      
        // Jika Kegiatannya Sudah ada,
        if($act == true) {
            return redirect()->back()->with('error', 'Kegiatan Sudah Ada');
        } 

        // Jika Belum Ada Tambahkan Ke Database
        else {
            // Insert
            DB::table('nilais')->insert([
                'ambil_kegiatan_id' => $request->ambil_kegiatan_id,
                'target_realisasi'  => $request->target_realisasi,
                'kerjasama'         => $request->kerjasama,
                'ketepatan_waktu'   => $request->ketepatan_waktu,
                'kualitas'          => $request->kualitas,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return redirect()->route('nilai.index')->with('success', 'Data berhasil disimpan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function tambah() {
        return view('pages.penilai.pegawai.add');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'required|exists:nilais,id',
            'target' => 'required|integer|min:1|max:100',
            'kerjasama' => 'required|integer|min:1|max:100',
            'ketepatan_waktu' => 'required|integer|min:1|max:100',
            'kualitas' => 'required|integer|min:1|max:100',
            'target_kegiatan' => 'required|integer|min:1|max:50',
            'realisasi' => 'required|integer|min:1|max:50',
            'mulai_kegiatan' => 'required|date',
            'selesai_kegiatan' => 'required|date',
        ]);

        $nilai = Nilai::find($request->id);

        if ($nilai == null) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $kegiatan = AmbilKegiatan::find($nilai->ambil_kegiatan_id);

        if ($kegiatan == null) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        // update Kegiatan
        $kegiatan->target = $request->target_kegiatan;
        $kegiatan->realisasi = $request->realisasi;
        $kegiatan->mulai_kegiatan = $request->mulai_kegiatan;
        $kegiatan->selesai_kegiatan = $request->selesai_kegiatan;
        $kegiatan->save();
        
        // update nilai kegiatan
        $nilai->target_realisasi = $request->target;
        $nilai->kerjasama = $request->kerjasama;
        $nilai->ketepatan_waktu = $request->ketepatan_waktu;
        $nilai->kualitas = $request->kualitas;
        $nilai->save();

        return response()->json(['success' => 'Data berhasil disimpan']);;
    }

    public function exportPdf()
    {
        $evaluator = Employee::where('user_id', auth()->user()->id)->first();
        $response = Nilai::join('ambil_kegiatans', 'ambil_kegiatans.id', 'nilais.ambil_kegiatan_id')
            ->join('activities', 'activities.id', 'ambil_kegiatans.activity_id')
            ->join('employees', 'employees.id', 'ambil_kegiatans.employee_id')
            ->select('ambil_kegiatans.nama_penilai as evaluator_name','employees.full_name', 'employees.nip', 'activities.name as activity_name', 'nilais.id', 'nilais.target_realisasi as target', 'nilais.kerjasama', 'nilais.ketepatan_waktu', 'nilais.kualitas') 
            ->where('ambil_kegiatans.nama_penilai', $evaluator->full_name)
            ->orderBy('full_name')
            ->get();

        // cek datanya ada atau tidak
        if (count($response) == 0) {
            return redirect()->back()->with('error', 'Gagal export PDF karena data kosong');
        }

        $data = [];
        foreach ($response as $key => $value) {

            /**
             * Buat data seperti ini
             *   [
             *     'employee_name' =>
             *     'nip' =>
             *     'evaluator_name' =>
             *     'kegiatans' => [
             *                    [
             *                      'activity_name' =>
             *                      'target' =>
             *                      'kerjasama' =>
             *                      'ketepatan_waktu' =>
             *                      'kualitas' =>
             *                    ] 
             *   ] 
             */
            if (count($data) == 0) {
                $data[]['employee_name'] = $value->full_name;
                $dataIndex = count($data) - 1;
                $data[$dataIndex]['nip'] = $value->nip;
                $data[$dataIndex]['evaluator_name'] = $value->evaluator_name;
                $data[$dataIndex]['activities'][]['activity_name'] = $value->activity_name;
                $kegiatanIndex = count($data[$dataIndex]['activities']) - 1;
                $data[$dataIndex]['activities'][$kegiatanIndex]['penilai'] = $value->evaluator_name;
                $data[$dataIndex]['activities'][$kegiatanIndex]['target'] = $value->target;
                $data[$dataIndex]['activities'][$kegiatanIndex]['kerjasama'] = $value->kerjasama;
                $data[$dataIndex]['activities'][$kegiatanIndex]['ketepatan_waktu'] = $value->ketepatan_waktu;
                $data[$dataIndex]['activities'][$kegiatanIndex]['kualitas'] = $value->kualitas;
            } else {
                if ($value->nip == $response[$key - 1]->nip) {
                    $data[$key - 1]['activities'][]['activity_name'] = $value->activity_name;
                    $kegiatanIndex = count($data[$key - 1]['activities']) - 1;
                    $data[$key - 1]['activities'][$kegiatanIndex]['penilai'] = $value->evaluator_name;
                    $data[$key - 1]['activities'][$kegiatanIndex]['target'] = $value->target;
                    $data[$key - 1]['activities'][$kegiatanIndex]['kerjasama'] = $value->kerjasama;
                    $data[$key - 1]['activities'][$kegiatanIndex]['ketepatan_waktu'] = $value->ketepatan_waktu;
                    $data[$key - 1]['activities'][$kegiatanIndex]['kualitas'] = $value->kualitas;
                } else {
                    $data[]['employee_name'] = $value->full_name;
                    $dataIndex = count($data) - 1;
                    $data[$dataIndex]['nip'] = $value->nip;
                    $data[$dataIndex]['evaluator_name'] = $value->evaluator_name;
                    $data[$dataIndex]['activities'][]['activity_name'] = $value->activity_name;
                    $kegiatanIndex = count($data[$dataIndex]['activities']) - 1;
                    $data[$dataIndex]['activities'][$kegiatanIndex]['penilai'] = $value->evaluator_name;
                    $data[$dataIndex]['activities'][$kegiatanIndex]['target'] = $value->target;
                    $data[$dataIndex]['activities'][$kegiatanIndex]['kerjasama'] = $value->kerjasama;
                    $data[$dataIndex]['activities'][$kegiatanIndex]['ketepatan_waktu'] = $value->ketepatan_waktu;
                    $data[$dataIndex]['activities'][$kegiatanIndex]['kualitas'] = $value->kualitas;
                }
            }
        }

    

        $pdf = Pdf::loadView('pages.penilai.pegawai.pdf-template', compact('data'));
        return $pdf->stream('laporan-nilai-pegawai.pdf');
    }


    public function exportPdfEmployee(Request $request, $id)
    {
        // $evaluator = Employee::where('user_id', auth()->user()->id)->first();
        $response = Nilai::join('ambil_kegiatans', 'ambil_kegiatans.id', 'nilais.ambil_kegiatan_id')
            ->join('activities', 'activities.id', 'ambil_kegiatans.activity_id')
            ->join('employees', 'employees.id', 'ambil_kegiatans.employee_id')
            ->select('ambil_kegiatans.nama_penilai as evaluator_name','employees.full_name', 'employees.nip', 'activities.name as activity_name', 'nilais.id', 'nilais.target_realisasi as target', 'nilais.kerjasama', 'nilais.ketepatan_waktu', 'nilais.kualitas') 
            ->where('ambil_kegiatans.id', $id)
            ->orderBy('full_name')
            ->get();

        // cek datanya ada atau tidak
        if (count($response) == 0) {
            return redirect()->back()->with('error', 'Gagal export PDF karena data kosong');
        }

        $data = [];
        foreach ($response as $key => $value) {

            /**
             * Buat data seperti ini
             *   [
             *     'employee_name' =>
             *     'nip' =>
             *     'evaluator_name' =>
             *     'kegiatans' => [
             *                    [
             *                      'activity_name' =>
             *                      'target' =>
             *                      'kerjasama' =>
             *                      'ketepatan_waktu' =>
             *                      'kualitas' =>
             *                    ] 
             *   ] 
             */
            if (count($data) == 0) {
                $data[]['employee_name'] = $value->full_name;
                $dataIndex = count($data) - 1;
                $data[$dataIndex]['nip'] = $value->nip;
                $data[$dataIndex]['evaluator_name'] = $value->evaluator_name;
                $data[$dataIndex]['activities'][]['activity_name'] = $value->activity_name;
                $kegiatanIndex = count($data[$dataIndex]['activities']) - 1;
                $data[$dataIndex]['activities'][$kegiatanIndex]['penilai'] = $value->evaluator_name;
                $data[$dataIndex]['activities'][$kegiatanIndex]['target'] = $value->target;
                $data[$dataIndex]['activities'][$kegiatanIndex]['kerjasama'] = $value->kerjasama;
                $data[$dataIndex]['activities'][$kegiatanIndex]['ketepatan_waktu'] = $value->ketepatan_waktu;
                $data[$dataIndex]['activities'][$kegiatanIndex]['kualitas'] = $value->kualitas;
            } else {
                if ($value->nip == $response[$key - 1]->nip) {
                    $data[$key - 1]['activities'][]['activity_name'] = $value->activity_name;
                    $kegiatanIndex = count($data[$key - 1]['activities']) - 1;
                    $data[$key - 1]['activities'][$kegiatanIndex]['penilai'] = $value->evaluator_name;
                    $data[$key - 1]['activities'][$kegiatanIndex]['target'] = $value->target;
                    $data[$key - 1]['activities'][$kegiatanIndex]['kerjasama'] = $value->kerjasama;
                    $data[$key - 1]['activities'][$kegiatanIndex]['ketepatan_waktu'] = $value->ketepatan_waktu;
                    $data[$key - 1]['activities'][$kegiatanIndex]['kualitas'] = $value->kualitas;
                } else {
                    $data[]['employee_name'] = $value->full_name;
                    $dataIndex = count($data) - 1;
                    $data[$dataIndex]['nip'] = $value->nip;
                    $data[$dataIndex]['evaluator_name'] = $value->evaluator_name;
                    $data[$dataIndex]['activities'][]['activity_name'] = $value->activity_name;
                    $kegiatanIndex = count($data[$dataIndex]['activities']) - 1;
                    $data[$dataIndex]['activities'][$kegiatanIndex]['penilai'] = $value->evaluator_name;
                    $data[$dataIndex]['activities'][$kegiatanIndex]['target'] = $value->target;
                    $data[$dataIndex]['activities'][$kegiatanIndex]['kerjasama'] = $value->kerjasama;
                    $data[$dataIndex]['activities'][$kegiatanIndex]['ketepatan_waktu'] = $value->ketepatan_waktu;
                    $data[$dataIndex]['activities'][$kegiatanIndex]['kualitas'] = $value->kualitas;
                }
            }
        }

        $pdf = Pdf::loadView('pages.penilai.pegawai.pdf-template', compact('data'));
        return $pdf->stream('laporan-nilai-pegawai.pdf');
    }
}

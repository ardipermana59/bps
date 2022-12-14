<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Nilai;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanKegiatanPegawaiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $evaluator = Employee::where('user_id', auth()->user()->id)->first();

        $response = Nilai::join('ambil_kegiatans', 'ambil_kegiatans.id', 'nilais.ambil_kegiatan_id')
        ->join('activities', 'activities.id', 'ambil_kegiatans.activity_id')
        ->join('employees', 'employees.id', 'ambil_kegiatans.employee_id')
        ->select('ambil_kegiatans.nama_penilai as evaluator_name','employees.full_name', 'employees.nip', 'activities.name as activity_name', 'nilais.id', 'nilais.target_realisasi as target', 'nilais.kerjasama', 'nilais.ketepatan_waktu', 'nilais.kualitas') 
        ->where('employees.id', $evaluator->id)
        ->orderBy('full_name')
        ->get();

        // cek datanya ada atau tidak
        if (count($response) == 0) {
            return redirect()->back()->with('error', 'Gagal export PDF karena data kosong');
        }

        $data = [];
        foreach ($response as $key => $value) {
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
                    // Kode tambahan
                    // -----------------------------------------------------------
                    $data[$key - 1]['employee_name'] = $value->full_name;
                    $data[$key - 1]['nip'] = $value->nip;
                    $data[$key - 1]['evaluator_name'] = $value->evaluator_name;
                    // -----------------------------------------------------------
                    
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AmbilKegiatan;
use App\Models\Employee;
use App\Models\Nilai;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Nilai::join('ambil_kegiatans', 'ambil_kegiatans.id', 'nilais.ambil_kegiatan_id')
            ->join('activities', 'activities.id', 'ambil_kegiatans.activity_id')
            ->join('employees', 'employees.id', 'ambil_kegiatans.employee_id')
            ->select('ambil_kegiatans.id as print_id','ambil_kegiatans.nama_penilai','employees.full_name', 'employees.id as employee_id', 'activities.name as activity_name','ambil_kegiatans.target as target_kegiatan','ambil_kegiatans.realisasi', 'ambil_kegiatans.mulai_kegiatan', 'ambil_kegiatans.selesai_kegiatan', 'nilais.id', 'nilais.target_realisasi as target', 'nilais.kerjasama', 'nilais.ketepatan_waktu', 'nilais.kualitas')
            ->get();
        return view('pages.admin.laporan.index', compact('data'));
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
        
        $nilai->target_realisasi = $request->target;
        $nilai->kerjasama = $request->kerjasama;
        $nilai->ketepatan_waktu = $request->ketepatan_waktu;
        $nilai->kualitas = $request->kualitas;
        $nilai->save();

        return response()->json(['success' => 'Data berhasil disimpan']);;
    }

    public function exportPdf()
    {
        $response = Nilai::join('ambil_kegiatans', 'ambil_kegiatans.id', 'nilais.ambil_kegiatan_id')
            ->join('activities', 'activities.id', 'ambil_kegiatans.activity_id')
            ->join('employees', 'employees.id', 'ambil_kegiatans.employee_id')
            ->select('ambil_kegiatans.nama_penilai as evaluator_name','employees.full_name', 'employees.nip', 'activities.name as activity_name', 'nilais.id', 'nilais.target_realisasi as target', 'nilais.kerjasama', 'nilais.ketepatan_waktu', 'nilais.kualitas') 
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
                $data[$dataIndex]['activities'][$kegiatanIndex]['karyawan'] = $value->full_name;
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
                    $data[$key - 1]['activities'][$kegiatanIndex]['karyawan'] = $value->full_name;
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
                    $data[$dataIndex]['activities'][$kegiatanIndex]['karyawan'] = $value->full_name;
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
        
        // ambil_kegiatans.id
        $response = Nilai::join('ambil_kegiatans', 'ambil_kegiatans.id', 'nilais.ambil_kegiatan_id')
            ->join('activities', 'activities.id', 'ambil_kegiatans.activity_id')
            ->join('employees', 'employees.id', 'ambil_kegiatans.employee_id')
            ->where('ambil_kegiatans.id', '=', $id)
            ->select('ambil_kegiatans.nama_penilai as evaluator_name','employees.full_name', 'employees.nip', 'activities.name as activity_name', 'nilais.id', 'nilais.target_realisasi as target', 'nilais.kerjasama', 'nilais.ketepatan_waktu', 'nilais.kualitas') 
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Penilai;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

        $data = Nilai::join('ambil_kegiatans', 'ambil_kegiatans.id', 'nilais.ambil_kegiatan_id')
            ->join('activities', 'activities.id', 'ambil_kegiatans.activity_id')
            ->join('employees', 'employees.id', 'ambil_kegiatans.employee_id')
            ->join('penilai_pegawais', 'penilai_pegawais.employee_id', 'employees.id')
            ->join('evaluators', 'evaluators.id', 'penilai_pegawais.evaluator_id')
            ->join('employees as pengawas', 'pengawas.id', 'evaluators.employee_id')
            ->where('evaluators.employee_id', $evaluator->id)
            ->select('ambil_kegiatans.url_file','employees.full_name', 'employees.id as employee_id', 'activities.name as activity_name', 'nilais.id', 'nilais.target_realisasi as target', 'nilais.kerjasama', 'nilais.ketepatan_waktu', 'nilais.kualitas')
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
        return view('pages.penilai.pegawai.add');
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
            'id' => 'required|exists:nilais,id',
            'target' => 'required|integer|min:1|max:100',
            'kerjasama' => 'required|integer|min:1|max:100',
            'ketepatan_waktu' => 'required|integer|min:1|max:100',
            'kualitas' => 'required|integer|min:1|max:100',
        ]);

        $nilai = Nilai::find($request->id);

        if ($nilai == null) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

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
            ->join('penilai_pegawais', 'penilai_pegawais.employee_id', 'employees.id')
            ->join('evaluators', 'evaluators.id', 'penilai_pegawais.evaluator_id')
            ->join('employees as pengawas', 'pengawas.id', 'evaluators.employee_id')
            ->where('evaluators.employee_id', $evaluator->id)
            ->select('pengawas.full_name as evaluator_name', 'employees.full_name', 'employees.nip', 'activities.name as activity_name', 'nilais.id', 'nilais.target_realisasi as target', 'nilais.kerjasama', 'nilais.ketepatan_waktu', 'nilais.kualitas')
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
                $data[$dataIndex]['activities'][$kegiatanIndex]['target'] = $value->target;
                $data[$dataIndex]['activities'][$kegiatanIndex]['kerjasama'] = $value->kerjasama;
                $data[$dataIndex]['activities'][$kegiatanIndex]['ketepatan_waktu'] = $value->ketepatan_waktu;
                $data[$dataIndex]['activities'][$kegiatanIndex]['kualitas'] = $value->kualitas;
            } else {
                if ($value->nip == $response[$key - 1]->nip) {
                    $data[$key - 1]['activities'][]['activity_name'] = $value->activity_name;
                    $kegiatanIndex = count($data[$key - 1]['activities']) - 1;
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
        $evaluator = Employee::where('user_id', auth()->user()->id)->first();

        $response = Nilai::join('ambil_kegiatans', 'ambil_kegiatans.id', 'nilais.ambil_kegiatan_id')
            ->join('activities', 'activities.id', 'ambil_kegiatans.activity_id')
            ->join('employees', 'employees.id', 'ambil_kegiatans.employee_id')
            ->join('penilai_pegawais', 'penilai_pegawais.employee_id', 'employees.id')
            ->join('evaluators', 'evaluators.id', 'penilai_pegawais.evaluator_id')
            ->join('employees as pengawas', 'pengawas.id', 'evaluators.employee_id')
            ->where('evaluators.employee_id', $evaluator->id)
            ->where('employees.id', '=', $id)
            ->select('pengawas.full_name as evaluator_name', 'employees.full_name', 'employees.nip', 'activities.name as activity_name', 'nilais.id', 'nilais.target_realisasi as target', 'nilais.kerjasama', 'nilais.ketepatan_waktu', 'nilais.kualitas')
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
                $data[$dataIndex]['activities'][$kegiatanIndex]['target'] = $value->target;
                $data[$dataIndex]['activities'][$kegiatanIndex]['kerjasama'] = $value->kerjasama;
                $data[$dataIndex]['activities'][$kegiatanIndex]['ketepatan_waktu'] = $value->ketepatan_waktu;
                $data[$dataIndex]['activities'][$kegiatanIndex]['kualitas'] = $value->kualitas;
            } else {
                if ($value->nip == $response[$key - 1]->nip) {
                    $data[$key - 1]['activities'][]['activity_name'] = $value->activity_name;
                    $kegiatanIndex = count($data[$key - 1]['activities']) - 1;
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

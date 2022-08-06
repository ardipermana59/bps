<?php

namespace App\Http\Controllers\Penilai;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Evaluator;
use App\Models\PenilaiPegawai;
use Illuminate\Http\Request;

class NilaiPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluator = Evaluator::where('employee_id', auth()->user()->id)->first();

        $criterias = Criteria::orderBy('name')->get();

        $data = PenilaiPegawai::where('evaluator_id', $evaluator->id)
            ->join('employees', 'employees.id', 'penilai_pegawais.employee_id')
            ->join('ambil_kegiatans', 'employees.id', 'ambil_kegiatans.employee_id')
            ->join('activities', 'activities.id', 'ambil_kegiatans.activity_id')
            ->join('criterias', 'criterias.id', 'ambil_kegiatans.criteria_id')
            ->select('employees.full_name as employee',  'activities.name as activity_name', 'criterias.name as criteria_name', 'ambil_kegiatans.nilai')
            ->orderBy('employee')
            ->orderBy('activity_name')
            ->orderBy('criteria_name')
            ->get();

        /**
         * [
         *  'employee_name' =>
         *  'activity_name =>
         *  'criterias' => [
         *          [
         *              'criteria_name' => 'a'
         *              'nilai' => 90
         *          ]
         *   ]
         * ]
         * 
         */

        $temp = [];
        $activityTemp = [];
        $result = [];
        foreach ($data as $index => $item) {
            if (in_array($item->employee, $temp)) {
                // kalo name sudah didaftarkan

                // cek index nama terdaftar
                $i = array_search($item->employee, $temp);

                // cek kegiatanya sama atau tidak
                if (isset($result[$i]['activity_name'])) {
                    if ($result[$i]['activity_name'] == $item->activity_name) {
                        // kalo kegiatannya sama insert criterianya saja
                        $criteriaIndex = count($result[$i]['criterias']);
                        $result[$i]['criterias'][$criteriaIndex]['criteria_name'] = $item->criteria_name;
                        $result[$i]['criterias'][$criteriaIndex]['nilai'] = $item->nilai;
                    } else {
                        // kegiatannya beda. insert kegiatan baru dan kriteria
                        $result[$i]['activity_name'] = $item->activity_name;
                        $result[$i]['criterias'][0]['criteria_name'] = $item->criteria_name;
                        $result[$i]['criterias'][0]['nilai'] = $item->nilai;
                    }
                } else {
                }
            } else {
                // kalo name belum didaftarkan
                $temp[] = $item->employee;
                $tempIndex = count($temp) - 1;

                // buat name
                $result[$tempIndex]['employee_name'] = $item->employee;

                // buat activity_name
                $result[$tempIndex]['activity_name'] = $item->activity_name;

                // buat criteria pertama
                $result[$tempIndex]['criterias'][0]['criteria_name'] = $item->criteria_name;
                $result[$tempIndex]['criterias'][0]['nilai'] = $item->nilai;
            }
        }
        $data = $result;
        // dd($data);
        return view('pages.penilai.pegawai.index', compact('data', 'criterias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

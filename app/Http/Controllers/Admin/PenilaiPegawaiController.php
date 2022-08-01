<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        ->select('penilai_pegawais.id','employees.full_name as employee_name', 'positions.name as evaluator_position', 'penilai.full_name as evaluator_name')
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

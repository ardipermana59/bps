<?php

namespace App\Http\Controllers\Penilai;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
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
        $data = Nilai::join('ambil_kegiatans', 'ambil_kegiatans.id', 'nilais.ambil_kegiatan_id')
        ->join('activities', 'activities.id', 'ambil_kegiatans.activity_id')
        ->join('employees', 'employees.id', 'ambil_kegiatans.employee_id')
        ->select('employees.full_name', 'activities.name as activity_name' , 'nilais.id', 'nilais.target_realisasi as target', 'nilais.kerjasama', 'nilais.ketepatan_waktu', 'nilais.kualitas')
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
        $this->validate($request, [
            'id' => 'required|exists:nilais,id',
            'target' => 'required|integer|min:1|max:100',
            'kerjasama' => 'required|integer|min:1|max:100',
            'ketepatan_waktu' => 'required|integer|min:1|max:100',
            'kualitas' => 'required|integer|min:1|max:100',
        ]);
        
        $nilai = Nilai::find($request->id);

        if($nilai == null){
            return response()->json(['message'=>'Data tidak ditemukan'],404);
        }

        $nilai->target_realisasi = $request->target;
        $nilai->kerjasama = $request->kerjasama;
        $nilai->ketepatan_waktu = $request->ketepatan_waktu;
        $nilai->kualitas = $request->kualitas;
        $nilai->save();

        return response()->json(['success'=>'Data berhasil disimpan']);;
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

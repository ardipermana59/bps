<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use App\Models\criteria;
=======
use App\Models\Criteria;
>>>>>>> 6ad18d53b3bf00b67dc2e66fd154d335e9c295df
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $kriteria = criteria::all();
        return view('pages.criteria.index', compact('Kriteria'));
=======
        $criteria = Criteria::all();
        return view('pages.admin.criteria.index', compact('criteria'));
>>>>>>> 6ad18d53b3bf00b67dc2e66fd154d335e9c295df
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
        // cari kriteria berdasarkan id
        $criteria = Criteria::find($id);

        // cek kriteria ada tidak
        if($criteria == null){
            return redirect()->back()->with('error', 'Kriteria tidak ditemukan');
        }

        // hapus kriteria
        $criteria->delete();
        return redirect()->route('criteria.index')->with('success', 'Kriteria berhasil dihapus');
    }
}

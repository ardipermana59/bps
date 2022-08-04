<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
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
        $data = Criteria::all();
        return view('pages.admin.criteria.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.criteria.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $criteria = Criteria::create([
            'name' => $request->name,

        ]);

        return redirect()->route('criteria.index')->with('success', 'Data Kriteria Berhasil Ditambahkan');
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
        $data = Criteria::find($id);

        if ($data == null) {
            return redirect()->back()->with('error', 'Data Kriteria Tidak Ditemukan');
        }
        
        return view('pages.admin.criteria.edit', compact('data'));
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
            'name' => 'required|string|max:255',
        ]);

        $criteria = Criteria::find($id);

        if ($criteria == null) {
            return redirect()->back()->with('error', 'Data Kriteria Tidak Ditemukan');
        }

        $criteria->name = $request->name;
        $criteria->save();

        return redirect()->route('criteria.index')->with('success', 'Data Kriteria Berhasil Disimpan.');
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
        $kriteria = Criteria::find($id);

        // cek kriteria ada tidak
        if ($kriteria == null) {
            return redirect()->back()->with('error', 'Data Kriteria Tidak Ditemukan');
        }

        // // hapus user
        $kriteria->delete();
        return redirect()->route('criteria.index')->with('success', 'Data Kriteria Berhasil Dihapus');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Position::all();
        return view('pages.admin.position.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.position.add');
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

       $position = Position::create([
            'name' => $request->name,

        ]);
       
        return redirect()->route('position.index')->with('success', 'Data berhasil ditambahkan');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Position::find($id);
        return view('pages.admin.position.edit', compact('data'));
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

        $position = Position::find($id);

        if($position == null) {
            return redirect()->back()->with('error', 'Jabatan tidak ditemukan');
        }

        $position->name = $request->name;
        $position->save();
        
        return redirect()->route('position.index')->with('success', 'Jabatan berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // cari user berdasarkan id
        $jabatan = Position::find($id);

        // cek user ada tidak
        if($jabatan == null) {
            return redirect()->back()->with('error', 'jabatan tidak ditemukan');
        }

        // // hapus user
        $jabatan->delete();
        return redirect()->route('position.index')->with('success', 'Jabatan berhasil dihapus');
    }
}

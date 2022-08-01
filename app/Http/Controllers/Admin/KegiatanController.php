<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Activity::all();
        return view('pages.admin.activity.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.activity.add');
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

       $activity = Activity::create([
            'name' => $request->name,

        ]);
       
        return redirect()->route('activity.index')->with('success', 'Data berhasil ditambahkan');
        
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
       $data = Activity::find($id);
        return view('pages.admin.activity.edit', compact('data'));
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

        $activity = Activity::find($id);

        if($activity == null) {
            return redirect()->back()->with('error', 'kegiatan tidak ditemukan');
        }

        $activity->name = $request->name;
        $activity->save();
        
        return redirect()->route('activity.index')->with('success', 'Kegiatan berhasil disimpan.');
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
        $kegiatan = Activity::find($id);

        // cek user ada tidak
        if($kegiatan == null) {
            return redirect()->back()->with('error', 'kegiatan tidak ditemukan');
        }

        // // hapus user
        $kegiatan->delete();
        return redirect()->route('activity.index')->with('success', 'kegiatan berhasil dihapus');
    }
}

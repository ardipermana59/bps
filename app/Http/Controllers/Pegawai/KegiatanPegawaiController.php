<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\AmbilKegiatan;
use App\Models\Employee;
use Illuminate\Http\Request;

class KegiatanPegawaiController extends Controller
{
    public function index(Request $request)
    {
        $employee = Employee::where('user_id', auth()->user()->id)->first();

        $data = AmbilKegiatan::where('employee_id', $employee->id)
        ->join('activities', 'ambil_kegiatans.activity_id', 'activities.id')
        ->select('ambil_kegiatans.id','activities.name as activity_name', 'ambil_kegiatans.url_file as url_file')
        ->get();

        return view('pages.pegawai.kegiatan.index', compact('data'));
    }

    public function uploadFile(Request $request, $id)
    {
       $this->validate($request, [
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:2048',
        ]);
        
        $file = $request->file('file');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'file_kegiatan';
        $file->move($tujuan_upload,$nama_file);

        AmbilKegiatan::where('id', $id)->update([
            'url_file' => $nama_file
        ]);

        return redirect()->route('pegawai.kegiatan.index')->with('success', 'File berhasil diupload');
    }

}

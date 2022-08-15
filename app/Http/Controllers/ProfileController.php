<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class profileController extends Controller
{

    public function index()
    {
        $data = Employee::where('user_id', auth()->user()->id)->first();
        return view('pages.settings.profile', compact('data'));
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
        $this->validator($request->all())->validate();

        // cari user didatabase
        $user = User::find(auth()->user()->id);
        if($user == null){
            return redirect()->back()->with('error', 'User Tidak Ditemukan');
        }
        
        // update data user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // cari data pegawai
        $employee = Employee::where('user_id', auth()->user()->id)->first();

        if($employee == null){
            return redirect()->back()->with('error', 'Pegawai Tidak Ditemukan');
        }

        $employee->full_name = $request->name;
        $employee->gender = $request->gender;
        $employee->hp = $request->hp;
        $employee->address = $request->address;
        $employee->save();
        return redirect()->route('profile.index')->with('success', 'Profile berhasil diubah');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'hp' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'gender' => ['required', 'string','in:Laki-laki,Perempuan'],
            'email' => ['required', 'email'],
        ]);
    }
}

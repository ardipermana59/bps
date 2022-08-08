<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{

    public function index()
    {
        return view('pages.settings.password');
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

        // cari user di database
        $user =  User::find(auth()->user()->id);

        // cek user ada atau tidak
        if ($user == null) {
            return redirect()->back()->with('error', 'User Tidak Ditemukan');
        }

        // update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('password.index')->with('success', 'Password berhasil diubah');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}

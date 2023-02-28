<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ], [
            'username.required'=>"Username Wajib Diisi",
            'password.required'=>"Password Wajib Diisi"
        ]);

        if(Auth::attempt(['username' => $request->username,'password'=> $request->password, 'level'=>'admin'])){
            return redirect('admin');

    }   else if(Auth::attempt(['username' => $request->username,'password'=> $request->password, 'level'=>'masyarakat'])){
            return redirect('masyarakat');
    }
       else if(Auth::attempt(['username' => $request->username,'password'=> $request->password, 'level'=>'petugas'])){
            return redirect('petugas');
    }
    else{
        return redirect('/')->with(['message'=>'Username dan Password Salah']);
    }
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}

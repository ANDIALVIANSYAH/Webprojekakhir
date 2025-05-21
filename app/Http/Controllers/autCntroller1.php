<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class autCntroller1 extends Controller
{
    public function login(){
        return view('autentifikasi.login');
    }

     public function register(){
        return view('autentifikasi.register');
    }

    public function submitregistrasi(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email =$request->email;
        $user->role = $request->role;
        $user->password =  Hash::make(($request->password));
        $user->save();
        return redirect()->route('login');
    }

    public function submitlogin(Request $request){
        $user = new User();
        $user->email =$request->email; 
        $user->password =  Hash::make(($request->password));

        if(Auth::attempt($user)){
            $role = Auth::user()->role;
            if($role == 'admin'){
                return redirect()->route('admin');

            }else if($role == 'recepcionis'){
                return redirect()->route('recepcionis');
            }else{
                return redirect()->route('costumer');
            }
        }
    }
}

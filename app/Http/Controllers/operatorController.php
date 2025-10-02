<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\antreans;
use App\Models\operators;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class operatorController extends Controller
{
    public function dashboard()
    {
        $data = antreans::latest()->get();
        return view('dashboard', compact('data'));
    }

    public function listOperator() {
        $data = operators::latest()->get();
        return view('listOperator', compact('data'));
    }

    public function createOperator() {
        return view('createOperator');
    }

    public function loginView() {
        if(Auth::check()){
            return redirect('/dashboard');
        }else{
            return view('login');
        }
    }

    public function storeOperator(Request $request){
        $request->validate([
            'namaOperator' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $password = Hash::make($request->input('password'));

        operators::create([
            'namaOperator' => $request->namaOperator,
            'email' => $request->email,
            'password' => $password
        ]);
        return redirect('/listOperator');
    }

    public function login(Request $request) {
        $data = array(
            'email' => $request->input('email'),
            'password' => $request->input('password')
        );

        if(Auth::attempt($data)) {
            return redirect('/dashboard');
        }else{
            Session::flash('error', 'Email atau Password salah');
            return redirect('/');
        }
    }

    public function actionLogout() {
        Auth::logout();
        return redirect('/');
    }
}

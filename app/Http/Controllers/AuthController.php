<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLogin()
    {
        $listCats = DB::table('categories')
                    ->where('status', 1)
                    ->get();
        return view('client.login', ['listCats' => $listCats,]);
    }

    public function getRegister()
    {
        $listCats = DB::table('categories')
                    ->where('status', 1)
                    ->get();
        return view('client.register', ['listCats' => $listCats,]);
    }

    public function postLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        
        
        if (Auth::attempt(['email' => $email, 'password' => $password, 'role' => 0])) {
            return redirect()->route('home');
        } elseif (Auth::attempt(['email' => $email, 'password' => $password, 'role' => 1])) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->back()->with('thatbai', 'Tài khoản hoặc mật khẩu không đúng');
        }

        
        
    }

    public function postLogout() {
        Auth::logout();
        return redirect()->route('home');
    }
}

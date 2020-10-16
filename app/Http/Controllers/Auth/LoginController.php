<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function postLogin(Request $request)
    // {
    //     $credentials = $request->only('account', 'password');

    //     if (Auth::attempt($credentials)) {
            
    //         $role = Auth::user()->role;
    
    //         if($role == 1){
    //             return redirect()->route('admin.home');
    //         }
    //         else{
    //             return redirect()->route('home');
    //         }
    //     }
    //     else{
    //         return redirect()->back()->with('thatbai', 'Tài khoản hoặc mật khẩu không đúng');
    //     }
    // }

    // public function logout()
    // {
    //     Auth::logout();
    //     return redirect()->route('home');
    // }
}

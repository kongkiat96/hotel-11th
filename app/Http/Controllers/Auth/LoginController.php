<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

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

    public function login(HttpRequest $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'emp_code';

        $credentials = [
            $fieldType => $request->username,
            'password' => $request->password,
        ];

        // ตรวจสอบการ Login
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // ดึงข้อมูลผู้ใช้ที่เข้าสู่ระบบ

            // ตรวจสอบ status_login
            if ($user->status_login !== 1) {
                Auth::logout(); // Logout ผู้ใช้ทันที
                return redirect('login')->with('error', 'บัญชีของคุณถูกระงับการใช้งาน กรุณาติดต่อผู้ดูแลระบบ');
            }

            return redirect('home'); // หากทุกอย่างปกติ ให้ไปที่หน้า Home
        } else {
            return redirect('login')->with('error', 'ไม่พบผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง !');
        }
    }
}

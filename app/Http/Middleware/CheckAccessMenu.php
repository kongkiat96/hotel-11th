<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccessMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $subLink = $request->path();

        // ดึงสิทธิ์การเข้าถึงเมนูของผู้ใช้จากฐานข้อมูล
        // $accessMenus = $user->accessMenus()->pluck('menu_sub_ID')->toArray();

        // ตรวจสอบว่าผู้ใช้มีสิทธิ์เข้าถึงเมนูย่อยนี้หรือไม่
        // if (!in_array($subLink, $accessMenus)) {
        //     return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนูนี้');
        // }

        return $next($request);
    }
}

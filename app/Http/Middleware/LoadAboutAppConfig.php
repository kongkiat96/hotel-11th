<?php

namespace App\Http\Middleware;

use App\Models\Employee\EmployeeModel;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class LoadAboutAppConfig
{
    protected $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
        if (Auth::check()) {
            $getDataEmployee = $this->employeeModel->getDataEmployee(Auth::user()->map_employee);
            Config::set([
                'aboutEmployee.getAll' => $getDataEmployee,
            ]);
        }

        return $next($request);
    }
}

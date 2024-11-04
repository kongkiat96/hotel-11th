<?php

namespace App\Http\Controllers;

use App\Helpers\CalculateDateHelper;
use App\Models\Employee\EmployeeModel;
use App\Models\Master\getDataMasterModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    private $employeeModel;
    private $masterModel;
    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
        $this->masterModel = new getDataMasterModel;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $url = request()->segments();
        $urlName = "ข้อมูลผู้ใช้งาน";
        $accessMenuSubIDs = $user->accessMenus->pluck('menu_sub_ID')->toArray();
        $getAccessMenus = getDataMasterModel::getMenusName($accessMenuSubIDs);
        // dd(Auth::user()->map_employee);
        $prefixName     = $this->masterModel->getDataPrefixName();
        $provinceName   = $this->masterModel->getDataProvince();
        $getCompany     = $this->masterModel->getDataCompany();
        $getClassList   = $this->masterModel->getClassList();
        $getDataEmployee = $this->employeeModel->getDataEmployee(Auth::user()->map_employee);
        $getDepartment  = $this->masterModel->getDataCompanyForID($getDataEmployee->department_id);
        // dd($getDepartment);
        $getCalWorking = CalculateDateHelper::convertDateAndCalculateServicePeriod($getDataEmployee->date_start_work);
        // dd($getCalWorking);
        return view('app.home.index',[
            'name'      => $user->name,
            'urlName'   => $urlName,
            'url'       => $url,
            'dataEmployee'      => $getDataEmployee,
            'listMenus'         => $getAccessMenus,
            'getCalWorking'     => $getCalWorking,
            'aboutDepartment'   => $getDepartment
        ]);
    }
}

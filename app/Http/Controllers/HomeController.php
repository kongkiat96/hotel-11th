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
        $getDataEmployee = $this->employeeModel->getDataEmployee(Auth::user()->map_employee);
        // dd($getDataEmployee);
        $getDepartment  = $this->masterModel->getDataCompanyForID($getDataEmployee->department_id);
        // $dataManager = response()->json($this->testManager());
        $prefixName     = $this->masterModel->getDataPrefixName();
        $provinceName   = $this->masterModel->getDataProvince();
        $getMapAmphoe = $this->masterModel->getDataAmphoe($getDataEmployee->province_code);
        $getMapTambon = $this->masterModel->getDataTambon($getDataEmployee->amphoe_code);
        $getCalWorking = CalculateDateHelper::convertDateAndCalculateServicePeriod($getDataEmployee->date_start_work);
        return view('app.home.index',[
            'name'      => $user->name,
            'urlName'   => $urlName,
            'url'       => $url,
            'dataPrefixName'    => $prefixName,
            'dataEmployee'      => $getDataEmployee,
            'provinceName'      => $provinceName,
            'getMapAmphoe'      => $getMapAmphoe,
            'getMapTambon'      => $getMapTambon,
            'aboutDepartment'   => $getDepartment,
            'listMenus'         => $getAccessMenus,
            'getCalWorking'     => $getCalWorking,
        ]);
    }

    public function myProfile()
    {
        $user = Auth::user();
        $url = request()->segments();
        $urlName = "ข้อมูลส่วนตัว";
        $accessMenuSubIDs = $user->accessMenus->pluck('menu_sub_ID')->toArray();
        $getAccessMenus = getDataMasterModel::getMenusName($accessMenuSubIDs);
        $getDataEmployee = $this->employeeModel->getDataEmployee(Auth::user()->map_employee);
        // dd($getDataEmployee);
        $getDepartment  = $this->masterModel->getDataCompanyForID($getDataEmployee->department_id);
        // $dataManager = response()->json($this->testManager());
        $prefixName     = $this->masterModel->getDataPrefixName();
        $provinceName   = $this->masterModel->getDataProvince();
        $getMapAmphoe = $this->masterModel->getDataAmphoe($getDataEmployee->province_code);
        $getMapTambon = $this->masterModel->getDataTambon($getDataEmployee->amphoe_code);
        $getCalWorking = CalculateDateHelper::convertDateAndCalculateServicePeriod($getDataEmployee->date_start_work);

        return view('app.home.myProfile', [
            'name'      => $user->name,
            'urlName'   => $urlName,
            'url'       => $url,
            'dataPrefixName'    => $prefixName,
            'dataEmployee'      => $getDataEmployee,
            'provinceName'      => $provinceName,
            'getMapAmphoe'      => $getMapAmphoe,
            'getMapTambon'      => $getMapTambon,
            'aboutDepartment'   => $getDepartment,
            'listMenus'         => $getAccessMenus,
            'getCalWorking'     => $getCalWorking,
        ]);
    }

    public function changePassword(Request $request)
    {
        $savePassword = $this->employeeModel->changePassword($request->input());
        return response()->json(['status' => $savePassword['status'], 'message' => $savePassword['message']]);
    }
}

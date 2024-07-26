<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\EmployeeModel;
use App\Models\Master\getDataMasterModel;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $masterModel;
    private $employeeModel;

    public function __construct()
    {
        $this->masterModel = new getDataMasterModel;
        $this->employeeModel = new EmployeeModel;
    }
    public function getAllEmployee()
    {
        $url        = request()->segments();
        $urlName    = "ข้อมูลพนักงาน";
        $urlSubLink = "list-all-employee";

        return view('app.employee.getAllEmployee', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
        ]);
    }

    public function showDataEmployeeCurrent(Request $request)
    {
        $getDataToTable = $this->employeeModel->getDataEmployeeCurrent($request);
        // dd($getDataToTable);
        return response()->json($getDataToTable);
    }

    public function showDataEmployeeDisable(Request $request)
    {
        $getDataToTable = $this->employeeModel->getDataEmployeeDisable($request);
        // dd($getDataToTable);
        return response()->json($getDataToTable);
    }

    public function addEmployee()
    {
        $url        = request()->segments();
        $urlName    = "เพิ่มข้อมูลพนักงาน";
        $urlSubLink = "add-employee";

        $prefixName     = $this->masterModel->getDataPrefixName();
        $provinceName   = $this->masterModel->getDataProvince();
        $getCompany     = $this->masterModel->getDataCompany();
        $getClassList   = $this->masterModel->getClassList();
        // dd($provinceName);

        return view('app.employee.add-employee.addEmployee', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'dataPrefixName'    => $prefixName,
            'provinceName'      => $provinceName,
            'dataCompany'       => $getCompany,
            'dataClassList'     => $getClassList
        ]);
    }
    public function saveEmployee(Request $request)
    {
        // dd($request->input());
        $saveData = $this->employeeModel->saveEmployee($request->input());
        // dd($saveData);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function showEditEmployee($employeeID)
    {
        $url        = request()->segments();
        $urlName    = "แก้ไขข้อมูลพนักงาน";

        $prefixName     = $this->masterModel->getDataPrefixName();
        $provinceName   = $this->masterModel->getDataProvince();
        $getCompany     = $this->masterModel->getDataCompany();
        $getClassList   = $this->masterModel->getClassList();
        $getDataEmployee = $this->employeeModel->getDataEmployee($employeeID);
        $getDepartment  = $this->masterModel->getDataDepartmentForID($getDataEmployee->company_id);
        $getGroup       = $this->masterModel->getDataGroupOfDepartment($getDataEmployee->department_id);
        $getMapAmphoe = $this->masterModel->getDataAmphoe($getDataEmployee->province_code);
        $getMapTambon = $this->masterModel->getDataTambon($getDataEmployee->amphoe_code);
        // dd($getDataEmployee);


        return view('app.employee.edit-employee.editEmployee', [
            'url'           => $url,
            'urlName'       => $urlName,
            'dataPrefixName'    => $prefixName,
            'provinceName'      => $provinceName,
            'dataCompany'       => $getCompany,
            'dataClassList'     => $getClassList,
            'getDepartment'     => $getDepartment,
            'getGroup'          => $getGroup,
            'getMapAmphoe'      => $getMapAmphoe,
            'getMapTambon'      => $getMapTambon,
            'dataEmployee'      => $getDataEmployee
        ]);
    }

    public function editEmployee($employeeID, Request $request)
    {
        try {
            // dd($request->input());

            $request->merge(['mapIDGroup' => $request->input()['groupOfDepartment']]);

            if (empty($request->input()['baseimg'])) {
                $request->merge(['baseimg' => $request->input()['log_img']]);
            }
            $getIDProvice = $this->masterModel->getProvinceID($request->input()['tambon']);
            if (COUNT($getIDProvice) == 0) {
                $request->merge(['mapIDProvince' => $request->input()['mapIDProvince']]);
            } else {
                $request->merge(['mapIDProvince' => strval($getIDProvice[0]->id)]);
            }

            $editData = $this->employeeModel->editEmployee($employeeID, $request->input());
            return response()->json(['status' => $editData['status'], 'message' => $editData['message']]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function deleteEmployee($employeeID)
    {
        $deleteData = $this->employeeModel->deleteEmployee($employeeID);
        return response()->json(['status' => $deleteData['status'], 'message' => $deleteData['message']]);
    }

    public function searchEmployee(){
        $url        = request()->segments();
        $urlName    = "ค้นหาข้อมูลพนักงาน";
        $urlSubLink = "search-all-employee";

        return view('app.employee.searchAllEmployee',[
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink
        ]);
    }
}

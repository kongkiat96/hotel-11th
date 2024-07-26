<?php

namespace App\Models\Employee;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeModel extends Model
{
    use HasFactory;

    private $getDatabase;

    public function __construct()
    {
        $this->getDatabase = DB::connection('mysql');
    }

    public function getDataEmployeeCurrent($request)
    {
        try {

            $query = $this->getDatabase->table('tbt_employee')
                ->leftJoin('tbm_group', 'tbt_employee.map_company', '=', 'tbm_group.ID')
                ->leftJoin('tbm_department', 'tbm_group.department_id', '=', 'tbm_department.ID')
                ->leftJoin('tbm_company', 'tbm_department.company_id', '=', 'tbm_company.ID')
                ->leftJoin('tbm_class_list', 'tbt_employee.position_class', '=', 'tbm_class_list.ID')
                ->leftJoin('tbm_prefix_name', 'tbt_employee.prefix_id', '=', 'tbm_prefix_name.ID')
                ->leftJoin('tbm_province', 'tbt_employee.map_province', '=', 'tbm_province.ID')
                ->where('tbt_employee.deleted', 0)
                ->where('tbt_employee.status_login', 1)
                ->select(
                    'tbt_employee.ID',
                    'tbt_employee.employee_code',
                    'tbt_employee.email',
                    DB::raw('CONCAT(tbm_prefix_name.prefix_name, " ", tbt_employee.first_name, " ", tbt_employee.last_name) AS full_name'),
                    'tbm_class_list.class_name',
                    'tbt_employee.position_name',
                    'tbm_company.company_name_th',
                    'tbm_department.department_name',
                    'tbm_group.group_name',
                    'tbt_employee.user_class',
                    'status_login'
                );


            // คำสั่งเรียงลำดับ (Sorting)
            $columns = ['ID', 'employee_code', 'email', 'full_name', 'class_name', 'position_name', 'company_name_th', 'department_name', 'group_name', 'user_class'];
            $orderColumn = $columns[$request->input('order.0.column')];
            $orderDirection = $request->input('order.0.dir');
            $query->orderBy($orderColumn, $orderDirection);

            // คำสั่งค้นหา (Searching)
            $searchValue = $request->input('search.value');
            if (!empty($searchValue)) {
                $query->where(function ($query) use ($columns, $searchValue) {
                    foreach ($columns as $column) {
                        $query->orWhere('employee_code', 'like', '%' . $searchValue . '%');
                        $query->orWhere('email', 'like', '%' . $searchValue . '%');
                        // $query->orWhere('full_name', 'like', '%' . $searchValue . '%');
                        $query->orWhere(DB::raw('CONCAT(tbm_prefix_name.prefix_name, " ", tbt_employee.first_name, " ", tbt_employee.last_name)'), 'like', '%' . $searchValue . '%');
                        $query->orWhere('class_name', 'like', '%' . $searchValue . '%');
                        $query->orWhere('position_name', 'like', '%' . $searchValue . '%');
                        $query->orWhere('company_name_th', 'like', '%' . $searchValue . '%');
                        $query->orWhere('department_name', 'like', '%' . $searchValue . '%');
                        $query->orWhere('group_name', 'like', '%' . $searchValue . '%');
                        $query->orWhere('user_class', 'like', '%' . $searchValue . '%');
                    }
                });
            }

            $recordsTotal = $query->count();
            // รับค่าที่ส่งมาจาก DataTables
            $start = $request->input('start');
            $length = $request->input('length');

            $data = $query->offset($start)
                ->limit($length)
                ->get();

            $output = [
                'draw' => $request->input('draw'),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsTotal, // หรือจำนวนรายการที่ผ่านการค้นหา
                'data' => $data,
            ];
            // dd($output);
            return $output;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function getDataEmployeeDisable($request)
    {
        try {

            $query = $this->getDatabase->table('tbt_employee')
                ->leftJoin('tbm_group', 'tbt_employee.map_company', '=', 'tbm_group.ID')
                ->leftJoin('tbm_department', 'tbm_group.department_id', '=', 'tbm_department.ID')
                ->leftJoin('tbm_company', 'tbm_department.company_id', '=', 'tbm_company.ID')
                ->leftJoin('tbm_class_list', 'tbt_employee.position_class', '=', 'tbm_class_list.ID')
                ->leftJoin('tbm_prefix_name', 'tbt_employee.prefix_id', '=', 'tbm_prefix_name.ID')
                ->leftJoin('tbm_province', 'tbt_employee.map_province', '=', 'tbm_province.ID')
                ->where('tbt_employee.deleted', 0)
                ->where('tbt_employee.status_login', 0)
                ->select(
                    'tbt_employee.ID',
                    'tbt_employee.employee_code',
                    'tbt_employee.email',
                    DB::raw('CONCAT(tbm_prefix_name.prefix_name, " ", tbt_employee.first_name, " ", tbt_employee.last_name) AS full_name'),
                    'tbm_class_list.class_name',
                    'tbt_employee.position_name',
                    'tbm_company.company_name_th',
                    'tbm_department.department_name',
                    'tbm_group.group_name',
                    'tbt_employee.user_class',
                    'status_login'
                );


            // คำสั่งเรียงลำดับ (Sorting)
            $columns = ['ID', 'employee_code', 'email', 'full_name', 'class_name', 'position_name', 'company_name_th', 'department_name', 'group_name', 'user_class'];
            $orderColumn = $columns[$request->input('order.0.column')];
            $orderDirection = $request->input('order.0.dir');
            $query->orderBy($orderColumn, $orderDirection);

            // คำสั่งค้นหา (Searching)
            $searchValue = $request->input('search.value');
            if (!empty($searchValue)) {
                $query->where(function ($query) use ($columns, $searchValue) {
                    foreach ($columns as $column) {
                        $query->orWhere('employee_code', 'like', '%' . $searchValue . '%');
                        $query->orWhere('email', 'like', '%' . $searchValue . '%');
                        // $query->orWhere('full_name', 'like', '%' . $searchValue . '%');
                        $query->orWhere(DB::raw('CONCAT(tbm_prefix_name.prefix_name, " ", tbt_employee.first_name, " ", tbt_employee.last_name)'), 'like', '%' . $searchValue . '%');
                        $query->orWhere('class_name', 'like', '%' . $searchValue . '%');
                        $query->orWhere('position_name', 'like', '%' . $searchValue . '%');
                        $query->orWhere('company_name_th', 'like', '%' . $searchValue . '%');
                        $query->orWhere('department_name', 'like', '%' . $searchValue . '%');
                        $query->orWhere('group_name', 'like', '%' . $searchValue . '%');
                        $query->orWhere('user_class', 'like', '%' . $searchValue . '%');
                    }
                });
            }

            $recordsTotal = $query->count();
            // รับค่าที่ส่งมาจาก DataTables
            $start = $request->input('start');
            $length = $request->input('length');

            $data = $query->offset($start)
                ->limit($length)
                ->get();

            $output = [
                'draw' => $request->input('draw'),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsTotal, // หรือจำนวนรายการที่ผ่านการค้นหา
                'data' => $data,
            ];
            // dd($output);
            return $output;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function saveEmployee($getData)
    {
        try {
            // dd($getData);
            $saveEmpGetID = $this->getDatabase->table('tbt_employee')->insertGetId([
                'employee_code' => $getData['employee_code'],
                'company_id'        => $getData['company'],
                'department_id'     => $getData['department'],
                'group_department_id'   => $getData['groupOfDepartment'],
                'map_company'       => $getData['mapIDGroup'],
                'position_class'    => $getData['positionClass'],
                'position_name'     => $getData['positionName'],
                'date_start_work'   => $getData['dateStart'],
                'date_end_work'     => $getData['dateEnd'],
                'user_class'        => $getData['userClass'],
                'status_login'      => $getData['statusLogin'],
                'prefix_id'         => $getData['prefixName'],
                'first_name'        => $getData['firstName'],
                'last_name'         => $getData['lastName'],
                'birthday'          => $getData['birthday'],
                'age'               => $getData['age'],
                'email'             => $getData['email'],
                'phone_number'      => $getData['phoneNumber'],
                'current_address'   => $getData['currentAddress'],
                'map_province'      => $getData['mapIDProvince'],
                'img_base'          => $getData['baseimg'],
                'created_at'        => Carbon::now(),
                'created_user'      => Auth::user()->emp_code
            ]);

            if (isset($saveEmpGetID)) {
                $saveUser = $this->getDatabase->table('users')->insert([
                    'name'  => $getData['firstName'] . ' ' . $getData['lastName'],
                    'email' => $getData['email'],
                    'emp_code' => $getData['employee_code'],
                    'password' => bcrypt($getData['employee_code']),
                    'created_at' => Carbon::now(),
                    'user_level' => 2,
                    'user_system'   => $getData['userClass'],
                    'map_employee' => $saveEmpGetID
                ]);
            }

            if (!empty($saveUser) && !empty($saveEmpGetID)) {
                $returnStatus = [
                    'status'    => 200,
                    'message'   => 'Success',
                ];
            } else {
                $returnStatus = [
                    'status'    => 500,
                    'message'   => 'Error',
                ];
            }
        } catch (Exception $e) {
            $returnStatus = [
                'status'    => intval($e->getCode()),
                'message'   => $e->getMessage()
            ];
            Log::info($returnStatus);
        } finally {
            return $returnStatus;
        }
    }

    public function editEmployee($employeeID, $dataEmployee)
    {
        // dd($employeeID, $dataEmployee);
        try {
            $saveEditEmployeeData = $this->getDatabase->table('tbt_employee')
                ->where('ID', $employeeID)
                ->update([
                    'employee_code' => $dataEmployee['employee_code'],
                    'company_id'        => $dataEmployee['company'],
                    'department_id'     => $dataEmployee['department'],
                    'group_department_id'   => $dataEmployee['groupOfDepartment'],
                    'map_company'       => $dataEmployee['mapIDGroup'],
                    'position_class'    => $dataEmployee['positionClass'],
                    'position_name'     => $dataEmployee['positionName'],
                    'date_start_work'   => $dataEmployee['dateStart'],
                    'date_end_work'     => $dataEmployee['dateEnd'],
                    'user_class'        => $dataEmployee['userClass'],
                    'status_login'      => $dataEmployee['statusLogin'],
                    'prefix_id'         => $dataEmployee['prefixName'],
                    'first_name'        => $dataEmployee['firstName'],
                    'last_name'         => $dataEmployee['lastName'],
                    'birthday'          => $dataEmployee['birthday'],
                    'age'               => $dataEmployee['age'],
                    'email'             => $dataEmployee['email'],
                    'phone_number'      => $dataEmployee['phoneNumber'],
                    'current_address'   => $dataEmployee['currentAddress'],
                    'map_province'      => $dataEmployee['mapIDProvince'],
                    'img_base'          => $dataEmployee['baseimg'],
                    'update_at'         => Carbon::now(),
                    'update_user'       => Auth::user()->emp_code
                ]);
            if ($saveEditEmployeeData == 1) {
                $saveEditUserData = $this->getDatabase->table('users')->where('map_employee', $employeeID)->update([
                    'name'          => $dataEmployee['firstName'] . ' ' . $dataEmployee['lastName'],
                    'email'         => $dataEmployee['email'],
                    'emp_code'      => $dataEmployee['employee_code'],
                    'user_system'   => $dataEmployee['userClass'],
                    'map_employee'  => $employeeID,
                    'status_login'  => $dataEmployee['statusLogin'],
                    'updated_at'    => Carbon::now()
                ]);
            }
            // dd($saveEditEmployeeData, $saveEditUserData);
            if ($saveEditEmployeeData && $saveEditUserData == 1) {
                $returnStatus = [
                    'status'    => 200,
                    'message'   => 'Success',
                ];
            } else {
                $returnStatus = [
                    'status'    => 500,
                    'message'   => 'Error',
                ];
            }
        } catch (Exception $e) {
            $returnStatus = [
                'status'    => intval($e->getCode()),
                'message'   => $e->getMessage()
            ];
            Log::info($returnStatus);
        } finally {
            return $returnStatus;
        }
    }

    public function deleteEmployee($employeeID)
    {
        try {
            $deleteData = $this->getDatabase->table('tbt_employee')->where('ID', $employeeID)->update([
                'deleted'           => 1,
                'update_user'       => Auth::user()->emp_code,
                'update_at'         => Carbon::now()
            ]);

            $deleteUser = $this->getDatabase->table('users')->where('map_employee', $employeeID)->update([
                'status_login'           => 0,
                'updated_at'             => Carbon::now()
            ]);

            $returnStatus = [
                'status'    => 200,
                'message'   => 'Delete Success'
            ];
        } catch (Exception $e) {
            $returnStatus = [
                'status'    => intval($e->getCode()),
                'message'   => $e->getMessage()
            ];
            Log::info($returnStatus);
        } finally {
            return $returnStatus;
        }
    }

    public function getDataEmployee($getEmpGetID)
    {
        try {
            $data = $this->getDatabase->table('tbt_employee')
                ->leftJoin('tbm_group', 'tbt_employee.map_company', '=', 'tbm_group.ID')
                ->leftJoin('tbm_class_list', 'tbt_employee.position_class', '=', 'tbm_class_list.ID')
                ->leftJoin('tbm_prefix_name', 'tbt_employee.prefix_id', '=', 'tbm_prefix_name.ID')
                ->leftJoin('tbm_province', 'tbt_employee.map_province', '=', 'tbm_province.ID')
                ->where('tbt_employee.ID', $getEmpGetID)
                ->select('tbt_employee.*', 'tbt_employee.ID AS emp_id', 'tbm_group.*', 'tbm_group.ID AS group_id', 'tbm_class_list.*', 'tbm_class_list.ID AS class_id', 'tbm_prefix_name.*', 'tbm_prefix_name.ID AS prefix_id', 'tbm_province.*', 'tbm_province.ID AS province_id')
                ->first();

            // dd($data);
            return $data;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}

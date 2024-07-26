<?php

namespace App\Models\Settings;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AboutCompanyModel extends Model
{
    use HasFactory;

    public function __construct()
    {
        $this->getDatabase = DB::connection('mysql');
    }

    public function getDataCompany($request)
    {
        $query = $this->getDatabase->table('tbm_company')->where('deleted', 0);
        // คำสั่งเรียงลำดับ (Sorting)
        $columns = ['ID', 'company_name_th', 'company_name_en', 'status'];
        $orderColumn = $columns[$request->input('order.0.column')];
        $orderDirection = $request->input('order.0.dir');
        $query->orderBy($orderColumn, $orderDirection);

        // คำสั่งค้นหา (Searching)
        $searchValue = $request->input('search.value');
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($columns, $searchValue) {
                foreach ($columns as $column) {
                    $query->orWhere('company_name_th', 'like', '%' . $searchValue . '%');
                    $query->orWhere('company_name_en', 'like', '%' . $searchValue . '%');
                }
            });
        }

        $recordsTotal = $query->count();
        // รับค่าที่ส่งมาจาก DataTables
        $start = $request->input('start');
        $length = $request->input('length');

        $data = $query->offset($start)
            ->limit($length)
            ->orderBy('status', 'DESC')
            ->get();

        $output = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal, // หรือจำนวนรายการที่ผ่านการค้นหา
            'data' => $data,
        ];

        return $output;
    }

    public function getDataDepartment($request)
    {
        $query = $this->getDatabase->table('tbm_department AS depart')
            ->leftJoin('tbm_company AS company', 'depart.company_id', '=', 'company.ID')
            ->where('depart.deleted', 0)
            ->where('company.deleted', 0)
            ->select(
                'depart.ID',
                'depart.department_name',
                'company.company_name_th',
                'depart.status AS status'
            );
        // คำสั่งเรียงลำดับ (Sorting)
        $columns = ['depart.ID', 'depart.department_name', 'company.company_name_th', 'depart.status'];
        $orderColumn = $columns[$request->input('order.0.column')];
        $orderDirection = $request->input('order.0.dir');
        $query->orderBy($orderColumn, $orderDirection);

        // คำสั่งค้นหา (Searching)
        $searchValue = $request->input('search.value');
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($columns, $searchValue) {
                foreach ($columns as $column) {
                    $query->orWhere('depart.department_name', 'like', '%' . $searchValue . '%');
                    $query->orWhere('company.company_name_th', 'like', '%' . $searchValue . '%');
                }
            });
        }

        $recordsTotal = $query->count();
        // รับค่าที่ส่งมาจาก DataTables
        $start = $request->input('start');
        $length = $request->input('length');

        $data = $query->offset($start)
            ->limit($length)
            ->orderBy('depart.status', 'DESC')
            ->get();
        // dd($data);
        $output = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal, // หรือจำนวนรายการที่ผ่านการค้นหา
            'data' => $data,
        ];

        return $output;
    }

    public function getDataGroup($request)
    {
        $query = $this->getDatabase->table('tbm_group AS group')
            ->leftJoin('tbm_department AS department', 'group.department_id', '=', 'department.ID')
            ->leftJoin('tbm_company AS company', 'department.company_id', '=', 'company.ID')
            ->select('group.ID', 'group.group_name', 'department.department_name', 'company.company_name_th', 'group.status AS status')
            ->where('group.deleted', 0)
            ->where('department.deleted', 0)
            ->where('company.deleted', 0);
        // คำสั่งเรียงลำดับ (Sorting)
        $columns = ['group.ID', 'group.group_name', 'department.department_name', 'company.company_name_th', 'group.status'];
        $orderColumn = $columns[$request->input('order.0.column')];
        $orderDirection = $request->input('order.0.dir');
        $query->orderBy($orderColumn, $orderDirection);

        // คำสั่งค้นหา (Searching)
        $searchValue = $request->input('search.value');
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($columns, $searchValue) {
                foreach ($columns as $column) {
                    $query->orWhere('group.group_name', 'like', '%' . $searchValue . '%');
                    $query->orWhere('department.department_name', 'like', '%' . $searchValue . '%');
                    $query->orWhere('company.company_name_th', 'like', '%' . $searchValue . '%');
                }
            });
        }

        $recordsTotal = $query->count();
        // รับค่าที่ส่งมาจาก DataTables
        $start = $request->input('start');
        $length = $request->input('length');

        $data = $query->offset($start)
            ->limit($length)
            ->orderBy('status', 'DESC')
            ->get();

        $output = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal, // หรือจำนวนรายการที่ผ่านการค้นหา
            'data' => $data,
        ];

        return $output;
    }

    public function getDataPrefixName($request){
        $query = $this->getDatabase->table('tbm_prefix_name')->where('deleted', 0);
        // คำสั่งเรียงลำดับ (Sorting)
        $columns = ['ID', 'prefix_name', 'status'];
        $orderColumn = $columns[$request->input('order.0.column')];
        $orderDirection = $request->input('order.0.dir');
        $query->orderBy($orderColumn, $orderDirection);

        // คำสั่งค้นหา (Searching)
        $searchValue = $request->input('search.value');
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($columns, $searchValue) {
                foreach ($columns as $column) {
                    $query->orWhere('prefix_name', 'like', '%' . $searchValue . '%');
                }
            });
        }

        $recordsTotal = $query->count();
        // รับค่าที่ส่งมาจาก DataTables
        $start = $request->input('start');
        $length = $request->input('length');

        $data = $query->offset($start)
            ->limit($length)
            ->orderBy('status', 'DESC')
            ->get();

        $output = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal, // หรือจำนวนรายการที่ผ่านการค้นหา
            'data' => $data,
        ];

        return $output;
    }

    public function getDataClassList($request){
        $query = $this->getDatabase->table('tbm_class_list')->where('deleted', 0);
        // คำสั่งเรียงลำดับ (Sorting)
        $columns = ['ID', 'class_name', 'status'];
        $orderColumn = $columns[$request->input('order.0.column')];
        $orderDirection = $request->input('order.0.dir');
        $query->orderBy($orderColumn, $orderDirection);

        // คำสั่งค้นหา (Searching)
        $searchValue = $request->input('search.value');
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($columns, $searchValue) {
                foreach ($columns as $column) {
                    $query->orWhere('class_name', 'like', '%' . $searchValue . '%');
                }
            });
        }

        $recordsTotal = $query->count();
        // รับค่าที่ส่งมาจาก DataTables
        $start = $request->input('start');
        $length = $request->input('length');

        $data = $query->offset($start)
            ->limit($length)
            ->orderBy('status', 'DESC')
            ->get();

        $output = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal, // หรือจำนวนรายการที่ผ่านการค้นหา
            'data' => $data,
        ];

        return $output;
    }

    public function saveDataCompany($getData)
    {
        try {
            // dd(Auth::user()->emp_code);
            $saveToDB = $this->getDatabase->table('tbm_company')->insertGetId([
                'company_name_th'   => $getData['companyNameTH'],
                'company_name_en'   => $getData['companyNameEN'],
                'status'            => $getData['statusOfCompany'],
                'created_user'      => Auth::user()->emp_code,
                'created_at'        => Carbon::now()
            ]);
            // dd($saveToDB);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                'ID'        => $saveToDB
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

    public function showEditCompany($companyID)
    {
        $getData = $this->getDatabase->table('tbm_company')->where('ID', $companyID)->get();
        return $getData;
    }

    public function saveEditDataCompany($dataEdit, $companyID)
    {
        try {
            $updateToDB = $this->getDatabase->table('tbm_company')
                ->where('ID', $companyID)
                ->update([
                    'company_name_th'   => $dataEdit['edit_companyNameTH'],
                    'company_name_en'   => $dataEdit['edit_companyNameEN'],
                    'status'            => $dataEdit['edit_statusOfCompany'],
                    'update_user'      => Auth::user()->emp_code,
                    'update_at'        => Carbon::now()
                ]);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                // 'ID'        => $companyID
            ];
        } catch (Exception $e) {
            $returnStatus = [
                'status'    => intval($e->getCode()),
                'message'   => $e->getMessage()
            ];
        } finally {
            return $returnStatus;
        }
    }

    public function deleteCompany($companyID)
    {
        try {
            $updateToDB = $this->getDatabase->table('tbm_company')
                ->where('ID', $companyID)
                ->update([
                    'deleted'           => 1,
                    'update_user'       => Auth::user()->emp_code,
                    'update_at'         => Carbon::now()
                ]);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                // 'ID'        => $companyID
            ];
        } catch (Exception $e) {
            $returnStatus = [
                'status'    => intval($e->getCode()),
                'message'   => $e->getMessage()
            ];
        } finally {
            return $returnStatus;
        }
    }

    public function saveDataDepartment($getData)
    {
        try {
            // dd(Auth::user()->emp_code);
            $saveToDB = $this->getDatabase->table('tbm_department')->insertGetId([
                'department_name'   => $getData['departmentName'],
                'company_id'        => $getData['company'],
                'status'            => $getData['statusOfDepartment'],
                'created_user'      => Auth::user()->emp_code,
                'created_at'        => Carbon::now()
            ]);
            // dd($saveToDB);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                'ID'        => $saveToDB
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

    public function showEditDepartment($departmentID)
    {
        $getData = $this->getDatabase->table('tbm_department')->where('ID', $departmentID)->get();
        return $getData;
    }

    public function saveEditDataDepartment($dataEdit, $departmentID)
    {
        try {
            $updateToDB = $this->getDatabase->table('tbm_department')
                ->where('ID', $departmentID)
                ->update([
                    'department_name'   => $dataEdit['edit_departmentName'],
                    'company_id'        => $dataEdit['edit_company'],
                    'status'            => $dataEdit['edit_statusOfDepartment'],
                    'update_user'      => Auth::user()->emp_code,
                    'update_at'        => Carbon::now()
                ]);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                // 'ID'        => $departmentID
            ];
        } catch (Exception $e) {
            $returnStatus = [
                'status'    => intval($e->getCode()),
                'message'   => $e->getMessage()
            ];
        } finally {
            return $returnStatus;
        }
    }

    public function deleteDepartment($departmentID)
    {
        try {
            $updateToDB = $this->getDatabase->table('tbm_department')
                ->where('ID', $departmentID)
                ->update([
                    'deleted'           => 1,
                    'update_user'       => Auth::user()->emp_code,
                    'update_at'         => Carbon::now()
                ]);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                // 'ID'        => $departmentID
            ];
        } catch (Exception $e) {
            $returnStatus = [
                'status'    => intval($e->getCode()),
                'message'   => $e->getMessage()
            ];
        } finally {
            return $returnStatus;
        }
    }

    public function saveDataGroup($getData)
    {
        // dd("ddd");
        try {
            // dd(Auth::user()->emp_code);
            $saveToDB = $this->getDatabase->table('tbm_group')->insertGetId([
                'group_name'        => $getData['groupName'],
                'company_id'        => $getData['companyForGroup'],
                'department_id'     => $getData['department'],
                'status'            => $getData['statusOfGroup'],
                'created_user'      => Auth::user()->emp_code,
                'created_at'        => Carbon::now()
            ]);
            // dd($saveToDB);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                'ID'        => $saveToDB
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

    public function showEditGroup($groupID)
    {
        $getData = $this->getDatabase->table('tbm_group')->where('ID', $groupID)->get();
        return $getData;
    }

    public function saveEditDataGroup($dataEdit, $groupID)
    {
        try {
            $updateToDB = $this->getDatabase->table('tbm_group')
                ->where('ID', $groupID)
                ->update([
                    'group_name'        => $dataEdit['edit_groupName'],
                    'company_id'        => $dataEdit['edit_companyForGroup'],
                    'department_id'     => $dataEdit['edit_department'],
                    'status'            => $dataEdit['edit_statusOfGroup'],
                    'update_user'      => Auth::user()->emp_code,
                    'update_at'        => Carbon::now()
                ]);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                // 'ID'        => $groupID
            ];
        } catch (Exception $e) {
            $returnStatus = [
                'status'    => intval($e->getCode()),
                'message'   => $e->getMessage()
            ];
        } finally {
            return $returnStatus;
        }
    }

    public function deleteGroup($groupID)
    {
        try {
            $updateToDB = $this->getDatabase->table('tbm_group')
                ->where('ID', $groupID)
                ->update([
                    'deleted'           => 1,
                    'update_user'       => Auth::user()->emp_code,
                    'update_at'         => Carbon::now()
                ]);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                // 'ID'        => $groupID
            ];
        } catch (Exception $e) {
            $returnStatus = [
                'status'    => intval($e->getCode()),
                'message'   => $e->getMessage()
            ];
        } finally {
            return $returnStatus;
        }
    }

    public function saveDataPrefixName($getData)
    {
        try {
            $saveToDB = $this->getDatabase->table('tbm_prefix_name')->insertGetId([
                'prefix_name'   => $getData['prefixName'],
                'status'        => $getData['statusOfPrefixName'],
                'created_user'  => Auth::user()->emp_code,
                'created_at'    => Carbon::now()
            ]);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                'ID'        => $saveToDB
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

    public function showEditPrefixName($prefixNameID)
    {
        $getData = $this->getDatabase->table('tbm_prefix_name')->where('ID', $prefixNameID)->get();
        return $getData;
    }

    public function saveEditDataPrefixName($dataEdit, $prefixNameID)
    {
        try {
            $updateToDB = $this->getDatabase->table('tbm_prefix_name')
                ->where('ID', $prefixNameID)
                ->update([
                    'prefix_name'   => $dataEdit['edit_prefixName'],
                    'status'        => $dataEdit['edit_statusOfPrefixName'],
                    'update_user'   => Auth::user()->emp_code,
                    'update_at'     => Carbon::now()
                ]);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                // 'ID'        => $prefixNameID
            ];
        } catch (Exception $e) {
            $returnStatus = [
                'status'    => intval($e->getCode()),
                'message'   => $e->getMessage()
            ];
        } finally {
            return $returnStatus;
        }
    }

    public function deletePrefixName($prefixNameID)
    {
        try {
            $updateToDB = $this->getDatabase->table('tbm_prefix_name')
                ->where('ID', $prefixNameID)
                ->update([
                    'deleted'           => 1,
                    'update_user'       => Auth::user()->emp_code,
                    'update_at'         => Carbon::now()
                ]);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                // 'ID'        => $prefixNameID
            ];
        } catch (Exception $e) {
            $returnStatus = [
                'status'    => intval($e->getCode()),
                'message'   => $e->getMessage()
            ];
        } finally {
            return $returnStatus;
        }
    }

    public function saveDataClassList($getData){
        try {
            $saveToDB = $this->getDatabase->table('tbm_class_list')->insertGetId([
                'class_name'   => $getData['className'],
                'status'        => $getData['statusOfClassList'],
                'created_user'  => Auth::user()->emp_code,
                'created_at'    => Carbon::now()
            ]);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                'ID'        => $saveToDB
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

    public function showEditClassList($classListID){
        $getData = $this->getDatabase->table('tbm_class_list')->where('ID', $classListID)->get();
        return $getData;
    }

    public function saveEditDataClassList($dataEdit, $classListID){
        try {
            $updateToDB = $this->getDatabase->table('tbm_class_list')
                ->where('ID', $classListID)
                ->update([
                    'class_name'   => $dataEdit['edit_className'],
                    'status'        => $dataEdit['edit_statusOfClassList'],
                    'update_user'   => Auth::user()->emp_code,
                    'update_at'     => Carbon::now()
                ]);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                // 'ID'        => $classListID
            ];
        } catch (Exception $e) {
            $returnStatus = [
                'status'    => intval($e->getCode()),
                'message'   => $e->getMessage()
            ];
        } finally {
            return $returnStatus;
        }
    }

    public function deleteClassList($classListID){
        try {
            $updateToDB = $this->getDatabase->table('tbm_class_list')
                ->where('ID', $classListID)
                ->update([
                    'deleted'           => 1,
                    'update_user'       => Auth::user()->emp_code,
                    'update_at'         => Carbon::now()
                ]);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                // 'ID'        => $classListID
            ];
        } catch (Exception $e) {
            $returnStatus = [
                'status'    => intval($e->getCode()),
                'message'   => $e->getMessage()
            ];
        } finally {
            return $returnStatus;
        }
    }
}

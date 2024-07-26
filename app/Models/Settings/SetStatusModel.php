<?php

namespace App\Models\Settings;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SetStatusModel extends Model
{
    use HasFactory;

    public function __construct()
    {
        $this->getDatabase = DB::connection('mysql');
    }

    public function gatDataStatus($request)
    {
        $query = $this->getDatabase->table('tbm_status_work AS statusWork')
            ->leftJoin('tbm_flag_type AS flag', 'statusWork.flag_type', '=', 'flag.ID')
            ->select('statusWork.ID', 'statusWork.status_name', 'statusWork.status_use', 'statusWork.status', 'flag.type_work')
            ->where('statusWork.deleted', 0)
            ->where('flag.deleted', 0);
        // คำสั่งเรียงลำดับ (Sorting)
        $columns = ['statusWork.ID', 'statusWork.status_name', 'statusWork.status_use', 'statusWork.status', 'flag.type_work'];
        $orderColumn = $columns[$request->input('order.0.column')];
        $orderDirection = $request->input('order.0.dir');
        $query->orderBy($orderColumn, $orderDirection);

        // คำสั่งค้นหา (Searching)
        $searchValue = $request->input('search.value');
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($columns, $searchValue) {
                foreach ($columns as $column) {
                    $query->orWhere('status_name', 'like', '%' . $searchValue . '%');
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
            ->orderBy('flag_type', 'DESC')
            ->get();

        $output = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal, // หรือจำนวนรายการที่ผ่านการค้นหา
            'data' => $data,
        ];

        // dd($output);

        return $output;
    }

    public function gatDataFlagType($request)
    {
        $query = $this->getDatabase->table('tbm_flag_type')->where('deleted', 0);

        // คำสั่งเรียงลำดับ (Sorting)
        $columns = ['ID', 'flag_name', 'type_work'];
        $orderColumn = $columns[$request->input('order.0.column')];
        $orderDirection = $request->input('order.0.dir');
        $query->orderBy($orderColumn, $orderDirection);

        // คำสั่งค้นหา (Searching)
        $searchValue = $request->input('search.value');
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($columns, $searchValue) {
                foreach ($columns as $column) {
                    $query->orWhere('flag_name', 'like', '%' . $searchValue . '%');
                    $query->orWhere('type_work', 'like', '%' . $searchValue . '%');
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

        return $output;
    }

    public function saveDataStatus($getData)
    {
        try {
            // dd(Auth::user()->emp_code);
            $saveToDB = $this->getDatabase->table('tbm_status_work')->insertGetId([
                'status_name'   => $getData['statusName'],
                'status_use'    => $getData['statusUse'],
                'flag_type'     => $getData['flagType'],
                'status'        => $getData['statusOfStatus'],
                'created_user'  => Auth::user()->emp_code,
                'created_at'    => Carbon::now()
            ]);
            // dd($saveToDB);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                // 'ID'        => $saveToDB
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

    public function showEditStatus($statusID)
    {
        $getData = $this->getDatabase->table('tbm_status_work')->where('ID', $statusID)->get();
        // dd($getData);
        return $getData;
    }

    public function editStatus($dataEdit, $statusID)
    {
        try {
            $this->getDatabase->table('tbm_status_work')->where('ID', $statusID)->update([
                'status_name'   => $dataEdit['edit_statusName'],
                'status_use'    => $dataEdit['edit_statusUse'],
                'status'        => $dataEdit['edit_statusOfStatus'],
                'flag_type'     => $dataEdit['edit_flagType'],
                'update_user'  => Auth::user()->emp_code,
                'update_at'    => Carbon::now()
            ]);

            $returnStatus = [
                'status'    => 200,
                'message'   => 'Edit Success'
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

    public function deleteStatus($statusID)
    {
        try {
            $this->getDatabase->table('tbm_status_work')->where('ID', $statusID)->update([
                'deleted'      => 1,
                'update_user'       => Auth::user()->emp_code,
                'update_at'         => Carbon::now()
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
        } finally {
            return $returnStatus;
        }
    }

    public function saveDataFlagType($getFlagType)
    {
        try {
            // dd($getFlagType);
            $saveToDB = $this->getDatabase->table('tbm_flag_type')->insertGetId([
                'flag_name'   => $getFlagType['flagName'],
                'type_work'    => $getFlagType['typeWork'],
                'created_user'  => Auth::user()->emp_code,
                'created_at'    => Carbon::now()
            ]);
            // dd($saveToDB);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success',
                // 'ID'        => $saveToDB
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

    public function showEditFlagType($flagID)
    {
        $getData = $this->getDatabase->table('tbm_flag_type')->where('ID', $flagID)->get();
        // dd($getData);
        return $getData;
    }

    public function editFlagType($dataEdit, $flagID)
    {
        try {
            $this->getDatabase->table('tbm_flag_type')->where('ID', $flagID)->update([
                'flag_name'   => $dataEdit['edit_flagName'],
                'type_work'    => $dataEdit['edit_typeWork'],
                'update_user'  => Auth::user()->emp_code,
                'update_at'    => Carbon::now()
            ]);

            $returnStatus = [
                'status'    => 200,
                'message'   => 'Edit Success'
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

    public function deleteFlagType($flagID)
    {
        try {
            $this->getDatabase->table('tbm_flag_type')->where('ID', $flagID)->update([
                'deleted'           => 1,
                'update_user'       => Auth::user()->emp_code,
                'update_at'         => Carbon::now()
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
        } finally {
            return $returnStatus;
        }
    }
}

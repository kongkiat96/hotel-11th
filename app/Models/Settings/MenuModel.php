<?php

namespace App\Models\Settings;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MenuModel extends Model
{
    use HasFactory;
    public function __construct()
    {
        $this->getDatabase = DB::connection('mysql');
    }

    public function getDataMenuMain($request)
    {
        // dd($request->all());
        $columns = ['menu_sort', 'ID', 'menu_name', 'menu_link', 'menu_icon', 'status'];

        $query = $this->getDatabase->table('tbm_menu_main')->where('deleted', 0);

        $orderColumnIndex = $request->input('order.0.column');
        $orderDirection = $request->input('order.0.dir', 'asc');

        if ($orderColumnIndex !== null || isset($columns[$orderColumnIndex])) {
            $orderColumn = $columns[$orderColumnIndex];
            $query->orderBy($orderColumn, $orderDirection);
        }
        // คำสั่งค้นหา (Searching)
        $searchValue = $request->input('search.value');
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($columns, $searchValue) {
                foreach ($columns as $column) {
                    $query->orWhere('menu_name', 'like', '%' . $searchValue . '%');
                    $query->orWhere('menu_link', 'like', '%' . $searchValue . '%');
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
    }

    public function getDataMenuSub($request)
    {
        $query = $this->getDatabase->table('tbm_menu_sub AS tms')
            ->leftJoin('tbm_menu_main AS tmm', 'tms.menu_main_ID', '=', 'tmm.ID')
            ->select('tms.ID', 'tms.menu_sub_name', 'tms.menu_sub_link', 'tms.menu_main_ID', 'tmm.menu_name', 'tmm.menu_icon', 'tmm.menu_link', 'tms.menu_sub_icon', 'tms.status', 'tmm.menu_sort')
            ->where('tms.deleted', 0)
            ->where('tmm.deleted', 0);
        $columns = ['tmm.menu_sort', 'tmm.ID', 'tmm.menu_name', 'tmm.menu_link', 'tms.ID', 'tms.menu_sub_name', 'tms.menu_main_ID', 'tms.menu_sub_link'];

        $orderColumnIndex = $request->input('order.0.column');
        $orderDirection = $request->input('order.0.dir', 'asc');

        if ($orderColumnIndex !== null || isset($columns[$orderColumnIndex])) {
            $orderColumn = $columns[$orderColumnIndex];
            $query->orderBy($orderColumn, $orderDirection);
        }
        // คำสั่งค้นหา (Searching)
        $searchValue = $request->input('search.value');
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($columns, $searchValue) {
                foreach ($columns as $column) {
                    $query->orWhere('tmm.menu_name', 'like', '%' . $searchValue . '%');
                    $query->orWhere('tmm.menu_link', 'like', '%' . $searchValue . '%');
                    $query->orWhere('tms.menu_sub_name', 'like', '%' . $searchValue . '%');
                    $query->orWhere('tms.menu_sub_link', 'like', '%' . $searchValue . '%');
                }
            });
        }
        $recordsTotal = $query->count();
        // รับค่าที่ส่งมาจาก DataTables
        $start = $request->input('start');
        $length = $request->input('length');

        $data = $query->offset($start)
            ->limit($length)
            // ->orderBy('tms.ID', 'DESC')
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

    public function saveMenuMain($dataMenuMain)
    {
        try {
            $saveToDB = $this->getDatabase->table('tbm_menu_main')->insertGetId([
                'menu_name'     => $dataMenuMain['menuName'],
                'menu_link'     => $dataMenuMain['pathMenu'],
                'menu_icon'     => $dataMenuMain['iconMenu'],
                'status'        => $dataMenuMain['statusMenu'],
                'menu_sort'     => $dataMenuMain['menuSort'],
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

    public function saveMenuSub($dataMenuSub)
    {
        try {
            $saveToDB = $this->getDatabase->table('tbm_menu_sub')->insertGetId([
                'menu_main_ID'      => $dataMenuSub['menuMain'],
                'menu_sub_name'     => $dataMenuSub['menuName'],
                'menu_sub_link'     => $dataMenuSub['pathMenu'],
                'menu_sub_icon'     => $dataMenuSub['iconMenu'],
                'status'           => $dataMenuSub['statusMenu'],
                'created_user'      => Auth::user()->emp_code,
                'created_at'        => Carbon::now()
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

    public function saveAccessMenu($dataAccessMenu)
    {
        try {
            // dd($dataAccessMenu);
            $deleteDataOld = $this->getDatabase->table('tbt_user_access_menu')->where('employee_code', $dataAccessMenu['emp_code'])->delete();
            // dd($dataAccessMenu['access_menu_list']);
            if (!empty($dataAccessMenu['access_menu_list'])) {
                foreach ($dataAccessMenu['access_menu_list'] as $key => $value) {
                    $getSearchMenu = $this->getDatabase->table('tbm_menu_sub AS tms')
                        ->leftJoin('tbm_menu_main AS tmm', 'tms.menu_main_ID', '=', 'tmm.ID')
                        ->select('tms.*', 'tmm.menu_name')
                        ->whereIn('tms.ID', $dataAccessMenu['access_menu_list'])->get();
                    // dd($getSearchMenu);
                }

                foreach ($getSearchMenu as $key => $value) {
                    // dd($value->ID);
                    $saveDataAccessMenu = $this->getDatabase->table('tbt_user_access_menu')->insertGetId([
                        'employee_code' => $dataAccessMenu['emp_code'],
                        'employee_name' => $dataAccessMenu['emp_name'],
                        'menu_main_ID' => $value->menu_main_ID,
                        'menu_main_name' => $value->menu_name,
                        'menu_sub_ID'   => $value->ID,
                        'menu_sub_name' => $value->menu_sub_name,
                        'created_at' => Carbon::now(),
                        'created_user' => Auth::user()->emp_code
                        //'menu_sub_id' => $value->ID,
                        //'menu_sub_name' => $value->menu_sub_name
                    ]);
                }
            }
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success'
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

    public function showEditMenuMain($menuMainID)
    {
        $getData = $this->getDatabase->table('tbm_menu_main')->where('ID', $menuMainID)->get();
        return $getData;
    }

    public function saveEditDataMenuMain($dataMenuMain, $menuMainID)
    {
        try {
            $saveToDB = $this->getDatabase->table('tbm_menu_main')->where('ID', $menuMainID)->update([
                'menu_name'     => $dataMenuMain['edit_menuName'],
                'menu_link'     => $dataMenuMain['edit_pathMenu'],
                'menu_icon'     => $dataMenuMain['edit_iconMenu'],
                'menu_sort'     => $dataMenuMain['edit_menuSort'],
                'status'        => $dataMenuMain['edit_statusMenu'],
                'updated_user'  => Auth::user()->emp_code,
                'updated_at'    => Carbon::now()
            ]);

            $updateMenuSub = $this->getDatabase->table('tbm_menu_sub')->where('menu_main_ID', $menuMainID)->update([
                'status'       => $dataMenuMain['edit_statusMenu'],
            ]);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success'
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

    public function deleteMenuMain($menuMainID)
    {
        try {
            $saveToDB = $this->getDatabase->table('tbm_menu_main')->where('ID', $menuMainID)
                ->update([
                    'deleted'           => 1,
                    'updated_user'       => Auth::user()->emp_code,
                    'updated_at'         => Carbon::now()
                ]);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success'
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

    public function showEditMenuSub($menuSubID)
    {
        $getData = $this->getDatabase->table('tbm_menu_sub')->where('ID', $menuSubID)->get();
        return $getData;
    }

    public function saveEditDataMenuSub($dataMenuSub, $menuSubID)
    {
        try {
            // dd($dataMenuSub);
            $saveToDB = $this->getDatabase->table('tbm_menu_sub')->where('ID', $menuSubID)->update([
                'menu_main_ID'      => $dataMenuSub['menuMain'],
                'menu_sub_name'     => $dataMenuSub['edit_menuName'],
                'menu_sub_link'     => $dataMenuSub['edit_pathMenu'],
                'menu_sub_icon'     => $dataMenuSub['edit_iconMenu'],
                'status'            => $dataMenuSub['edit_statusMenu'],
                'updated_user'      => Auth::user()->emp_code,
                'updated_at'        => Carbon::now()
            ]);

            $getSearchStatusMain = $this->getDatabase->table('tbm_menu_main')->where('ID', $dataMenuSub['menuMain'])->get();
            // dd($getSearchStatusMain);

            if ($getSearchStatusMain[0]->status == 0) {
                $updateMenuMain = $this->getDatabase->table('tbm_menu_main')->where('ID', $dataMenuSub['menuMain'])->update([
                    'status'       => 1,
                ]);
            }

            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success'
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

    public function deleteMenuSub($menuSubID)
    {
        try {
            $saveToDB = $this->getDatabase->table('tbm_menu_sub')->where('ID', $menuSubID)
                ->update([
                    'deleted'       => 1,
                    'updated_user'  => Auth::user()->emp_code,
                    'updated_at'    => Carbon::now()
                ]);
            $returnStatus = [
                'status'    => 200,
                'message'   => 'Success'
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
}

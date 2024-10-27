<?php

namespace App\Models\FreezeAccount;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DepartmentModel extends Model
{
    use HasFactory;

    public function getDataFreezeAccountDepartment($param)
    {
        try {
            $sql = DB::connection('mysql')->table('tbt_freeze_account AS fa')
                ->leftJoin('tbm_bank_list AS bl', 'fa.bank_id', '=', 'bl.ID')
                ->where('fa.deleted', 0)->where('tag_freeze', 'department');
            $sql = $sql->where(function ($query) use ($param) {
                if ($param['statusOfFreeze'] == 'Y') {
                    $query->where('fa.status_freeze', 'Y');
                } else {
                    $query->where('fa.status_freeze', 'N');
                }
            });

            $sql = $sql->select('fa.*', 'bl.bank_logo', DB::raw("CONCAT(bl.bank_name,' (',bl.bank_short_name,')') AS bank_name"));
            if ($param['start'] == 0) {
                $sql = $sql->limit($param['length'])->orderBy('created_at', 'desc')->get();
            } else {
                $sql = $sql->offset($param['start'])
                    ->limit($param['length'])
                    ->orderBy('created_at', 'desc')->get();
            }
            // $sql = $sql->orderBy('created_at', 'desc');
            $dataCount = $sql->count();
            // dd($sql);
            $newArr = [];
            foreach ($sql as $key => $value) {
                $newArr[] = [
                    'ID' => $value->id,
                    'freeze_account' => $value->freeze_account,
                    'machine_name' => $value->machine_name,
                    'bookbank_name' => $value->bookbank_name,
                    'account_number' => $value->account_number,
                    'amount_total' => number_format($value->amount_total, 2),
                    'reason_freeze' => $value->reason_freeze,
                    'bank_logo' => $value->bank_logo,
                    'bank_name' => $value->bank_name,
                    'created_at' => $value->created_at,
                    'created_user' => $value->created_user,
                    'status_freeze' => $value->status_freeze,
                    'updated_at' => !empty($value->updated_at) ? $value->updated_at : '-',
                    'updated_user' => !empty($value->updated_user) ? $value->updated_user : '-',
                    'premission' => Auth::user()->user_system
                ];
            }

            $returnData = [
                "recordsTotal" => $dataCount,
                "recordsFiltered" => $dataCount,
                "data" => $newArr,
            ];

            // dd($returnData);
            return $returnData;
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return false;
        }
    }

    public function saveDataFreezeAccount($data)
    {
        try {
            // dd($data);
            // บันทึกข้อมูลไปยังฐานข้อมูล
            $data['amount_total'] = str_replace(',', '', $data['amount_total']);
            $data['created_user'] = Auth::user()->emp_code;
            $data['created_at'] = Carbon::now();

            DB::connection('mysql')->table('tbt_freeze_account')->insert($data);

            return [
                'status' => 200,
                'message' => 'Delete Success'
            ];
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function getFreezeAccount($freezeAccountID)
    {
        try {
            $data = DB::connection('mysql')->table('tbt_freeze_account')->where('id', $freezeAccountID)->first();
            return $data;
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return false;
        }
    }

    public function editFreezeAccountDepartment($data, $freezeAccountID)
    {
        try {
            unset($data['freezeID']);
            $data['amount_total'] = str_replace(',', '', $data['amount_total']);
            $data['updated_user'] = Auth::user()->emp_code;
            $data['updated_at'] = Carbon::now();
            // dd($data);
            DB::connection('mysql')->table('tbt_freeze_account')->where('id', $freezeAccountID)->update($data);
            return [
                'status' => 200,
                'message' => 'Delete Success'
            ];
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function deleteFreezeAccountDepartment($freezeAccountID)
    {
        try {
            DB::connection('mysql')->table('tbt_freeze_account')->where('id', $freezeAccountID)->update([
                'deleted' => 1,
                'updated_user'  => Auth::user()->emp_code,
                'updated_at'    => Carbon::now()
            ]);
            return [
                'status' => 200,
                'message' => 'Delete Success'
            ];
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }
}

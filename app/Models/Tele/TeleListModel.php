<?php

namespace App\Models\Tele;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TeleListModel extends Model
{
    use HasFactory;

    public function getDataTelelist($param)
    {
        try {
            $sql = DB::connection('mysql')->table('tbt_tele_department AS td')
                ->leftJoin('tbt_freeze_account AS fa', 'td.freeze_account_id', '=', 'fa.id')
                ->where('td.deleted', 0);

            $sql = $sql->select('td.*', 'fa.bookbank_name');
            if ($param['start'] == 0) {
                $sql = $sql->limit($param['length']);
            } else {
                $sql = $sql->offset($param['start'])
                    ->limit($param['length']);
            }

            $sql = $sql->orderBy('created_at', 'desc')->get();
            // $sql = $sql->orderBy('created_at', 'desc');
            $dataCount = $sql->count();
            // dd($sql);
            $newArr = [];
            foreach ($sql as $key => $value) {
                $newArr[] = [
                    'ID' => $value->id,
                    'tele_department' => $value->tele_department,
                    'date_receive' => !empty($value->date_receive) ? $value->date_receive : '-',
                    'date_send' => !empty($value->date_sent) ? $value->date_sent : '-',
                    'tele_machine' => $value->tele_machine,
                    'tele_reason' => $value->tele_reason,
                    'bookbank_name' => $value->bookbank_name,
                    'created_at' => $value->created_at,
                    'created_user' => $value->created_user,
                    'updated_at' => !empty($value->updated_at) ? $value->updated_at : '-',
                    'updated_user' => !empty($value->updated_user) ? $value->updated_user : '-',
                    'Permission' => Auth::user()->user_system
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
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }
    public function saveDataTelelist($data)
    {
        try {
            // dd($data);
            $data['created_user'] = Auth::user()->emp_code;
            $data['created_at'] = Carbon::now();

            DB::connection('mysql')->table('tbt_tele_department')->insert($data);

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

    public function getTeleList($teleDepartmentID)
    {
        try {
            $sql = DB::connection('mysql')->table('tbt_tele_department AS td')
                ->leftJoin('tbt_freeze_account AS fa', 'td.freeze_account_id', '=', 'fa.id')
                ->where('td.id', $teleDepartmentID);
            $sql = $sql->select('td.*', 'fa.bookbank_name');
            $sql = $sql->first();
            return $sql;
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function editTelelist($data, $teleDepartmentID)
    {
        try {
            
            $data['date_receive'] = $data['edit_date_receive'];
            $data['date_sent'] = $data['edit_date_sent'];
            $data['updated_user'] = Auth::user()->emp_code;
            $data['updated_at'] = Carbon::now();
            $data = Arr::except($data, ['edit_date_receive', 'edit_date_sent']);

            // dd($data);
            DB::connection('mysql')->table('tbt_tele_department')->where('id', $teleDepartmentID)->update($data);
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

    public function deleteTelelist($teleDepartmentID)
    {
        try {
            DB::connection('mysql')->table('tbt_tele_department')->where('id', $teleDepartmentID)->update([
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

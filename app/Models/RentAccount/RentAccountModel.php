<?php

namespace App\Models\RentAccount;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RentAccountModel extends Model
{
    use HasFactory;

    public function getDataRentAccount($request)
    {
        try {
            $sql = DB::connection('mysql')->table('tbt_rent_account')->where('deleted', 0);

            if ($request['start'] == 0) {
                $sql = $sql->limit($request['length']);
            } else {
                $sql = $sql->offset($request['start'])
                    ->limit($request['length']);
            }
            $sql = $sql->orderBy('created_at', 'desc')->get();
            $dataCount = $sql->count();
            $newArr = [];
            foreach ($sql as $key => $value) {
                $newArr[] = [
                    'ID' => $value->id,
                    'rent_department' => $value->rent_department,
                    'date_request_rent' => !empty($value->date_request_rent) ? $value->date_request_rent : '-',
                    'date_send' => !empty($value->date_sent) ? $value->date_sent : '-',
                    'rent_total' => number_format($value->rent_total, 0),
                    'rent_reason' => $value->rent_reason,
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

    public function saveDataRentAccount($data)
    {
        try {
            // dd($data);
            $data['rent_total'] = str_replace(',', '', $data['rent_total']);
            $data['created_user'] = Auth::user()->emp_code;
            $data['created_at'] = Carbon::now();

            DB::connection('mysql')->table('tbt_rent_account')->insert($data);

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

    public function getDataRentAccountById($id)
    {
        try {
            $sql = DB::connection('mysql')->table('tbt_rent_account')->where('deleted', 0)->where('id', $id)->first();
            return $sql;
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function editRentAccount($data, $id)
    {
        try {
            $data['date_request_rent'] = $data['edit_date_request_rent'];
            $data['date_sent'] = $data['edit_date_sent'];
            $data['rent_total'] = str_replace(',', '', $data['rent_total']);
            $data['updated_user'] = Auth::user()->emp_code;
            $data['updated_at'] = Carbon::now();
            $data = Arr::except($data, ['edit_date_request_rent', 'edit_date_sent']);
            DB::connection('mysql')->table('tbt_rent_account')->where('id', $id)->update($data);
            return [
                'status' => 200,
                'message' => 'Update Success'
            ];
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function deleteRentAccount($id)
    {
        try {
            DB::connection('mysql')->table('tbt_rent_account')->where('id', $id)->update([
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

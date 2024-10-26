<?php

namespace App\Models\Settings;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BankListModel extends Model
{
    use HasFactory;

    public function getDataBankList($param)
    {
        try {
            $sql = DB::connection('mysql')->table('tbm_bank_list')->where('deleted',0);

            if ($param['start'] == 0) {
                $sql = $sql->limit($param['length'])->orderBy('created_at', 'desc')->get();
            } else {
                $sql = $sql->offset($param['start'])
                    ->limit($param['length'])
                    ->orderBy('created_at', 'desc')->get();
            }
            // $sql = $sql->orderBy('created_at', 'desc');
            $dataCount = $sql->count();
            
            // dd($data);
            $newArr = [];
            foreach ($sql as $key => $value) {
                $newArr[] = [
                    'ID' => $value->ID,
                    'bank_logo' => $value->bank_logo,
                    'bank_name' => $value->bank_name,
                    'bank_short_name' => $value->bank_short_name,
                    'status' => $value->status,
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
    public function saveDataBank($data)
    {
        try {
            // บันทึกข้อมูลไปยังฐานข้อมูล
            $data['created_user'] = Auth::user()->emp_code;
            $data['created_at'] = Carbon::now();

            DB::connection('mysql')->table('tbm_bank_list')->insert($data);

            // ส่งคืนข้อมูลสถานะเมื่อบันทึกสำเร็จ
            return [
                'status' => 200,
                'message' => 'Save Success'
            ];
        } catch (Exception $e) {
            // บันทึกข้อความผิดพลาดลงใน Log
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            // ส่งคืนข้อมูลสถานะเมื่อเกิดข้อผิดพลาด
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function getDataEditBank($bankID)
    {
        try {
            $data = DB::connection('mysql')->table('tbm_bank_list')->where('ID', $bankID)->first();
            return $data;
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return false;
        }
    }

    public function saveDataEditBank($data, $bankID)
    {
        // dd($data);
        try {
            // บันทึกข้อมูลไปยังฐานข้อมูล
            $data['updated_user'] = Auth::user()->emp_code;
            $data['updated_at'] = Carbon::now();

            DB::connection('mysql')->table('tbm_bank_list')->where('ID', $bankID)->update($data);

            // ส่งคืนข้อมูลสถานะเมื่อบันทึกสำเร็จ
            return [
                'status' => 200,
                'message' => 'Save Success'
            ];
        } catch (Exception $e) {
            // บันทึกข้อความผิดพลาดลงใน Log
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            // ส่งคืนข้อมูลสถานะเมื่อเกิดข้อผิดพลาด
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function deleteBank($bankID)
    {
        try {
            DB::connection('mysql')->table('tbm_bank_list')->where('ID', $bankID)->update([
                'deleted' => 1,
                'updated_user' => Auth::user()->emp_code,
                'updated_at' => Carbon::now()
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

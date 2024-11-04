<?php

namespace App\Models\Address;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AgentAddressModel extends Model
{
    use HasFactory;

    public function getDataAgentAddress($request)
    {
        try {
            $sql = DB::connection('mysql')->table('tbt_agent_address')->where('deleted', 0);

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
                    'address_department' => $value->address_department,
                    'employee_total'    => number_format($value->employee_total, 0),
                    'space_working' => $value->space_working,
                    'created_at' => $value->created_at,
                    'created_user' => $value->created_user,
                    'updated_at' => !empty($value->updated_at) ? $value->updated_at : '-',
                    'updated_user' => !empty($value->updated_user) ? $value->updated_user : '-',
                    'Permission' => Auth::user()->user_system
                ];
            }
            return [
                'data' => $newArr,
                'recordsTotal' => $dataCount,
                'recordsFiltered' => $dataCount
            ];
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function saveDataAgentAddress($data)
    {
        try {
            $data['employee_total'] = str_replace(',', '', $data['employee_total']);
            $data['created_user'] = Auth::user()->emp_code;
            $data['created_at'] = Carbon::now();
            DB::connection('mysql')->table('tbt_agent_address')->insert($data);
            return [
                'status' => 200,
                'message' => 'Save Success'
            ];
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function getDataAgentAddressById($id)
    {
        try {
            $sql = DB::connection('mysql')->table('tbt_agent_address')->where('deleted', 0)->where('id', $id)->first();
            return $sql;
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function editAgentAddress($data, $id)
    {
        try {
            $data['employee_total'] = str_replace(',', '', $data['employee_total']);
            $data['updated_user'] = Auth::user()->emp_code;
            $data['updated_at'] = Carbon::now();
            DB::connection('mysql')->table('tbt_agent_address')->where('id', $id)->update($data);
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

    public function deleteAgentAddress($id)
    {
        try {
            DB::connection('mysql')->table('tbt_agent_address')->where('id', $id)->update([
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

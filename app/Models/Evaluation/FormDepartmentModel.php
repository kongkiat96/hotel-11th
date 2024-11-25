<?php

namespace App\Models\Evaluation;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FormDepartmentModel extends Model
{
    use HasFactory;

    public function saveSelectEmployee($data)
    {
        try {
            $setData = [
                'select_employee' => $data,
                'evaluation_date' => Carbon::now()->format('Y-m-d'),
                'created_at' => now(),
                'created_user' => Auth::user()->emp_code
            ];

            // dd($setData);
            $saveData = DB::connection('mysql')->table('tbt_evaluation_employee')->insertGetId($setData);

            if ($saveData) {
                $saveToEvaluation = DB::connection('mysql')->table('tbt_evaluation')->insertGetId([
                    'id_eval_emp' => $saveData,
                    'emp_code' => $setData['select_employee'],
                    'created_at' => now(),
                    'created_user' => Auth::user()->emp_code
                ]);
            }
            // dd($saveToEvaluation);
            return $saveToEvaluation;
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500,
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function getDataEvaluation($id)
    {
        try {
            $getData = DB::connection('mysql')->table('tbt_evaluation')->where('id', $id)->first();
            return $getData;
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500,
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function saveFormEvaluation($data)
    {
        try {
            // dd($data);
            $id = decrypt($data['id']);
            $data['updated_at'] = now();
            $data['updated_user'] = Auth::user()->emp_code;
            if (isset($data['drawing'])) {
                $data['drawing'] = '1';
            } else {
                $data['drawing'] = '2';
            }
            unset($data['id']);
            $saveData = DB::connection('mysql')->table('tbt_evaluation')->where('id', $id)->update($data);
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
}

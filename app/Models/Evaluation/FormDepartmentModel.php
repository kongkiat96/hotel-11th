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
            $setCountText = strlen($id);
            if($setCountText > 5){
                $id = decrypt($id);
            } else {
                $id = $id;
            }
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
            $id = $data['id'];
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

    public function getDataEvaluationTable($param){
        try {
            $sql = DB::connection('mysql')->table('tbt_evaluation AS i')->where('deleted', 0)
                ->select(
                    DB::raw("DATE_FORMAT(created_at, '%Y-%m') AS GroupMonth"),
                    DB::raw("SUM(CASE WHEN drawing = 1 THEN 1 ELSE 0 END) AS draft_count"),
                    DB::raw("SUM(CASE WHEN drawing = 2 THEN 1 ELSE 0 END) AS save_count"),
                    DB::raw("COUNT(*) AS total_evaluations")
                )
                ->groupBy('GroupMonth');
            if ($param['start'] == 0) {
                $sql = $sql->limit($param['length'])->orderBy('GroupMonth', 'desc')->get();
            } else {
                $sql = $sql->offset($param['start'])
                    ->limit($param['length'])
                    ->orderBy('GroupMonth', 'desc')->get();
            }
            // $sql = $sql->orderBy('created_at', 'desc');
            $dataCount = $sql->count();
            // dd($sql);
            $newArr = [];
            foreach ($sql as $key => $value) {
                $newArr[] = [
                    'SearchMonth' => $value->GroupMonth,
                    'GroupMonth' => Carbon::parse($value->GroupMonth)->translatedFormat('F') . ' ' . (Carbon::parse($value->GroupMonth)->year + 543),
                    'draft_count' => $value->draft_count,
                    'save_count' => $value->save_count,
                    'total_evaluations' => $value->total_evaluations
                ];
            }

            $returnData = [
                "recordsTotal" => $dataCount,
                "recordsFiltered" => $dataCount,
                "data" => $newArr
            ];
            // dd($returnData);
            return $returnData;
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function getDataSearchEvaluationDetail($param){
        try {
            $sql = DB::connection('mysql')->table('tbt_evaluation AS i')
                ->leftJoin('tbt_employee AS emp', 'i.emp_code', '=', 'emp.employee_code')
                ->select('i.id',
                'i.drawing',
                'i.created_at',
                'i.created_user',
                'i.updated_at',
                'i.updated_user',
                DB::raw("CONCAT(emp.first_name, ' ', emp.last_name) AS emp_name"))
                ->where('i.deleted', 0)
                ->where(DB::raw("DATE_FORMAT(i.created_at, '%Y-%m')"), $param['searchMonth']);

            switch ($param['searchTag']) {
                case 'draft_month':
                    $sql = $sql->where('drawing', 1);
                    break;
                case 'save_month':
                    $sql = $sql->where('drawing', 2);
                    break;
                default:
                    $sql = $sql->where('i.deleted', 0);
                    break;
            }

            if ($param['start'] == 0) {
                $sql = $sql->limit($param['length'])->orderBy('i.created_at', 'desc')->get();
            } else {
                $sql = $sql->offset($param['start'])
                    ->limit($param['length'])
                    ->orderBy('i.created_at', 'desc')->get();
            }
            // $sql = $sql->orderBy('created_at', 'desc');
            $dataCount = $sql->count();
            // dd($sql);
            $newArr = [];

            foreach ($sql as $key => $value) {
                $newArr[] = [
                    'ID' =>  $value->id,
                    'emp_name' => $value->emp_name,
                    'date_evaluation' => $value->created_at,
                    'evaluation_status' => $value->drawing,
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
                "data" => $newArr
            ];
            // dd($returnData);
            return $returnData;
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function deleteEvaluation($evaluationID){
        try {
            // $evaluationID = decrypt($evaluationID);
            $getData = DB::connection('mysql')->table('tbt_evaluation')->where('id', $evaluationID)->first();
            
            if($getData){
                $deleteMain = DB::connection('mysql')->table('tbt_evaluation')->where('id', $evaluationID)->update([
                    'deleted' => 1,
                    'drawing' => 0,
                    'updated_at' => now(),
                    'updated_user' => Auth::user()->emp_code
                    ]);
                $deleteSub = DB::connection('mysql')->table('tbt_evaluation_employee')->where('id_eval_emp', $getData->id_eval_emp)->update([
                    'deleted' => 1
                ]);

                $returnMessage = [
                    'status' => 200,
                    'message' => 'Delete Success'
                ];
            } else {
                $returnMessage = [
                    'status' => 404,
                    'message' => 'Data Not Found'
                ];
            }
            return $returnMessage;
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500,
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }
}

<?php

namespace App\Models\Settings;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
class AboutAppModel extends Model
{
    use HasFactory;

    public function saveAboutAppData($data)
    {
        try {
            // ตรวจสอบว่ามีข้อมูลอยู่แล้วหรือไม่
            $existingData = DB::connection('mysql')->table('tbm_about_app')->first();
    
            // สร้าง UUID
            $data['uuid'] = Str::uuid()->toString();
            $data['created_user'] = Auth::user()->emp_code;
            $data['created_at'] = Carbon::now();
    
            if ($existingData) {
                $data['updated_user'] = Auth::user()->emp_code;
                $data['updated_at'] = Carbon::now();
                // มีข้อมูลแล้ว ทำการอัปเดต
                DB::connection('mysql')->table('tbm_about_app')->where('uuid', $existingData->uuid)->update($data);
    
                $returnData = [
                    'status' => 200,
                    'message' => 'Update Success',
                    'dataID' => $existingData->uuid
                ];
            } else {
                // ไม่มีข้อมูล ทำการเพิ่มข้อมูลใหม่
                $saveData = DB::connection('mysql')->table('tbm_about_app')->insertGetId($data);
    
                $returnData = [
                    'status' => 200,
                    'message' => 'Save Success',
                    'dataID' => $saveData
                ];
            }
    
            return $returnData;
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500,
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function getDataAboutApp()
    {
        $data = DB::connection('mysql')->table('tbm_about_app')->first();
        return $data;
    }
}

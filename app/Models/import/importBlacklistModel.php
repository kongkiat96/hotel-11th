<?php

namespace App\Models\import;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class importBlacklistModel extends Model
{
    use HasFactory;

    public function getData($param){
        try {
            $sql = DB::table('tbt_blacklist')->where('deleted', 0);
            if ($param['start'] == 0) {
                $sql = $sql->limit($param['length'])->orderBy('created_at', 'desc')->get();
            } else {
                $sql = $sql->offset($param['start'])
                    ->limit($param['length'])
                    ->orderBy('created_at', 'desc')->get();
            }
            // $sql = $sql->orderBy('created_at', 'desc');
            $dataCount = $sql->count();
            $newArr = [];
            foreach ($sql as $key => $value) {
                $newArr[] = [
                    'ID' => $value->id,
                    'first_name' => $value->first_name,
                    'last_name' => $value->last_name,
                    'detail' => wordwrap($value->detail, 300, "<br>", true) ?? '-',
                    'flag_blacklist' => $value->flag_blacklist,
                    'created_at' => $value->created_at,
                    'created_user' => $value->created_user,
                    'updated_at' => !empty($value->update_at) ? $value->update_at : '-',
                    'updated_user' => !empty($value->update_user) ? $value->update_user : '-',
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
            Log::error('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return false;
        }
    }

    public function getDataBlacklistByID($blacklistID){
        $searchData = DB::table('tbt_blacklist')->where('id', $blacklistID)->first();
        return $searchData;
    }

    public function editBlacklist($param, $blacklistID){
        try {
            DB::table('tbt_blacklist')->where('id', $blacklistID)->update([
                'first_name' => $param['first_name'],
                'last_name' => $param['last_name'],
                'detail' => $param['detail'],
                'flag_blacklist' => $param['flag_blacklist'],
                'update_at' => date('Y-m-d H:i:s'),
                'update_user' => Auth::user()->emp_code,
            ]);
            $returnData = [
                "status" => 200,
                "message" => 'Success',
            ];
            return $returnData;
        } catch (Exception $e) {
            Log::error('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteBlacklist($blacklistID){
        try {
            DB::table('tbt_blacklist')->where('id', $blacklistID)->update([
                'deleted' => 1,
                'update_at' => date('Y-m-d H:i:s'),
                'update_user' => Auth::user()->emp_code,
            ]);
            $returnData = [
                "status" => 200,
                "message" => 'Success',
            ];
            return $returnData;
        } catch (Exception $e) {
            Log::error('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return false;
        }
    }
}

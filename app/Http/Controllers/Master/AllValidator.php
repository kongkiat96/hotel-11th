<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AllValidator extends Controller
{
    public function validateSettingWorkStatus(array $data, $funcUse)
    {
        $rules = [];

        switch ($funcUse) {
            case 'funcAddStatus':
                $rules = [
                    'statusName','flagType','statusUse' => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s.]+$/u',
                    'statusOfStatus'    => 'required|integer',
                ];
                break;
            case 'funcEditStatus':
                $rules = [
                    'edit_statusName','edit_statusUse'    => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s.]+$/u',
                    'edit_flagType','edit_statusOfStatus'   => 'required|integer',
                ];
                break;
            case 'funcAddFlagType':
                $rules = [
                    'flagName','typeWork' => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s.]+$/u',
                ];
                break;
            case 'funcEditFlagType':
                $rules = [
                    'edit_flagName','edit_typeWork' => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s.]+$/u',
                ];
                break;
        }

        return Validator::make($data, $rules);
    }

    public function validateSettingAboutCompany(array $data, $funcUse){
        $rules = [];

        switch($funcUse){
            case 'funcAddCompany':
                $rules = [
                    'companyNameTH','companyNameEN' => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s.]+$/u',
                    'statusOfCompany'   => 'required|integer',
                ];
                break;
            case 'funcEditCompany':
                $rules = [
                    'edit_companyNameTH','edit_companyNameEN'   => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s.]+$/u',
                    'edit_statusOfCompany'   => 'required|integer',
                ];
                break;
            case 'funcAddDepartment':
                $rules = [
                    'departmentName'    => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s.]+$/u',
                    'company','statusOfDepartment'  => 'required|integer',
                    // 'statusOfDepartment'   => 'required|integer',
                ];
                break;
            case 'funcEditDepartment':
                $rules = [
                    'edit_departmentName'   => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s.]+$/u',
                    'edit_company','edit_statusOfDepartment'     => 'required|integer',
                ];
                break;
            case 'funcAddGroup':
                $rules = [
                    'groupName' => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s.]+$/u',
                    'companyForGroup', 'department', 'statusOfGroup'    => 'required|integer',
                ];
                break;
            case 'funcEditGroup':
                $rules = [
                    'edit_groupName' => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s.]+$/u',
                    'edit_companyForGroup', 'edit_department', 'edit_statusOfGroup'    => 'required|integer',
                ];
                break;
            case 'funcAddPrefixName':
                $rules = [
                    'prefixName' => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s.]+$/u',
                    'statusOfPrefixName'    => 'required|integer',
                ];
                break;
            case 'funcEditPrefixName':
                $rules = [
                    'edit_prefixName' => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s.]+$/u',
                    'edit_statusOfPrefixName'    => 'required|integer',
                ];
                break;
            case 'funcAddClassList':
                $rules = [
                    'className' => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s.]+$/u',
                    'statusOfClassList'    => 'required|integer',
                ];
                break;
            case 'funcEditClassList':
                $rules = [
                    'edit_className' => 'required|string|regex:/^[a-zA-Z0-9ก-๏\s.]+$/u',
                    'edit_statusOfClassList'    => 'required|integer',
                ];
                break;
        }

        return Validator::make($data, $rules);
    }
}

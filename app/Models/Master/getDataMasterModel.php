<?php

namespace App\Models\Master;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class getDataMasterModel extends Model
{
    use HasFactory;

    private $getDatabase;

    public function __construct()
    {
        $this->getDatabase = DB::connection('mysql');
    }

    public function getDataPrefixName()
    {
        $getPrefixName = $this->getDatabase->table('tbm_prefix_name')
            ->select('prefix_name', 'ID')
            ->where('status', 1)
            ->where('deleted', 0)
            ->get();
        return $getPrefixName;
    }

    public function getDataProvince()
    {
        $getProvince = $this->getDatabase->table('tbm_province')
            ->select('province_code', 'province')
            ->where('deleted', 0)
            ->groupBy('province_code', 'province')
            ->get();
        return $getProvince;
    }

    public function getDataAmphoe($provinceCode)
    {
        $getAmphoe = $this->getDatabase->table('tbm_province')
            ->select('amphoe_code', 'amphoe')
            ->where('province_code', $provinceCode)
            ->where('deleted', 0)
            ->groupBy('amphoe_code', 'amphoe')
            ->get();

        return $getAmphoe;
    }

    public function getDataTambon($aumphoeCode)
    {
        $getTambon = $this->getDatabase->table('tbm_province')
            ->select('id', 'tambon_code', 'tambon', 'zipcode')
            ->where('amphoe_code', $aumphoeCode)
            ->where('deleted', 0)
            ->groupBy('id', 'tambon_code', 'tambon', 'zipcode')
            ->get();

        return $getTambon;
    }

    public function getProvinceID($tambonCode) {
        // dd($tambonCode);
        $getProvinceID = $this->getDatabase->table('tbm_province')
        ->select('id', 'tambon_code', 'tambon', 'zipcode')
        ->where('tambon_code', $tambonCode)
        ->get();

        return $getProvinceID;
    }

    public function getClassList()
    {
        $getClassList = $this->getDatabase->table('tbm_class_list')
            ->select('class_name', 'ID')
            ->where('status', 1)
            ->where('deleted', 0)
            ->get();
        return $getClassList;
    }

    public function getDataFlagType()
    {
        $getFlagType = $this->getDatabase->table('tbm_flag_type')
            ->select('flag_name', 'type_work', 'ID')
            ->where('deleted', 0)
            ->get();
        return $getFlagType;
    }

    public function getDataCompany()
    {
        Log::info('getDataCompany: Retrieving companies from the database.');
        try {
            $getCompany = $this->getDatabase->table('tbm_company')
                ->select('ID', 'company_name_th', 'company_name_en')
                ->where('status', 1)
                ->where('deleted', 0)
                ->get();

            Log::info('getDataCompany: Successfully retrieved companies.');

            return $getCompany;
        } catch (Exception $exception) {
            Log::error('getDataCompany: Failed to retrieve companies - ' . $exception->getMessage());

            throw $exception;
        }
    }

    public function getDataDepartment()
    {
        Log::info('getDataDepartment: Starting to retrieve departments.');
        try {
            $getDepartment = $this->getDatabase->table('tbm_department AS depart')
                ->leftJoin('tbm_company AS company', 'depart.company_id', '=', 'company.ID')
                ->select(
                    'depart.ID',
                    'depart.department_name AS departmentName',
                    'company.company_name_th AS companyName'
                )
                ->where('depart.deleted', 0)
                ->where('company.status', 1)
                ->where('company.deleted', 0)
                ->get();

            Log::info('getDataDepartment: Successfully retrieved departments.');
            // dd($getDepartment);
            return $getDepartment;
        } catch (Exception $e) {
            Log::error('getDataDepartment: Failed to retrieve departments - ' . $e->getMessage());
            throw $e;
        }
    }

    public function getDataCompanyForID($id)
    {
        // dd($id);
        $returnCompany = $this->getDatabase->table('tbm_department AS depart')
            ->leftJoin('tbm_company AS company', 'depart.company_id', '=', 'company.ID')
            ->select(
                'company.ID',
                'depart.department_name AS departmentName',
                'company.company_name_th AS company_name_th'
            )
            ->where('depart.ID', $id)
            ->where('depart.deleted', 0)
            ->where('company.deleted', 0)
            ->get();

        // dd($returnCompany);

        return $returnCompany;
    }

    public function getDataDepartmentForID($id)
    {
        $returnDepartment = $this->getDatabase->table('tbm_department AS depart')
            ->leftJoin('tbm_company AS company', 'depart.company_id', '=', 'company.ID')
            ->select(
                'depart.ID',
                'depart.department_name AS departmentName',
                'company.company_name_th AS company_name_th'
            )
            ->where('company.ID', $id)
            ->where('depart.status', 1)
            ->where('depart.deleted', 0)
            ->where('company.deleted', 0)
            ->get();

        // dd($returnDepartment);

        return $returnDepartment;
    }

    public function getDataGroupOfDepartment($departmentID)
    {
        $returnGroup = $this->getDatabase->table('tbm_group')
            ->select('ID', 'group_name', 'department_id')
            ->where('department_id', $departmentID)
            ->where('deleted', 0)
            ->where('status', 1)
            ->get();
        return $returnGroup;
    }

    public function getGroupMapID($groupDepartment){
        dd($groupDepartment);
    }
}

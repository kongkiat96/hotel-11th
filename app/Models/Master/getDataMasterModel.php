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

    public function getProvinceID($tambonCode)
    {
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

    public function getMenuMain()
    {

        $getMenuMain = $this->getDatabase->table('tbm_menu_main')
            ->select('ID', 'menu_name')
            ->where('deleted', 0)
            ->get();
        return $getMenuMain;
    }

    public function getMenuToAccess()
    {
        $getMenu = $this->getDatabase->table('tbm_menu_sub AS tms')
            ->leftJoin('tbm_menu_main AS tmm', 'tms.menu_main_id', '=', 'tmm.ID')
            ->select('tms.ID', 'tms.menu_sub_name', 'tms.menu_sub_link', 'tms.menu_main_ID', 'tmm.menu_name', 'tmm.menu_icon', 'tmm.menu_link', 'tms.menu_sub_icon', 'tms.status')
            ->where('tms.deleted', 0)
            ->orderBy('tmm.menu_sort', 'asc')
            ->orderBy('tms.ID', 'asc')
            ->get();
        return $getMenu;
    }

    public function getUserList($idMapEmployee)
    {
        $getEmployee = $this->getDatabase->table('users')->where('map_employee', $idMapEmployee)->get();
        return $getEmployee;
    }

    public function getAccessMenu($idMapEmployee)
    {
        $getAccessMenu = $this->getDatabase->table('tbt_user_access_menu')
            ->where('employee_code', $idMapEmployee)
            ->get();
        return $getAccessMenu;
    }

    public static function getMenusName($menuID)
    {
        $isDataBase = DB::connection('mysql');
        $returnMenus = $isDataBase->table('tbm_menu_sub AS tms')
            ->leftJoin('tbm_menu_main AS tmm', 'tms.menu_main_ID', '=', 'tmm.ID')
            ->whereIn('tms.ID', $menuID)
            ->where('tmm.deleted', 0)
            ->where('tmm.status', 1)
            ->where('tms.deleted', 0)
            ->where('tms.status', 1)
            ->select('tmm.ID', 'tmm.menu_link', 'menu_icon', 'tmm.menu_name', 'tms.menu_sub_name', 'tms.menu_sub_link', 'tms.menu_sub_icon')
            ->orderBy('tmm.menu_sort', 'asc')
            ->orderBy('tms.ID', 'asc')
            ->get();
        // จัดกลุ่มเมนูหลักและย่อย
        $groupedMenus = [];
        foreach ($returnMenus as $menu) {
            $groupedMenus[$menu->menu_name]['main'] = [
                'ID' => $menu->ID,
                'menu_link' => $menu->menu_link,
                'menu_icon' => $menu->menu_icon,
                'menu_name' => $menu->menu_name,
            ];
            $groupedMenus[$menu->menu_name]['subs'][] = [
                'menu_sub_name' => $menu->menu_sub_name,
                'menu_sub_link' => $menu->menu_sub_link,
                'menu_sub_icon' => $menu->menu_sub_icon,
            ];
        }

        // dd($groupedMenus);
        return $groupedMenus;
    }

    public function getDataBankList()
    {
        $getDataBankList = $this->getDatabase->table('tbm_bank_list')->where('status',1)->where('deleted',0)->orderBy('ID')->get();
        return $getDataBankList;
    }

    public function getFreezeAccountList()
    {
        $getFreezeAccountList = $this->getDatabase->table('tbt_freeze_account')->where('deleted',0)->orderBy('id')->get();
        return $getFreezeAccountList;
    }

    public function getDataMasterInvoiceList()
    {
        $getData = $this->getDatabase->table('tbm_invoice_list')->where('deleted',0)->get();
        return $getData;
    }
}

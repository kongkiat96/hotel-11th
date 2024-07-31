<?php
namespace App\Helpers;

use App\Models\Master\getDataMasterModel;
use Illuminate\Support\Facades\Auth;

class getAccessToMenu
{
    public static function hasAccessToMenu($urlSubLink)
    {
        $user = Auth::user();
        $accessMenuSubIDs = $user->accessMenus->pluck('menu_sub_ID')->toArray();
        $getAccessMenus = getDataMasterModel::getMenusName($accessMenuSubIDs);
        
        foreach ($getAccessMenus as $menu) {
            if (isset($menu['subs'])) {
                foreach ($menu['subs'] as $sub) {
                    if ($sub['menu_sub_link'] == $urlSubLink) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public static function getAccessMenus()
    {
        $user = Auth::user();
        $accessMenuSubIDs = $user->accessMenus->pluck('menu_sub_ID')->toArray();
        return getDataMasterModel::getMenusName($accessMenuSubIDs);
    }
}
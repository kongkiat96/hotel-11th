<?php

namespace App\Http\Controllers;

use App\Models\Master\getDataMasterModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $url = request()->segments();
        $urlName = "ข้อมูลผู้ใช้งาน";
        $accessMenuSubIDs = $user->accessMenus->pluck('menu_sub_ID')->toArray();
        $getAccessMenus = getDataMasterModel::getMenusName($accessMenuSubIDs);
        // dd($getAccessMenus);
        return view('app.home.index',[
            'name'      => $user->name,
            'urlName'   => $urlName,
            'url'       => $url,
            'listMenus'  => $getAccessMenus
        ]);
    }
}

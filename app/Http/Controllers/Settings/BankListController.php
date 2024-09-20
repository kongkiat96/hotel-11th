<?php

namespace App\Http\Controllers\Settings;

use App\Helpers\getAccessToMenu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankListController extends Controller
{
    public function index()
    {
        $url = request()->segments();
        $urlName = "รายการบัญชีธนาคาร";
        $urlSubLink = "bank-list";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $getAccessMenus = getAccessToMenu::getAccessMenus();
        // dd($getAccessMenus);

        return view('app.settings.bank-list.setBankList', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus
        ]);
    }
}

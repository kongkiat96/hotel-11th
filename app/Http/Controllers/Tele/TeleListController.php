<?php

namespace App\Http\Controllers\Tele;

use App\Helpers\getAccessToMenu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeleListController extends Controller
{
    public function index()
    {
        $url        = request()->segments();
        $urlName    = "รายการแผนกที่รับโทรศัพท์ทำงาน";
        $urlSubLink = "telelist";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $getAccessMenus = getAccessToMenu::getAccessMenus();

        return view('app.tele.teleList.index', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus
        ]);
    }
}

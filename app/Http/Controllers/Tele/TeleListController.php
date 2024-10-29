<?php

namespace App\Http\Controllers\Tele;

use App\Helpers\getAccessToMenu;
use App\Http\Controllers\Controller;
use App\Models\Master\getDataMasterModel;
use App\Models\Tele\TeleListModel;
use Illuminate\Http\Request;

class TeleListController extends Controller
{
    private $getMaster;
    private $telelistModel;
    public function __construct()
    {
        $this->getMaster = new getDataMasterModel;
        $this->telelistModel = new TeleListModel();
    }

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

    public function getDataTelelist(Request $request)
    {
        $getDataTeleList = $this->telelistModel->getDataTelelist($request);

        return response()->json($getDataTeleList);
    }

    public function showAddTelelistModal()
    {
        if (request()->ajax()) {
            $getFreezeAccountList     = $this->getMaster->getFreezeAccountList();
            // dd($getFreezeAccountList);

            return view('app.tele.teleList.dialog.save.addTelelist', [
                'getFreezeAccountList'        => $getFreezeAccountList,
            ]);
        }
        return abort(404);
    }

    public function saveDataTelelist(Request $request)
    {
        $saveData = $this->telelistModel->saveDataTelelist($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }
}

<?php

namespace App\Http\Controllers\RentAccount;

use App\Helpers\getAccessToMenu;
use App\Http\Controllers\Controller;
use App\Models\RentAccount\RentAccountModel;
use Illuminate\Http\Request;

class RentAccountController extends Controller
{
    private $rentAccountModel;
    public function __construct()
    {
        $this->rentAccountModel = new RentAccountModel();
    }
    public function index()
    {
        $url        = request()->segments();
        $urlName    = "รายการแผนกแจ้งขอเช่าบัญชีธนาคาร";
        $urlSubLink = "rent-account";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $getAccessMenus = getAccessToMenu::getAccessMenus();

        return view('app.rentAccount.index', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus
        ]);
    }

    public function getDataRentAccount(Request $request)
    {
        $getDataRentAccount = $this->rentAccountModel->getDataRentAccount($request);
        return response()->json($getDataRentAccount);
    }

    public function showAddRentAccountModal()
    {
        if (request()->ajax()) {
            // dd($getFreezeAccountList);

            return view('app.rentAccount.dialog.save.addRentAccount');
        }
        return abort(404);
    }

    public function saveDataRentAccount(Request $request)
    {
        $saveData = $this->rentAccountModel->saveDataRentAccount($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function showEditRentAccountModal($rentAccountID)
    {
        if (request()->ajax()) {
            $getDataRentAccount = $this->rentAccountModel->getDataRentAccountById($rentAccountID);
            return view('app.rentAccount.dialog.edit.editRentAccount', ['dataRentAccount' => $getDataRentAccount]);
        }
        return abort(404);
    }

    public function editRentAccount(Request $request,$rentAccountID)
    {
        $saveData = $this->rentAccountModel->editRentAccount($request->input(), $rentAccountID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function deleteRentAccount($rentAccountID)
    {
        $deleteRentAccount = $this->rentAccountModel->deleteRentAccount($rentAccountID);
        return response()->json(['status' => $deleteRentAccount['status'], 'message' => $deleteRentAccount['message']]);
    }

    public function viewRentAccount($rentAccountID)
    {
        $getDataRentAccount = $this->rentAccountModel->getDataRentAccountById($rentAccountID);
        return view('app.rentAccount.dialog.view.viewRentAccount', ['dataRentAccount' => $getDataRentAccount]);
    }
}

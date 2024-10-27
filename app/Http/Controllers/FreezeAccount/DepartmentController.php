<?php

namespace App\Http\Controllers\FreezeAccount;

use App\Helpers\getAccessToMenu;
use App\Http\Controllers\Controller;
use App\Models\FreezeAccount\DepartmentModel;
use App\Models\Master\getDataMasterModel;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $getMaster;
    protected $departmentModel;
    public function __construct()
    {
        $this->getMaster = new getDataMasterModel;
        $this->departmentModel = new DepartmentModel();
    }

    public function index()
    {
        $url        = request()->segments();
        $urlName    = "บัญชีโดนอายัด สำหรับแผนก";
        $urlSubLink = "department";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $getAccessMenus = getAccessToMenu::getAccessMenus();

        return view('app.freezeAccount.department.index', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus
        ]);
    }

    public function showAddFreezeAccountDepartmentModal()
    {
        if (request()->ajax()) {
            $getBankList     = $this->getMaster->getDataBankList();
            // dd($getBankList);   

            return view('app.freezeAccount.department.dialog.save.addFreezeAccountDepartment', [
                'getBankList'        => $getBankList,
            ]);
        }
        return abort(404);
    }

    public function saveDataFreezeAccountDepartment(Request $request)
    {
        $saveData = $this->departmentModel->saveDataFreezeAccount($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function getDataFreezeAccountDepartment(Request $request)
    {
        $getDataBanks = $this->departmentModel->getDataFreezeAccountDepartment($request);

        return response()->json($getDataBanks);
    }

    public function showEditFreezeAccountDepartmentModal($freezeAccountID)
    {
        if (request()->ajax()) {
            $getBankList = $this->getMaster->getDataBankList();
            $getFreezeAccount = $this->departmentModel->getFreezeAccount($freezeAccountID);
            // dd($getBankList);   
            return view('app.freezeAccount.department.dialog.edit.editFreezeAccountDepartment', [
                'dataBank' => $getBankList,
                'dataFreezeAccount' => $getFreezeAccount,
            ]);
        }
        return abort(404);
    }

    public function editFreezeAccountDepartment(Request $request, $freezeAccountID)
    {
        // dd($freezeAccountID);
        $saveData = $this->departmentModel->editFreezeAccountDepartment($request->input(), $freezeAccountID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function deleteFreezeAccountDepartment($freezeAccountID)
    {
        $deleteData = $this->departmentModel->deleteFreezeAccountDepartment($freezeAccountID);
        return response()->json(['status' => $deleteData['status'], 'message' => $deleteData['message']]);
    }

    public function viewFreezeAccountDepartment($freezeAccountID)
    {
        if (request()->ajax()) {
            $getBankList = $this->getMaster->getDataBankList();
            $getFreezeAccount = $this->departmentModel->getFreezeAccount($freezeAccountID);
            // dd($getBankList);   
            return view('app.freezeAccount.department.dialog.view.viewFreezeAccountDepartment', [
                'dataBank' => $getBankList,
                'dataFreezeAccount' => $getFreezeAccount,
            ]);
        }
        return abort(404);
    }
}

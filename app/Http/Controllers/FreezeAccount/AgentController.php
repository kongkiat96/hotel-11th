<?php

namespace App\Http\Controllers\FreezeAccount;

use App\Helpers\getAccessToMenu;
use App\Http\Controllers\Controller;
use App\Models\FreezeAccount\AgentModel;
use App\Models\Master\getDataMasterModel;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    protected $getMaster;
    protected $agentModel;

    public function __construct()
    {
        $this->getMaster = new getDataMasterModel;
        $this->agentModel = new AgentModel();
    }
    public function index()
    {
        $url        = request()->segments();
        $urlName    = "บัญชีโดนอายัด สำหรับเอเย่นต์";
        $urlSubLink = "agent";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $getAccessMenus = getAccessToMenu::getAccessMenus();

        return view('app.freezeAccount.agent.index', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus
        ]);
    }

    public function showAddFreezeAccountAgentModal()
    {
        if (request()->ajax()) {
            $getBankList     = $this->getMaster->getDataBankList();
            // dd($getBankList);   

            return view('app.freezeAccount.agent.dialog.save.addFreezeAccountAgent', [
                'getBankList'        => $getBankList,
            ]);
        }
        return abort(404);
    }

    public function saveDataFreezeAccountAgent(Request $request)
    {
        $saveData = $this->agentModel->saveDataFreezeAccount($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function getDataFreezeAccountAgent(Request $request)
    {
        $getDataBanks = $this->agentModel->getDataFreezeAccountAgent($request);

        return response()->json($getDataBanks);
    }

    public function showEditFreezeAccountAgentModal($freezeAccountID)
    {
        if (request()->ajax()) {
            $getBankList = $this->getMaster->getDataBankList();
            $getFreezeAccount = $this->agentModel->getFreezeAccount($freezeAccountID);
            // dd($getBankList);   
            return view('app.freezeAccount.agent.dialog.edit.editFreezeAccountAgent', [
                'dataBank' => $getBankList,
                'dataFreezeAccount' => $getFreezeAccount,
            ]);
        }
        return abort(404);
    }

    public function editFreezeAccountAgent(Request $request, $freezeAccountID)
    {
        // dd($freezeAccountID);
        $saveData = $this->agentModel->editFreezeAccountAgent($request->input(), $freezeAccountID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function deleteFreezeAccountAgent($freezeAccountID)
    {
        $deleteData = $this->agentModel->deleteFreezeAccountAgent($freezeAccountID);
        return response()->json(['status' => $deleteData['status'], 'message' => $deleteData['message']]);
    }

    public function viewFreezeAccountAgent($freezeAccountID)
    {
        if (request()->ajax()) {
            $getBankList = $this->getMaster->getDataBankList();
            $getFreezeAccount = $this->agentModel->getFreezeAccount($freezeAccountID);
            // dd($getBankList);   
            return view('app.freezeAccount.agent.dialog.view.viewFreezeAccountAgent', [
                'dataBank' => $getBankList,
                'dataFreezeAccount' => $getFreezeAccount,
            ]);
        }
        return abort(404);
    }
}

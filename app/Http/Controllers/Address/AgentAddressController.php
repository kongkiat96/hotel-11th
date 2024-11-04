<?php

namespace App\Http\Controllers\Address;

use App\Helpers\getAccessToMenu;
use App\Http\Controllers\Controller;
use App\Models\Address\AgentAddressModel;
use Illuminate\Http\Request;

class AgentAddressController extends Controller
{
    protected $agentAddress;
    public function __construct()
    {
        $this->agentAddress = new AgentAddressModel();
    }
    public function index()
    {
        $url        = request()->segments();
        $urlName    = "รายการที่อยู่เอเย่นต์";
        $urlSubLink = "agent-address";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $getAccessMenus = getAccessToMenu::getAccessMenus();

        return view('app.address.agentAddress.index', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus
        ]);
    }

    public function getDataAgentAddress(Request $request)
    {
        $getDataAgentAddress = $this->agentAddress->getDataAgentAddress($request);
        return response()->json($getDataAgentAddress);
    }

    public function showAddAgentAddressModal()
    {
        if (request()->ajax()) {
            return view('app.address.agentAddress.dialog.save.addAgentAddress');
        }
        return abort(404);
    }

    public function saveDataAgentAddress(Request $request)
    {
        $saveData = $this->agentAddress->saveDataAgentAddress($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function showEditAgentAddressModal($agentAddressID)
    {
        if (request()->ajax()) {
            $getDataAgentAddress = $this->agentAddress->getDataAgentAddressById($agentAddressID);
            return view('app.address.agentAddress.dialog.edit.editAgentAddress', ['dataAgentAddress' => $getDataAgentAddress]);
        }
        return abort(404);
    }

    public function editAgentAddress($agentAddressID, Request $request)
    {
        $saveData = $this->agentAddress->editAgentAddress($request->input(), $agentAddressID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function viewAgentAddress($agentAddressID)
    {
        $viewAgentAddress = $this->agentAddress->getDataAgentAddressById($agentAddressID);
        return view('app.address.agentAddress.dialog.view.viewAgentAddress', ['dataAgentAddress' => $viewAgentAddress]);
    }

    public function deleteAgentAddress($agentAddressID)
    {
        $deleteAgentAddress = $this->agentAddress->deleteAgentAddress($agentAddressID);
        return response()->json($deleteAgentAddress);
    }
}

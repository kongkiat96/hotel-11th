<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Master\getDataMasterModel;
use App\Models\Settings\MenuModel;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $menuModel;
    private $getMaster;
    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->getMaster = new getDataMasterModel();
    }
    public function index()
    {
        $url = request()->segments();
        $urlName = "รายการเข้าถึงเมนู";
        $urlSubLink = "menu";
        return view('app.settings.menu.setMenu', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink
        ]);
    }
    public function showMenuModal()
    {
        if (request()->ajax()) {
            return view('app.settings.menu.dialog.save.addMenuMain');
        }
        return abort(404);
    }
    public function showMenuSubModal()
    {
        if (request()->ajax()) {
            $getMenuMain     = $this->getMaster->getMenuMain();
            return view('app.settings.menu.dialog.save.addMenuSub',[
                'getMenuMain'    => $getMenuMain
            ]);
        }
        return abort(404);
    }

    public function showAccessMenuModal($idMapEmployee)
    {
        // dd($idMapEmployee);
        if (request()->ajax()) {
            $getMenuToAccess    = $this->getMaster->getMenuToAccess();
            $getUser = $this->getMaster->getUserList($idMapEmployee);
            $getAccessMenu = $this->getMaster->getAccessMenu($getUser[0]->emp_code);
            // dd($getAccessMenu);
            return view('app.settings.menu.dialog.save.addAccessMenu',[
                'getMenuToAccess'    => $getMenuToAccess,
                'getUser'            => $getUser,
                'getAccessMenu'      => $getAccessMenu
            ]);
        }
        return abort(404);
    }

    public function showDataMenu(Request $request)
    {
        $getDataToTable = $this->menuModel->getDataMenuMain($request);
        return response()->json($getDataToTable);
    }

    public function showDataMenuSub(Request $request)
    {
        $getDataToTable = $this->menuModel->getDataMenuSub($request);
        return response()->json($getDataToTable);
    }

    public function saveDataMenuMain(Request $request){
        $saveData = $this->menuModel->saveMenuMain($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function saveDataMenuSub(Request $request){
        $saveData = $this->menuModel->saveMenuSub($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function saveDataAccessMenu(Request $request){
        // if(!empty($request->input('access_menu_list'))){
            $saveData = $this->menuModel->saveAccessMenu($request->input());
            return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
        // } else {
            // return response()->json(['status' => 4001, 'message' => 'กรุณาเลือกเมนูที่ต้องการ']);
        // }
        
    }

    public function showEditMenuMain($menuMainID)
    {
        if (request()->ajax()) {
            $returnData     =  $this->menuModel->showEditMenuMain($menuMainID);
            return view('app.settings.menu.dialog.edit.editMenuMain', [
                'dataMenuMain'        => $returnData,
            ]);
        }
        return abort(404);
    }

    public function editMenuMain(Request $request,$menuMainID)
    {
        $saveData = $this->menuModel->saveEditDataMenuMain($request->input(), $menuMainID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function deleteMenuMain($menuMainID)
    {
        $saveData = $this->menuModel->deleteMenuMain($menuMainID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function showEditMenuSub($menuSubID)
    {
        if (request()->ajax()) {
            $returnData     =  $this->menuModel->showEditMenuSub($menuSubID);
            $getMenuMain     = $this->getMaster->getMenuMain();
            return view('app.settings.menu.dialog.edit.editMenuSub', [
                'dataMenuSub'        => $returnData,
                'getMenuMain'        => $getMenuMain
            ]);
        }
        return abort(404);
    }

    public function editMenuSub(Request $request,$menuSubID)
    {
        $saveData = $this->menuModel->saveEditDataMenuSub($request->input(), $menuSubID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function deleteMenuSub($menuSubID)
    {
        $saveData = $this->menuModel->deleteMenuSub($menuSubID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }
}

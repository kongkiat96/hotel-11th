<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Master\AllValidator;
use App\Models\Master\getDataMasterModel;
use App\Models\Settings\AboutCompanyModel;
use Illuminate\Http\Request;

class AboutCompanyController extends Controller
{
    private $aboutCompany;
    private $getMaster;
    private $funcValidator;

    public function __construct()
    {
        $this->aboutCompany = new AboutCompanyModel;
        $this->getMaster    = new getDataMasterModel;
        $this->funcValidator = new AllValidator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = request()->segments();
        // dd($url);
        $urlName        = "กำหนดค่าภายในองค์กร";
        $urlSubLink     = "about-company";

        // dd($getCompany);
        // $getFlagType = $this->getMaster->getDataFlagType();
        // dd($url);
        return view('app.settings.about-company.setCompany', [
            'url'               => $url,
            'urlName'           => $urlName,
            'urlSubLink'        => $urlSubLink,
        ]);
    }

    public function showCompanyModal()
    {
        if (request()->ajax()) {
            return view('app.settings.about-company.dialog.save.addCompany');
        }
        return abort(404);
    }

    public function showDepartmentModal()
    {
        if (request()->ajax()) {
            $getCompany     = $this->getMaster->getDataCompany();

            return view('app.settings.about-company.dialog.save.addDepartment', [
                'getCompany'        => $getCompany,
            ]);
        }
        return abort(404);
    }

    public function showGroupModal()
    {
        if (request()->ajax()) {
            $getCompany     = $this->getMaster->getDataCompany();
            $getDepartment  = $this->getMaster->getDataDepartment();
            return view('app.settings.about-company.dialog.save.addGroup', [
                'getCompany'        => $getCompany,
                'getDepartment'     => $getDepartment
            ]);
        }
        return abort(404);
    }

    public function showPrefixNameModal()
    {
        if (request()->ajax()) {
            return view('app.settings.about-company.dialog.save.addPrefixName');
        }
        return abort(404);
    }

    public function showClassListModal()
    {
        if (request()->ajax()) {
            return view('app.settings.about-company.dialog.save.addClassList');
        }
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function saveDataCompany(Request $request)
    {
        $validator = $this->funcValidator->validateSettingAboutCompany($request->input(), 'funcAddCompany');

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => $validator->errors()], 400);
        }

        $saveData = $this->aboutCompany->saveDataCompany($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function saveDataDepartment(Request $request)
    {
        $validator = $this->funcValidator->validateSettingAboutCompany($request->input(), 'funcAddDepartment');

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => $validator->errors()], 400);
        }

        $saveData = $this->aboutCompany->saveDataDepartment($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function saveDataGroup(Request $request)
    {
        $validator = $this->funcValidator->validateSettingAboutCompany($request->input(), 'funcAddGroup');

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => $validator->errors()], 400);
        }

        $saveData = $this->aboutCompany->saveDataGroup($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function saveDataPrefixName(Request $request)
    {
        $validator = $this->funcValidator->validateSettingAboutCompany($request->input(), 'funcAddPrefixName');

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => $validator->errors()], 400);
        }

        $saveData = $this->aboutCompany->saveDataPrefixName($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function saveDataClassList(Request $request)
    {
        $validator = $this->funcValidator->validateSettingAboutCompany($request->input(), 'funcAddClassList');

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => $validator->errors()], 400);
        }

        $saveData = $this->aboutCompany->saveDataClassList($request->input());
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function showDataCompany(Request $request)
    {
        $getDataToTable = $this->aboutCompany->getDataCompany($request);
        return response()->json($getDataToTable);
    }

    public function showDataDepartment(Request $request)
    {
        $getDataToTable = $this->aboutCompany->getDataDepartment($request);
        return response()->json($getDataToTable);
    }

    public function showDataGroup(Request $request)
    {
        $getDataToTable = $this->aboutCompany->getDataGroup($request);
        return response()->json($getDataToTable);
    }

    public function showDataPrefixName(Request $request)
    {
        $getDataToTable = $this->aboutCompany->getDataPrefixName($request);
        return response()->json($getDataToTable);
    }

    public function showDataClassList(Request $request)
    {
        $getDataToTable = $this->aboutCompany->getDataClassList($request);
        return response()->json($getDataToTable);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function showEditCompany($companyID)
    {
        // $getCompany = $this->aboutCompany->showEditCompany($companyID);
        // // dd($getCompany);
        // return response()->json($getCompany);
        if (request()->ajax()) {
            $returnData     =  $this->aboutCompany->showEditCompany($companyID);
            return view('app.settings.about-company.dialog.edit.editCompany', [
                'dataCompany'        => $returnData,
            ]);
        }
        return abort(404);
    }

    public function editCompany(Request $request, $companyID)
    {
        $validator = $this->funcValidator->validateSettingAboutCompany($request->input(), 'funcEditCompany');

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => $validator->errors()], 400);
        }

        $saveData = $this->aboutCompany->saveEditDataCompany($request->input(), $companyID);

        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function deleteCompany($companyID)
    {
        $deletedData = $this->aboutCompany->deleteCompany($companyID);
        return response()->json(['status' => $deletedData['status'], 'message' => $deletedData['message']]);
    }

    public function showEditDepartment($departmentID)
    {
        if (request()->ajax()) {
            $getCompany     = $this->getMaster->getDataCompany();
            $returnData     = $this->aboutCompany->showEditDepartment($departmentID);
            return view('app.settings.about-company.dialog.edit.editDepartment', [
                'getCompany'            => $getCompany,
                'dataDepartment'        => $returnData
            ]);
        }
        return abort(404);
    }

    public function editDepartment(Request $request, $departmentID)
    {
        $validator = $this->funcValidator->validateSettingAboutCompany($request->input(), 'funcEditDepartment');

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => $validator->errors()], 400);
        }

        $saveData = $this->aboutCompany->saveEditDataDepartment($request->input(), $departmentID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function deleteDepartment($departmentID)
    {
        $deletedData = $this->aboutCompany->deleteDepartment($departmentID);
        return response()->json(['status' => $deletedData['status'], 'message' => $deletedData['message']]);
    }

    public function showEditGroup($groupID)
    {
        if (request()->ajax()) {
            $getCompany     = $this->getMaster->getDataCompany();
            $returnData     = $this->aboutCompany->showEditGroup($groupID);
            $getDepartment  = $this->getMaster->getDataDepartmentForID($returnData[0]->company_id);
            return view('app.settings.about-company.dialog.edit.editGroup', [
                'getCompany'            => $getCompany,
                'getDepartment'         => $getDepartment,
                'dataGroup'             => $returnData
            ]);
        }
        return abort(404);
    }

    public function editGroup(Request $request, $groupID)
    {
        $validator = $this->funcValidator->validateSettingAboutCompany($request->input(), 'funcEditGroup');

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => $validator->errors()], 400);
        }

        $saveData = $this->aboutCompany->saveEditDataGroup($request->input(), $groupID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function deleteGroup($groupID)
    {
        $deletedData = $this->aboutCompany->deleteGroup($groupID);
        return response()->json(['status' => $deletedData['status'], 'message' => $deletedData['message']]);
    }

    public function showEditPrefixName($prefixNameID)
    {
        if (request()->ajax()) {
            $returnData     = $this->aboutCompany->showEditPrefixName($prefixNameID);
            return view('app.settings.about-company.dialog.edit.editPrefixName',[
                'dataPrefixName'        => $returnData
            ]);
        }
        return abort(404);
    }

    public function editPrefixName(Request $request, $prefixNameID)
    {
        $validator = $this->funcValidator->validateSettingAboutCompany($request->input(), 'funcEditPrefixName');

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => $validator->errors()], 400);
        }

        $saveData = $this->aboutCompany->saveEditDataPrefixName($request->input(), $prefixNameID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function deletePrefixName($prefixNameID)
    {
        $deletedData = $this->aboutCompany->deletePrefixName($prefixNameID);
        return response()->json(['status' => $deletedData['status'], 'message' => $deletedData['message']]);
    }

    public function showEditClassList($classListID)
    {
        if (request()->ajax()) {
            $returnData     = $this->aboutCompany->showEditClassList($classListID);
            return view('app.settings.about-company.dialog.edit.editClassList',[
                'dataClassList'         => $returnData
            ]);
        }
        return abort(404);
    }

    public function editClassList(Request $request, $classListID)
    {
        $validator = $this->funcValidator->validateSettingAboutCompany($request->input(), 'funcEditClassList');

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => $validator->errors()], 400);
        }

        $saveData = $this->aboutCompany->saveEditDataClassList($request->input(), $classListID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function deleteClassList($classListID)
    {
        $deletedData = $this->aboutCompany->deleteClassList($classListID);
        return response()->json(['status' => $deletedData['status'], 'message' => $deletedData['message']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

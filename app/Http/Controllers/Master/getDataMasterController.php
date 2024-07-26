<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\getDataMasterModel;
use Illuminate\Http\Request;

class getDataMasterController extends Controller
{
    private $masterModel;

    public function __construct()
    {
        $this->masterModel = new getDataMasterModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function getDataCompany($id)
    {
        $getDataCompany = $this->masterModel->getDataCompanyForID($id);
        // dd(response()->json($getDataCompany));
        return response()->json($getDataCompany);
    }

    public function getDataDepartment($id)
    {
        $getDataDepartment = $this->masterModel->getDataDepartmentForID($id);
        // dd(response()->json($getDataDepartment));
        return response()->json($getDataDepartment);
    }

    public function getDataGroup($departmentID)
    {
        $getDataGroup = $this->masterModel->getDataGroupOfDepartment($departmentID);
        // dd($getDataGroup);
        return response()->json($getDataGroup);
    }

    public function getDataPrefixName()
    {
        $getDataPrefixName = $this->masterModel->getDataPrefixName();
        // dd(response()->json($getDataPrefixName));
        return response()->json($getDataPrefixName);
    }

    public function getDataProvince()
    {
        $getDataProvince = $this->masterModel->getDataProvince();

        return response()->json($getDataProvince);
    }

    public function getDataAmphoe($provinceCode)
    {
        $getDataAmphoe = $this->masterModel->getDataAmphoe($provinceCode);
        // dd($getDataAmphoe);
        return response()->json($getDataAmphoe);
    }

    public function getDataTambon($aumphoeID)
    {
        $getDataTambon = $this->masterModel->getDataTambon($aumphoeID);
        // dd($getDataTambon);
        return response()->json($getDataTambon);
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

<?php

namespace App\Http\Controllers\Evaluation;

use App\Helpers\getAccessToMenu;
use App\Http\Controllers\Controller;
use App\Models\Evaluation\FormDepartmentModel;
use App\Models\Master\getDataMasterModel;
use Illuminate\Http\Request;

class FormDepartmentController extends Controller
{
    protected $getMaster;
    protected $evaluation;

    public function __construct()
    {
        $this->getMaster = new getDataMasterModel();
        $this->evaluation = new FormDepartmentModel();
    }
    public function index()
    {
        $url        = request()->segments();
        $urlName    = "รายการแบบฟอร์มการประเมินแผนก";
        $urlSubLink = "form-department";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $getAccessMenus = getAccessToMenu::getAccessMenus();

        return view('app.evaluation.formDepartment.index', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus
        ]);
    }

    public function showAddFormDepartmentModal()
    {
        if (request()->ajax()) {
            $getDataEmployee     = $this->getMaster->getEmployeeList();
            // dd($getDataEmployee);   

            return view('app.evaluation.formDepartment.save.selectEmployee', [
                'dataEmployee'   => $getDataEmployee,
            ]);
        }
        return abort(404);
    }

    public function saveSelectEmployee(Request $request)
    {
        $saveSelectEmployee = $this->evaluation->saveSelectEmployee($request->select_employee);

        $encyptId = encrypt($saveSelectEmployee);
        // return redirect()->route('show-evaluation', ['id' => $encyptId]);
        return response()->json(['status' => 200, 'message' => $encyptId]);
    }

    public function showEvaluation($id)
    {

        $id = decrypt($id);
        $url        = request()->segments();
        $urlName    = "แบบฟอร์มการประเมินพนักงาน";
        $urlSubLink = "form-department";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $getAccessMenus = getAccessToMenu::getAccessMenus();

        $getDataEvaluation = $this->evaluation->getDataEvaluation($id);
        // dd($getDataEvaluation);
        return view('app.evaluation.formDepartment.save.showFormDepartment', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus,
            'getDataEvaluation' => $getDataEvaluation
        ]);
    }

    public function saveFormEvaluation(Request $request)
    {
        $saveFormEvaluation = $this->evaluation->saveFormEvaluation($request->input());
        return response()->json(['status' => $saveFormEvaluation['status'], 'message' => $saveFormEvaluation['message']]);
    }

    public function drawFormEvaluation(Request $request)
    {
        $addDrawData = [
            'drawing' => '1',
        ];
        $request->merge($addDrawData);
        $drawFormEvaluation = $this->evaluation->saveFormEvaluation($request->input());
        return response()->json(['status' => $drawFormEvaluation['status'], 'message' => $drawFormEvaluation['message']]);
    }
}

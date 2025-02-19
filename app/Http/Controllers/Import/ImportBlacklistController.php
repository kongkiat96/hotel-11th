<?php

namespace App\Http\Controllers\Import;

use App\Helpers\getAccessToMenu;
use App\Http\Controllers\Controller;
use App\Models\import\importBlacklistModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class ImportBlacklistController extends Controller
{
    public function index()
    {
        $url        = request()->segments();
        $urlName    = "นำเข้าข้อมูล Blacklist";
        $urlSubLink = "import-blacklist";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $getAccessMenus = getAccessToMenu::getAccessMenus();

        return view('app.Import.importBlacklist', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus
        ]);
    }

    public function importData(Request $request)
    {
        $file = $request->file('filename');
        $returnData = array();
        try {
            if (!$file) {
                return [
                    "status"  => false,
                    "message" => 'Please Select File',
                ];
            }

            // อ่านไฟล์ Excel
            $spreadsheet = IOFactory::load($file->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            $importData = [];

            // วนลูปแถวข้อมูล (ข้ามหัวตารางที่ index 0)
            foreach ($rows as $key => $row) {
                if ($key == 0 || empty($row[0]) || empty($row[1]) || empty($row[2])) {
                    continue;
                }

                $importData[] = [
                    'first_name' => $row[0],
                    'last_name'  => $row[1],
                    'detail'     => $row[2],
                    'flag_blacklist' => !empty($row[3]) ? $row[3] : 'N',
                    'created_at' => now(),
                    'created_user' => Auth::user()->emp_code
                ];
            }

            // บันทึกข้อมูลลงฐานข้อมูล
            if (!empty($importData)) {
                DB::table('tbt_blacklist')->insert($importData);
            }

            $returnData = [
                "status"  => true,
                "message" => 'Import Data Success',
            ];
        } catch (Exception $e) {
            Log::error('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            $returnData = [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        } finally {
            return $returnData;
        }
    }

    public function getData(Request $request)
    {
        $returnData = array();
        try {
            
            $blacklistModel = new importBlacklistModel();
            $getDataBlacklist = $blacklistModel->getData($request);

            $returnData = response()->json($getDataBlacklist);
        } catch (Exception $e) {
            Log::error('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            $returnData = [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        } finally {
            return $returnData;
        }
    }

    public function showEditBlacklist($blacklistID){
        if (request()->ajax()) {
            $blacklistModel = new importBlacklistModel();
            $dataBlacklist = $blacklistModel->getDataBlacklistByID($blacklistID);
            // dd($dataBlacklist);   
            return view('app.import.dialog.edit.editBlacklist', [
                'dataBlacklist' => $dataBlacklist,
            ]);
        }
        return abort(404);
    }

    public function editBlacklist(Request $request, $blacklistID){
        // dd($blacklistID);
        $blacklistModel = new importBlacklistModel();
        $saveData = $blacklistModel->editBlacklist($request->input(), $blacklistID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function viewBlacklist($blacklistID){
        if (request()->ajax()) {
            $blacklistModel = new importBlacklistModel();
            $dataBlacklist = $blacklistModel->getDataBlacklistByID($blacklistID);
            // dd($dataBlacklist);   
            return view('app.import.dialog.view.viewBlacklist', [
                'dataBlacklist' => $dataBlacklist,
            ]);
        }
        return abort(404);
    }

    public function deleteBlacklist($blacklistID){
        $blacklistModel = new importBlacklistModel();
        $saveData = $blacklistModel->deleteBlacklist($blacklistID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }
}

<?php

namespace App\Http\Controllers\Settings;

use App\Helpers\getAccessToMenu;
use App\Http\Controllers\Controller;
use App\Models\Settings\BankListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BankListController extends Controller
{
    protected $bankListModel;
    public function __construct()
    {
        $this->bankListModel = new BankListModel();
    }
    public function index()
    {
        $url = request()->segments();
        $urlName = "รายการบัญชีธนาคาร";
        $urlSubLink = "bank-list";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $getAccessMenus = getAccessToMenu::getAccessMenus();
        // dd($getAccessMenus);

        return view('app.settings.bank-list.setBankList', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus
        ]);
    }

    public function showAddBankModal()
    {
        if (request()->ajax()) {
            // $getFlagType     = $this->getMaster->getDataFlagType();

            return view('app.settings.bank-list.dialog.save.addBankList', [
                // 'getFlagType'        => $getFlagType,
            ]);
        }
        return abort(404);
    }

    public function saveDataBank(Request $request)
    {
        // เก็บข้อมูลที่อัปโหลดไว้ในตัวแปร
        $data = [
            'bank_name' => $request->input('bankName'),
            'bank_short_name' => $request->input('bankNameShort'),
            'status' => $request->input('statusOfBank'),
        ];

        // อัปโหลดไฟล์ถ้ามี
        if ($request->hasFile('file')) {
            $files = $request->file('file'); // ตรวจสอบว่า 'file' อาจเป็นอาร์เรย์ของไฟล์
            if (is_array($files)) {
                foreach ($files as $file) {
                    if ($file instanceof \Illuminate\Http\UploadedFile) {
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension(); // เพิ่ม uniqid เพื่อหลีกเลี่ยงชื่อไฟล์ซ้ำ
                        $file->storeAs('public/uploads/banks', $filename); // เปลี่ยน path ให้ตรงกับที่ต้องการจัดเก็บ
                        // เก็บชื่อไฟล์ใน array (หากต้องการเก็บหลายไฟล์)
                        $data['bank_logo'][] = $filename;
                    }
                }
            } else {
                // กรณีเป็นไฟล์เดียว
                if ($files instanceof \Illuminate\Http\UploadedFile) {
                    $filename = time() . '_' . uniqid() . '.' . $files->getClientOriginalExtension();
                    $files->storeAs('public/uploads/banks', $filename);
                    $data['bank_logo'] = $filename; // เก็บชื่อไฟล์ใน array
                }
            }
        }
        // dd($data);
        $saveData = $this->bankListModel->saveDataBank($data);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function getDataBanks(Request $request)
    {
        $getDataBanks = $this->bankListModel->getDataBankList($request);

        return response()->json($getDataBanks);
    }

    public function showEditBankModal($bankID)
    {
        if (request()->ajax()) {
            $getEditBank = $this->bankListModel->getDataEditBank($bankID);

            // dd($getEditBank);
            return view('app.settings.bank-list.dialog.edit.editBank', [
                'getEditBank' => $getEditBank,
            ]);
        }
        return abort(404);
    }

    public function editBank($bankID, Request $request)
    {
        // dd($request->all()); // ใช้เพื่อดูค่าทั้งหมดที่ส่งมาจากฟอร์ม

        $data = [
            'bank_name' => $request->input('edit_bankName'),
            'bank_short_name' => $request->input('edit_bankNameShort'),
            'status' => $request->input('edit_statusOfBank'),
        ];

        // ตรวจสอบว่ามีการเลือกลบไฟล์หรือไม่
        if ($request->input('delete_bank_logo') == 0) {
            // ถ้ามีการเลือกลบ ให้ดำเนินการลบไฟล์ที่เก็บไว้ในเซิร์ฟเวอร์
            $existingBank = $this->bankListModel->getDataEditBank($bankID); // ค้นหาธนาคารปัจจุบัน
            if ($existingBank && $existingBank->bank_logo) {
                // ลบไฟล์จากโฟลเดอร์
                Storage::delete('public/uploads/banks/' . $existingBank->bank_logo);
                $data['bank_logo'] = null; // รีเซ็ตค่า bank_logo ในฐานข้อมูล
            }
        }

        // ตรวจสอบว่ามีการอัพโหลดไฟล์ใหม่หรือไม่
        if ($request->hasFile('file')) {
            $files = $request->file('file'); // ตรวจสอบว่า 'file' อาจเป็นอาร์เรย์ของไฟล์ 
            if (is_array($files)) {
                foreach ($files as $file) {
                    if ($file instanceof \Illuminate\Http\UploadedFile) {
                        // จัดการกับไฟล์ที่อัพโหลด
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->storeAs('public/uploads/banks', $filename);
                        $data['bank_logo'] = $filename; // เก็บชื่อไฟล์ใน array
                    }
                }
            } else {
                if ($files instanceof \Illuminate\Http\UploadedFile) {
                    $filename = time() . '_' . uniqid() . '.' . $files->getClientOriginalExtension();
                    $files->storeAs('public/uploads/banks', $filename);
                    $data['bank_logo'] = $filename; // เก็บชื่อไฟล์ใน array
                }
            }
        }

        // อัปเดตข้อมูลในฐานข้อมูล
        $editBank = $this->bankListModel->saveDataEditBank($data, $bankID);
        return response()->json(['status' => $editBank['status'], 'message' => $editBank['message']]);
    }



    public function deleteBank($bankID)
    {
        $deleteBank = $this->bankListModel->deleteBank($bankID);
        return response()->json(['status' => $deleteBank['status'], 'message' => $deleteBank['message']]);
    }
}

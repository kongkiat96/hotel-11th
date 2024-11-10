<?php

namespace App\Http\Controllers\Settings;

use App\Helpers\getAccessToMenu;
use App\Http\Controllers\Controller;
use App\Models\Settings\AboutAppModel;
use Generator;
use Illuminate\Http\Request;

class AboutAppController extends Controller
{

    private $aboutAppModel;

    public function __construct()
    {
        $this->aboutAppModel = new AboutAppModel();
    }
    public function index()
    {
        $url        = request()->segments();
        $urlName    = "เกี่ยวกับระบบ";
        $urlSubLink = "about-app";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $getAccessMenus = getAccessToMenu::getAccessMenus();
        
        $getDataAboutApp = $this->aboutAppModel->getDataAboutApp();

        return view('app.Settings.aboutApp.index', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus,
            'dataAboutApp' => $getDataAboutApp
        ]);
    }

    public function saveAboutAppData(Request $request)
    {
        $data = [
            'company_name' => $request->input('company_name'),
            'show_app_name' => $request->input('show_app_name'),
            'company_address'   => $request->input('company_address'),
            'company_email'   => $request->input('company_email'),
        ];

        // อัปโหลดไฟล์ถ้ามี
        if ($request->hasFile('file')) {
            $files = $request->file('file'); // ตรวจสอบว่า 'file' อาจเป็นอาร์เรย์ของไฟล์
            if (is_array($files)) {
                foreach ($files as $file) {
                    if ($file instanceof \Illuminate\Http\UploadedFile) {
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension(); // เพิ่ม uniqid เพื่อหลีกเลี่ยงชื่อไฟล์ซ้ำ
                        $file->storeAs('public/uploads/aboutApp', $filename); // เปลี่ยน path ให้ตรงกับที่ต้องการจัดเก็บ
                        // เก็บชื่อไฟล์ใน array (หากต้องการเก็บหลายไฟล์)
                        $data['about_app_img'][] = $filename;
                    }
                }
            } else {
                // กรณีเป็นไฟล์เดียว
                if ($files instanceof \Illuminate\Http\UploadedFile) {
                    $filename = time() . '_' . uniqid() . '.' . $files->getClientOriginalExtension();
                    $files->storeAs('public/uploads/aboutApp', $filename);
                    $data['about_app_img'] = $filename; // เก็บชื่อไฟล์ใน array
                }
            }
        }
        // dd($data);
        $saveData = $this->aboutAppModel->saveAboutAppData($data);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }
}

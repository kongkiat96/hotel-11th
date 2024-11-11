<?php

namespace App\Http\Controllers\Document;

use App\Helpers\CalculateDateHelper;
use App\Helpers\getAccessToMenu;
use App\Helpers\NumberHelper;
use App\Http\Controllers\Controller;
use App\Models\Document\InvoiceModel;
use App\Models\Master\getDataMasterModel;
use Carbon\Carbon;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public $invoiceModel;
    public $masterModel;
    public function __construct()
    {
        $this->invoiceModel = new InvoiceModel();
        $this->masterModel = new getDataMasterModel();
    }
    public function index()
    {
        $url        = request()->segments();
        $urlName    = "รายการใบแจ้งหนี้";
        $urlSubLink = "invoice";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $getAccessMenus = getAccessToMenu::getAccessMenus();

        return view('app.document.invoice.index', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus
        ]);
    }

    public function createInvoice()
    {
        $url        = request()->segments();
        $urlName    = "รายการใบแจ้งหนี้";
        $urlSubLink = "invoice";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $getRunningNumber = $this->invoiceModel->getRunningNumberToSave();
        // เพิ่มข้อมูลใบแจ้งหนี้ใหม่ในตาราง tbt_invoice
        $invoice = DB::table('tbt_invoice')->insertGetId([
            'running_number' => $getRunningNumber['running_number'],
            'rn_id' => $getRunningNumber['id'],
            'date_invoice' => Carbon::now()->format('Y-m-d'),
            'created_at' => now(),
            'created_user' => Auth::user()->emp_code
            // ใส่ข้อมูลอื่น ๆ ตามที่ต้องการ
        ]);

        // หลังจากสร้างข้อมูลเสร็จแล้วให้ redirect ไปที่ route created-invoice/{id}
        return redirect()->route('created-invoice', ['id' => $invoice]);
    }

    public function createdInvoice($invoiceID)
    {
        $url        = request()->segments();
        $urlName    = "รายการใบแจ้งหนี้";
        $urlSubLink = "invoice";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $getAccessMenus = getAccessToMenu::getAccessMenus();
        $getDataInvoice = $this->invoiceModel->getInvoiceById($invoiceID);
        $getDataInvoiceList = $this->invoiceModel->getDataInvoiceList($invoiceID);
        // dd($getDataInvoiceList);
        // dd($getDataInvoice);
        $dateTH = CalculateDateHelper::convertDateAndCalculateServicePeriod($getDataInvoice->date_invoice);
        // $number = 99;
        $setNumber = str_replace(',', '', $getDataInvoiceList['total_amount']);
        $bahtTotext = NumberHelper::convertNumberToThaiText($setNumber);

        $getMasterList = $this->masterModel->getDataMasterInvoiceList();
        $getBankList = $this->masterModel->getDataBankList();
        return view('app.document.invoice.save.addInvoice', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus,
            'dataInvoice'   => $getDataInvoice,
            'dateTH'        => $dateTH,
            'bahtTotext'    => $bahtTotext,
            'dataInvoiceList' => $getDataInvoiceList,
            'getMasterList' => $getMasterList,
            'getBankList' => $getBankList,
            'countDetail'   => count($getDataInvoiceList['data'])
        ]);
    }

    public function addDetailInvoice(Request $request)
    {

        $saveDataList = $this->invoiceModel->saveDetailInvoice($request);
        // dd($saveDataList);
        return response()->json(['status' => $saveDataList['status'], 'message' => $saveDataList['message']]);
    }

    public function deleteDetailInvoice($detailID)
    {
        // dd($detailID);
        $deleteDataList = $this->invoiceModel->deleteDetailInvoice($detailID);
        return response()->json(['status' => $deleteDataList['status'], 'message' => $deleteDataList['message']]);
    }

    public function saveDataInvoice(Request $request)
    {
        // dd($request->input());
        $data = Arr::except($request->input(), ['invoice_id']);
        $data_ID = $request->input('invoice_id');
        $saveData = $this->invoiceModel->saveDataInvoice($data, $data_ID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function saveDrawingInvoice(Request $request)
    {
        // dd($request->input());
        $data = Arr::except($request->input(), ['invoice_id']);
        $data_ID = $request->input('invoice_id');
        $saveData = $this->invoiceModel->saveDrawingInvoice($data, $data_ID);
        return response()->json(['status' => $saveData['status'], 'message' => $saveData['message']]);
    }

    public function viewInvoice($invoiceID)
    {
        $url        = request()->segments();
        $urlName    = "ตรวจสอบรายการใบแจ้งหนี้";
        $urlSubLink = "invoice";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $getAccessMenus = getAccessToMenu::getAccessMenus();
        $getDataInvoice = $this->invoiceModel->getInvoiceById($invoiceID);
        $getDataInvoiceList = $this->invoiceModel->getDataInvoiceList($invoiceID);
        // dd($getDataInvoiceList);
        // dd($getDataInvoice);
        $dateTH = CalculateDateHelper::convertDateAndCalculateServicePeriod($getDataInvoice->date_invoice);
        // $number = 99;
        $setNumber = str_replace(',', '', $getDataInvoiceList['total_amount']);
        $bahtTotext = NumberHelper::convertNumberToThaiText($setNumber);
        return view('app.document.invoice.view.viewInvoice', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus,
            'dataInvoice'   => $getDataInvoice,
            'dateTH'        => $dateTH,
            'bahtTotext'    => $bahtTotext,
            'dataInvoiceList' => $getDataInvoiceList,
            'countDetail'   => count($getDataInvoiceList['data'])
        ]);
    }

    public function deleteInvoice($invoiceID)
    {
        $deleteData = $this->invoiceModel->deleteInvoice($invoiceID);
        return response()->json(['status' => $deleteData['status'], 'message' => $deleteData['message']]);
    }
    public function printInvoice($invoiceID)
    {
        $url        = request()->segments();
        $urlName    = "ตรวจสอบรายการใบแจ้งหนี้";
        $urlSubLink = "invoice";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $invoiceID = Crypt::decrypt($invoiceID);

        $getAccessMenus = getAccessToMenu::getAccessMenus();
        $getDataInvoice = $this->invoiceModel->getInvoiceById($invoiceID);
        $getDataInvoiceList = $this->invoiceModel->getDataInvoiceList($invoiceID);
        // dd($getDataInvoiceList);
        // dd($getDataInvoice);
        $dateTH = CalculateDateHelper::convertDateAndCalculateServicePeriod($getDataInvoice->date_invoice);
        // $number = 99;
        $setNumber = str_replace(',', '', $getDataInvoiceList['total_amount']);
        $bahtTotext = NumberHelper::convertNumberToThaiText($setNumber);
        return view('app.document.invoice.print.printInvoice', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus,
            'dataInvoice'   => $getDataInvoice,
            'dateTH'        => $dateTH,
            'bahtTotext'    => $bahtTotext,
            'dataInvoiceList' => $getDataInvoiceList,
            'countDetail'   => count($getDataInvoiceList['data'])
        ]);
    }

    public function printReceipt($invoiceID)
    {
        $url        = request()->segments();
        $urlName    = "ตรวจสอบรายการใบแจ้งหนี้";
        $urlSubLink = "invoice";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $invoiceID = Crypt::decrypt($invoiceID);

        $getAccessMenus = getAccessToMenu::getAccessMenus();
        $getDataInvoice = $this->invoiceModel->getInvoiceById($invoiceID);
        $getDataInvoiceList = $this->invoiceModel->getDataInvoiceList($invoiceID);
        // dd($getDataInvoiceList);
        // dd($getDataInvoice);
        $dateTH = CalculateDateHelper::convertDateAndCalculateServicePeriod($getDataInvoice->date_invoice);
        // $number = 99;
        $setNumber = str_replace(',', '', $getDataInvoiceList['total_amount']);
        $bahtTotext = NumberHelper::convertNumberToThaiText($setNumber);

        if($getDataInvoice->tag_invoice == 1){
            $mapTitle = "ใบเสร็จรับเงินเดือน";
        } else {
            $mapTitle = "ใบเสร็จรับเงิน";
        }
        return view('app.document.invoice.print.printReceipt', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus,
            'dataInvoice'   => $getDataInvoice,
            'dateTH'        => $dateTH,
            'bahtTotext'    => $bahtTotext,
            'dataInvoiceList' => $getDataInvoiceList,
            'countDetail'   => count($getDataInvoiceList['data']),
            'mapText'       => $mapTitle
        ]);
    }
    public function printInvoicePDF($invoiceID)
    {
        // dd($invoiceID);
        // ดึงข้อมูลใบแจ้งหนี้จากฐานข้อมูล
        $getDataInvoice = $this->invoiceModel->getInvoiceById($invoiceID);
        $getDataInvoiceList = $this->invoiceModel->getDataInvoiceList($invoiceID);
        // dd($getDataInvoiceList);
        // dd($getDataInvoice);
        $dateTH = CalculateDateHelper::convertDateAndCalculateServicePeriod($getDataInvoice->date_invoice);
        // $number = 99;
        $setNumber = str_replace(',', '', $getDataInvoiceList['total_amount']);
        $bahtTotext = NumberHelper::convertNumberToThaiText($setNumber);

        if (!$getDataInvoice) {
            abort(404, 'Invoice not found');
        }


        // เตรียมข้อมูลที่จะแสดงใน PDF
        $html = view('app.document.invoice.print.printInvoice', [
            'dataInvoice'   => $getDataInvoice,
            'dateTH'        => $dateTH,
            'bahtTotext'    => $bahtTotext,
            'dataInvoiceList' => $getDataInvoiceList,
            'countDetail'   => count($getDataInvoiceList['data'])
        ])->render(); // render HTML จาก view ที่จะแสดงผล

        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font_size' => 12,
            'default_font' => 'sarabun',
            'fontDir' => array_merge($fontDirs, [
                public_path('fonts/THSarabunNew'), // ตำแหน่งที่เก็บฟอนต์
            ]),
            'fontdata' => array_merge($fontData, [
                'sarabun' => [
                    'R' => 'THSarabunNew.ttf',
                    'B' => 'THSarabunNew Bold.ttf',
                    'I' => 'THSarabunNew Italic.ttf',
                    'BI' => 'THSarabunNew BoldItalic.ttf'
                ]
            ]),
            'default_font' => 'sarabun'
        ]);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->SetMargins(2, 2, 5); // ระยะขอบ 15 มม. ด้านซ้าย ขวา และด้านบน
        // dd($mpdf->fontdata);
        // dd(mb_detect_encoding($html));

        $mpdf->WriteHTML($html); // เขียน HTML ลง PDF

        // สร้างไฟล์ PDF และดาวน์โหลด
        return $mpdf->Output('invoice.pdf', 'I'); // 'I' หมายถึงการแสดงใน browser, 'D' สำหรับการดาวน์โหลด
    }

    public function getDataInvoice(Request $request)
    {
        $getDataInvoiceList = $this->invoiceModel->getDataInvoice($request);
        return response()->json($getDataInvoiceList);
    }

    public function showDataSearchMonth($searMonth, $tagSearch)
    {
        $url        = request()->segments();
        $urlName    = "ตรวจสอบรายการใบแจ้งหนี้เดือน ". Carbon::parse($searMonth)->translatedFormat('F') . ' ' . (Carbon::parse($searMonth)->year + 543);
        $urlSubLink = "invoice";

        if (!getAccessToMenu::hasAccessToMenu($urlSubLink)) {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงเมนู');
        }
        $getAccessMenus = getAccessToMenu::getAccessMenus();

        return view('app.document.invoice.view.searchMonth', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus,
            'searchTag'    => $tagSearch,
            'searchMonth'  => $searMonth
        ]);
    }

    public function getDataSearchInvoice(Request $request)
    {
        $getDataInvoiceList = $this->invoiceModel->getDataSearchInvoice($request);
        return response()->json($getDataInvoiceList);
    }
}

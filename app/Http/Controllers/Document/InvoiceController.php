<?php

namespace App\Http\Controllers\Document;

use App\Helpers\CalculateDateHelper;
use App\Helpers\getAccessToMenu;
use App\Helpers\NumberHelper;
use App\Http\Controllers\Controller;
use App\Models\Document\InvoiceModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public $invoiceModel;
    public function __construct()
    {
        $this->invoiceModel = new InvoiceModel();
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

        return view('app.Document.invoice.index', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            'listMenus'     => $getAccessMenus
        ]);
    }

    public function createInvoice()
    {
        $getRunningNumber = $this->invoiceModel->getRunningNumberToSave();
        // เพิ่มข้อมูลใบแจ้งหนี้ใหม่ในตาราง tbt_invoice
        $invoice = DB::table('tbt_invoice')->insertGetId([
            'running_number' => $getRunningNumber['running_number'],
            'rn_id' => $getRunningNumber['id'],
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
        $dateTH = CalculateDateHelper::convertDateAndCalculateServicePeriod(Carbon::now()->format('Y-m-d'));
        // $number = 99;
        $setNumber = str_replace(',', '', $getDataInvoiceList['total_amount']);
        $bahtTotext = NumberHelper::convertNumberToThaiText($setNumber);
        return view('app.Document.invoice.save.addInvoice', [
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
}

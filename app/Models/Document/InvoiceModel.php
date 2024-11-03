<?php

namespace App\Models\Document;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceModel extends Model
{
    use HasFactory;

    public static function getRunningNumberToSave()
    {
        $today = Carbon::now()->format('Y-m-d'); // วันที่ปัจจุบัน
        $year = Carbon::now()->format('Y'); // ปีปัจจุบัน

        // ตรวจสอบว่ามีข้อมูลในปีนั้นหรือไม่
        $lastRecord = DB::connection('mysql')->table('tbm_running_number')
            ->whereYear('create_date', $year)
            ->where('deleted', 0)
            ->orderBy('running_number', 'desc')
            ->first();

        if ($lastRecord) {
            // ถ้ามีข้อมูลอยู่แล้ว ให้เพิ่มลำดับถัดไป
            $nextNumber = str_pad($lastRecord->running_number + 1, 3, '0', STR_PAD_LEFT);
        } else {
            // ถ้าไม่มีข้อมูลในปีนั้น ให้เริ่มนับที่ 001
            $nextNumber = '001';
        }

        // สร้าง Running Number ตามรูปแบบที่ต้องการ เช่น 03 พ.ย. 2024, 001
        $runningNumber = Carbon::now()->translatedFormat('d M Y') . ', ' . $nextNumber;

        // บันทึกข้อมูลลงในตาราง tbm_running_number และรับ ID ของแถวที่ถูกสร้างขึ้น
        $recordId = DB::connection('mysql')->table('tbm_running_number')->insertGetId([
            'running_number' => $nextNumber,
            'create_date' => $today,
            'created_at' => now(),
            'created_user' => Auth::user()->emp_code
        ]);

        // คืนค่า ID และ Running Number
        return [
            'id' => $recordId,
            'running_number' => $runningNumber
        ];
    }

    public function getInvoiceById($invoiceID)
    {
        try {
            $sql = DB::connection('mysql')->table('tbt_invoice AS i')
                ->leftJoin('tbm_running_number AS rn', 'i.rn_id', '=', 'rn.id')
                ->where('i.id', $invoiceID)
                ->select('i.*')
                ->first();
            // dd($sql);

            return $sql;
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function getDataInvoiceList($invoiceID)
    {
        try {
            $sql = DB::connection('mysql')->table('tbt_invoice_list AS il')
                ->leftJoin('tbt_invoice AS i', 'il.invoice_id', '=', 'i.id')
                ->where('il.invoice_id', $invoiceID)
                ->select('il.*')
                ->get();

            foreach ($sql as $key => $value) {
                $sql[$key]->amount_total = str_replace(',', '', $value->amount_total);
            }
            // dd($sql);
            return $sql;
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function saveDetailInvoice($request)
{
    // รับค่า invoiceId
    $invoiceId = $request->input('invoiceId');

    // รับข้อมูล group-detail-invoice
    $invoiceDetails = $request->input('group-detail-invoice');

    // ตรวจสอบว่ามีข้อมูลที่ไม่เป็น null ในแต่ละ array และทำการบันทึก
    foreach ($invoiceDetails as $detail) {
        $detailList = $detail['detail_list'] ?? null;
        $quantity = $detail['quantity'] ?? null;
        $amountTotal = $detail['amount_total'] ?? null;

        // เช็คว่าค่าต่าง ๆ ไม่เป็น null และ quantity มากกว่า 0
        if (!is_null($detailList) && !is_null($quantity) && !is_null($amountTotal) && $quantity > 0) {
            // ลบเครื่องหมายจุลภาคและแปลงเป็นตัวเลข
            $amountTotal = str_replace(',', '', $amountTotal);

            // ตรวจสอบว่ามีรายการนี้อยู่แล้วในฐานข้อมูลหรือไม่
            $existingRecord = DB::table('tbt_invoice_list')
                ->where('invoice_id', $invoiceId)
                ->where('detail_list', $detailList)
                ->first();

            if ($existingRecord) {
                // ถ้ามีรายการนี้อยู่แล้ว ให้ทำการอัปเดต
                DB::table('tbt_invoice_list')
                    ->where('id', $existingRecord->id) // ใช้ id ของรายการที่มีอยู่
                    ->update([
                        'detail_list' => $detailList,
                        'quantity' => $quantity,
                        'amount_total' => $amountTotal,
                    ]);
            } else {
                // ถ้าไม่มีรายการซ้ำให้ทำการบันทึก
                DB::table('tbt_invoice_list')->insert([
                    'invoice_id' => $invoiceId,
                    'detail_list' => $detailList,
                    'quantity' => $quantity,
                    'amount_total' => $amountTotal, // บันทึกค่าที่ไม่มีเครื่องหมายจุลภาค
                    'created_at' => now(),
                    'created_user' => Auth::user()->emp_code
                ]);
            }
        }
    }

    return response()->json(['success' => true, 'message' => 'บันทึกข้อมูลเรียบร้อย']);
}

}

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
                ->leftJoin('tbm_bank_list AS bl', 'i.payment_tag', '=', 'bl.ID')
                ->where('i.id', $invoiceID)
                ->select('i.*','bl.bank_name','bl.bank_short_name','bl.bank_logo')
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
            // ดึงข้อมูลจากตาราง
            $sql = DB::connection('mysql')->table('tbt_invoice_list AS il')
                ->leftJoin('tbt_invoice AS i', 'il.invoice_id', '=', 'i.id')
                ->leftJoin('tbm_invoice_list AS tbmIls', 'il.tag_list', '=', 'tbmIls.id')
                ->where('il.invoice_id', $invoiceID)
                ->select('il.*','tbmIls.invoice_list')
                ->get();

            // คำนวณผลรวมของ quantity และ amount_total
            $totalQuantity = $sql->sum('quantity'); // คำนวณผลรวมของ quantity
            $totalAmount = $sql->sum(function ($item) {
                return str_replace(',', '', $item->amount_total); // แปลง amount_total เป็นตัวเลข
            });

            // ส่งผลลัพธ์ที่รวมเข้ากับข้อมูล
            return [
                'data' => $sql,
                'total_quantity' => $totalQuantity,
                'total_amount' => number_format($totalAmount, 2), // จัดรูปแบบจำนวนเงิน
            ];
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
        try {
            // รับค่า invoiceId
            $invoiceId = $request->input('invoiceId');
            // รับข้อมูล group-detail-invoice
            $invoiceDetails = $request->input('group-detail-invoice');

            // ตรวจสอบว่ามีข้อมูลที่ไม่เป็น null ในแต่ละ array และทำการบันทึก
            foreach ($invoiceDetails as $detail) {
                $id = $detail['id'] ?? null; // รับค่า id
                $detailList = $detail['detail_list'] ?? null;
                $quantity = $detail['quantity'] ?? null;
                $amountTotal = $detail['amount_total'] ?? null;
                $tag_list = $detail['tag_list'] ?? null;

                // เช็คว่าค่าต่าง ๆ ไม่เป็น null และ quantity มากกว่า 0
                if (!is_null($detailList) && !is_null($quantity) && !is_null($amountTotal) && $quantity > 0) {
                    // ลบเครื่องหมายจุลภาคและแปลงเป็นตัวเลข
                    $amountTotal = str_replace(',', '', $amountTotal);

                    if ($id) {
                        // ถ้ามี id ให้ทำการอัปเดตรายการที่มีอยู่
                        DB::table('tbt_invoice_list')
                            ->where('id', $id)
                            ->update([
                                'tag_list'  => $tag_list,
                                'detail_list' => $detailList,
                                'quantity' => $quantity,
                                'amount_total' => $amountTotal,
                            ]);
                    } else {
                        // ถ้าไม่มี id ให้ทำการบันทึกเป็นรายการใหม่
                        DB::table('tbt_invoice_list')->insert([
                            'invoice_id' => $invoiceId,
                            'tag_list'  => $tag_list,
                            'detail_list' => $detailList,
                            'quantity' => $quantity,
                            'amount_total' => $amountTotal,
                            'created_at' => now(),
                            'created_user' => Auth::user()->emp_code
                        ]);
                    }
                }
            }
            return [
                'status' => 200,
                'message' => 'Delete Success'
            ];
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function deleteDetailInvoice($detailID)
    {
        try {
            DB::table('tbt_invoice_list')->where('id', $detailID)->delete();
            return [
                'status' => 200,
                'message' => 'Delete Success'
            ];
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function saveDataInvoice($data, $invoiceID)
    {
        try {
            // dd($data);
            $data['updated_user'] = Auth::user()->emp_code;
            $data['updated_at'] = Carbon::now();
            $data['draw'] = 2;
            $getDataInvoice = $this->getInvoiceById($invoiceID);
            if ($getDataInvoice) {
                DB::table('tbm_running_number')->where('id', $getDataInvoice->rn_id)->update(['document_id' => $invoiceID]);
            }
            DB::table('tbt_invoice')->where('id', $invoiceID)->update($data);
            return [
                'status' => 200,
                'message' => 'Update Success'
            ];
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function saveDrawingInvoice($data, $invoiceID)
    {
        try {
            // dd($data);
            $data['updated_user'] = Auth::user()->emp_code;
            $data['updated_at'] = Carbon::now();
            $data['draw'] = 1;
            $getDataInvoice = $this->getInvoiceById($invoiceID);
            if ($getDataInvoice) {
                DB::table('tbm_running_number')->where('id', $getDataInvoice->rn_id)->update(['document_id' => $invoiceID]);
            }
            DB::table('tbt_invoice')->where('id', $invoiceID)->update($data);
            return [
                'status' => 200,
                'message' => 'Update Success'
            ];
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }

    public function deleteInvoice($invoiceID)
    {
        try {
            $getDataInvoice = $this->getInvoiceById($invoiceID);
            DB::table('tbm_running_number')->where('id', $getDataInvoice->rn_id)->update(['deleted' => 1]);
            DB::table('tbt_invoice')->where('id', $invoiceID)->update([
                'draw'  => 0,
                'deleted' => 1,
                'updated_user' => Auth::user()->emp_code,
                'updated_at' => Carbon::now()
            ]);

            return [
                'status' => 200,
                'message' => 'Delete Success'
            ];
        } catch (Exception $e) {
            Log::debug('Error in ' . get_class($this) . '::' . __FUNCTION__ . ', responseCode: ' . $e->getCode() . ', responseMessage: ' . $e->getMessage());
            return [
                'status' => intval($e->getCode()) ?: 500, // ใช้ 500 เป็นค่าดีฟอลต์สำหรับข้อผิดพลาดทั่วไป
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
        }
    }
}

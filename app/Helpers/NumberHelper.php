<?php

namespace App\Helpers;

class NumberHelper
{
    /**
     * แปลงตัวเลขเป็นข้อความภาษาไทย
     *
     * @param float $number ตัวเลขที่ต้องการแปลง
     * @return string ข้อความที่แปลงแล้ว
     */
    public static function convertNumberToThaiText($number)
    {
        $textNumbers = ["", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า"];
        $textUnits = ["", "สิบ", "ร้อย", "พัน", "หมื่น", "แสน", "ล้าน"];

        if (!is_numeric($number)) {
            return "ข้อมูลไม่ถูกต้อง";
        }

        $numberParts = explode('.', number_format($number, 2, '.', ''));
        $integerPart = $numberParts[0];
        $decimalPart = isset($numberParts[1]) ? $numberParts[1] : '00';

        // แปลงส่วนจำนวนเต็ม
        $thaiText = '';
        $len = strlen($integerPart);
        for ($i = 0; $i < $len; $i++) {
            $digit = (int) $integerPart[$i];
            $position = $len - $i - 1;

            if ($digit != 0) {
                if ($position == 1 && $digit == 1 && $len > 1) {
                    $thaiText .= 'สิบ';
                } elseif ($position == 1 && $digit == 2) {
                    $thaiText .= 'ยี่สิบ';
                } elseif ($position == 0 && $digit == 1 && $len > 1) {
                    $thaiText .= 'เอ็ด';
                } else {
                    $thaiText .= $textNumbers[$digit] . $textUnits[$position % 6];
                }
            }

            // เพิ่ม "ล้าน" เมื่อถึงตำแหน่งล้าน
            if ($position % 6 == 0 && $position > 0) {
                $thaiText .= 'ล้าน';
            }
        }

        $thaiText .= 'บาท';

        // แปลงส่วนทศนิยม
        if ($decimalPart == '00') {
            $thaiText .= 'ถ้วน';
        } else {
            $bahtSatang = '';
            $lenDecimal = strlen($decimalPart);

            for ($i = 0; $i < $lenDecimal; $i++) {
                $digit = (int) $decimalPart[$i];

                if ($i == 0) { // หลักสิบ
                    if ($digit == 1 && $lenDecimal == 2) {
                        $bahtSatang .= 'สิบ'; // "สิบ" ถ้าเป็นหลักสิบ
                    } elseif ($digit == 2) {
                        $bahtSatang .= 'ยี่สิบ'; // "ยี่" ถ้าเป็น 2 ในหลักสิบ
                    } elseif ($digit > 2) {
                        $bahtSatang .= $textNumbers[$digit] . 'สิบ'; // สำหรับตัวเลขมากกว่า 2
                    }
                } elseif ($i == 1) { // หลักหน่วย
                    if ($digit == 1 && $lenDecimal == 2) {
                        $bahtSatang .= 'เอ็ด'; // "เอ็ด" ถ้าหมายถึง 1 ในหลักหน่วย
                    } elseif ($digit > 0) {
                        $bahtSatang .= $textNumbers[$digit]; // ตัวเลขในหลักหน่วย
                    }
                }
            }

            // เช็คถ้ามีค่าในสตางค์
            if ($decimalPart != '00') {
                $thaiText .= $bahtSatang . 'สตางค์';
            }
        }

        return $thaiText;
    }
}

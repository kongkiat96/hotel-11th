<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SetMasterAllController extends Controller
{
    public function setBankListIndex()
    {
        $url        = request()->segments();
        $urlName    = "ตั้งค่ารายชื่อบัญชีธนาคาร";
        $urlSubLink = "bank-list";
        // $getFlagType = $this->getMaster->getDataFlagType();
        // dd($url);
        return view('app.settings.bank-list.setBankList', [
            'url'           => $url,
            'urlName'       => $urlName,
            'urlSubLink'    => $urlSubLink,
            // 'flagType'      => $getFlagType
        ]);
    }
}

<?php

namespace App\Http\Controllers\AccessMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessMenuController extends Controller
{
    public function getAccessMenu(){
        $user = Auth::user();

        // ดึง access menus ของผู้ใช้
        $accessMenuSubIDs = $user->accessMenus->pluck('menu_sub_ID')->toArray();

        dd($accessMenuSubIDs);
    }
}

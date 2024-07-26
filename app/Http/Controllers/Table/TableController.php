<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $url = request()->segments();
        // dd($url);
        return view('app.table.index',[
            'url'   => $url
        ]);
    }
}

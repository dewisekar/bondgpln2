<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bondg;

class ViewerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('viewer');
    }

    public function show_status()
    {
        $bondg = bondg::orderBy('tgldg', 'desc')->all();
        $no = 1;
        return view('viewer.status', compact('bondg', 'no'));
    }
}

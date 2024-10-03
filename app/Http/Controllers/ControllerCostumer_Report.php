<?php

namespace App\Http\Controllers;

use App\Models\section;
use Illuminate\Http\Request;

class ControllerCostumer_Report extends Controller
{
    public function index(){
        $sections = section::all();
        return view('reports.costumer_report',compact('sections'));
    }
}

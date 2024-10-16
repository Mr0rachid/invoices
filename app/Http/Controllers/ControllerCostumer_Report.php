<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\section;
use Illuminate\Http\Request;

class ControllerCostumer_Report extends Controller
{
    public function index(){
        $sections = section::all();
        return view('reports.costumer_report',compact('sections'));
    }

    public function search(Request $request){
        $section = $request->section;
        $product = $request->product;
        $start_date = $request->start_at;
        $end_date = $request->end_at;

        if(isset($section) && isset($product) && empty($start_date) && empty($end_date)){
            if($product == "الكل"){
                $invoices = invoices::select('*')->where('section_id','=',$section)->get();
                $sections = section::all();
                return view('reports.costumer_report',compact('sections'))->withDetails($invoices);
            }else{
                $invoices = invoices::select('*')->where('section_id','=',$section)->where('product','=',$product)->get();
                $sections = section::all();
                return view('reports.costumer_report',compact('sections'))->withDetails($invoices);
            }
        }else{
            if($product == "الكل"){
                $invoices = invoices::whereBetween('invoice-date',[$start_date,$end_date])->where('section_id','=',$section)->get();
                $sections = section::all();
                return view('reports.costumer_report',compact('sections'))->withDetails($invoices);
            }else{
                $invoices = invoices::whereBetween('invoice-date',[$start_date,$end_date])->where('section_id','=',$section)->where('product','=',$product)->get();
                $sections = section::all();
                return view('reports.costumer_report',compact('sections'))->withDetails($invoices);
            }
        }
    }
}

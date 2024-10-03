<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class ControllerInvoices_Report extends Controller
{
    public function index(){
        return view('reports.invoice_report');
    }

    public function search(Request $request){
        $radio = $request->radio;

        if($radio == 1){
            if(isset($request->type) && empty($request->start_end ) && empty($request->end_at)){
                $type = $request->type;
                if($request->type == 'كل الفواتير'){
                    $invoice = invoices::all();
                    return view('reports.invoice_report',compact('type'))->withDetails($invoice);
                }else{
                    $invoice = invoices::select('*')->where('status','=',$request->type)->get();
                    return view('reports.invoice_report',compact('type'))->withDetails($invoice);

                }
            }else{
                $type = $request->type;
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                if($request->type == 'كل الفواتير'){
                    $invoice = invoices::all()->whereBetween('invoice-date',[$start_at,$end_at]);
                    return view('reports.invoice_report',compact('type','start_at','end_at'))->withDetails($invoice);
                }else{
                    $invoice = invoices::whereBetween('invoice-date',[$start_at,$end_at])->where('status','=',$type)->get();
                    return view('reports.invoice_report',compact('type','start_at','end_at'))->withDetails($invoice);
                }
            }
        }else{
            $number = $request->invoice_number;
            $invoice = invoices::select('*')->where('invoice-number',$number)->get();
            return view('reports.invoice_report',compact('number'))->withDetails($invoice);
        }
    }
}

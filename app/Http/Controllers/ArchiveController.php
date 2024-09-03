<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index(){
        $invoices = invoices::onlyTrashed()->get();
        return view('invoices.archive',compact('invoices'));
    }

    public function destroy(Request $request){
        $id = $request->invoice_id;
        $invoice = invoices::withTrashed()->where('id',$id)->first();
        $invoice->forceDelete();
        session()->flash('delete');
        return redirect('/archive');
    }

    public function update(Request $request){
        $id = $request->invoice_id;
        $invoice = invoices::withTrashed()->where('id',$id)->restore();
        session()->flash('updated');
        return redirect('/archive');
    }
}

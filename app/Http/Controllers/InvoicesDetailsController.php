<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_attachements;
use App\Models\invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Auth;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function add(Request $request)
    {
        $this->validate($request,[
            'file_name' => 'mimes:jpg,jpeg,png,pdf',
        ],[
            'file_name.mimes' => 'pdf , png , jpeg , jpg :يجب ان تكون بهده الصياغ'
        ]);

        $file_name = $request->file('file_name')->getClientOriginalName();
        $attachement = new invoices_attachements();
        $attachement->file_name = $file_name;
        $attachement->invoice_number = $request->invoice_number;
        $attachement->invoice_id = $request->invoice_id;
        $attachement->created_by = Auth::user()->name;
        $attachement->save();

        $image = $request->file('file_name');
        $image->move(public_path('//attachements/'.$request->invoice_number),$file_name);
        
        session()->flash('add','تم اضافة المرفق بنجاح');
        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function delete(Request $request)
    {
        $attachement = invoices_attachements::findOrFail($request->id_file);
        $attachement->delete();
        unlink(public_path('attachements/'.$request->invoice_number.'/'.$request->file_name));
        session()->flash('delete','تم حدف المرفق بنجاح');
        return back();
    }

    public function download($number,$file){
        return response()->download(public_path('attachements/'.$number.'/'.$file));
    }
    public function view($number,$file){
        return response()->file(public_path('attachements/'.$number.'/'.$file));
    }

    public function details($id){
        $invoice = invoices::where('id',$id)->first();
        $details = invoices_details::where('id_invoice',$id)->get();
        $attachements = invoices_attachements::where('invoice_id',$id)->get();
        return view('invoices.details',compact('invoice','details','attachements'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invoices_details $invoices_details)
    {
        //
    }
}

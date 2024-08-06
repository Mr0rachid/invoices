<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_attachements;
use App\Models\invoices_details;
use App\Models\section;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = invoices::all();
        return view('invoices.invoices',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = section::all();
        return view('invoices.create',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        invoices::create([
            'invoice-number' => $request->invoice_number,
            'invoice-date' => $request->invoice_Date,
            'due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->section,
            'amount_collection' => $request->Amount_collection,
            'amount_commission' => $request->Amount_Commission,
            'discount' => $request->Discount,
            'rate-vat' => $request->Rate_VAT,
            'value-vat' => $request->Value_VAT,
            'total' => $request->Total,
            'status' => 'غير مدفوعة',
            'value-status' => 2,
            'note' => $request->note,
            'user' => $request->user
        ]);

        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'id_invoice' => $invoice_id,
            'invoice_number'=> $request->invoice_number,
            'product' => $request->product,
            'Section_id' => $request->section,
            'Status' => 'غير مدفوعة',
            'value_Status' => 2,
            'note' => $request->note,
            'user' => $request->user
        ]);

        if($request->hasFile('pic')){
            $invoice_id = invoices::latest()->first()->id;
            $file_name = $request->file('pic')->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoices_attachements();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            $name_image = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('attachements/'.$invoice_number),$name_image);
        }

        session()->flash('add','تم اضافة الفاتورة بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invoices $invoices)
    {
        //
    }

    public function getproducts($id){
        $products = DB::table('products')->where("section_id",$id)->pluck("product_name","id");
        return json_encode($products);
    }
}

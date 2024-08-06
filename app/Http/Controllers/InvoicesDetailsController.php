<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_attachements;
use App\Models\invoices_details;
use Illuminate\Http\Request;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function details($id){
        $invoice = invoices::where('section_id',$id)->first();
        $details = invoices_details::where('section_id',$id)->first();
        $id_invoice = $invoice->id;
        $attachements = invoices_attachements::where('invoice_id',$id_invoice)->first();
        return view('invoices.details',compact('invoice','details','id_invoice','attachements'));
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

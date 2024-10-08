<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\section;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $section = section::all();
        $products = products::all();
        return view('products.products',compact('section','products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'product_name' => 'required',
            'section_id' => 'required',
        ],[
            'product_name.required' => 'يرجى ادخال المنتج',
            'section_id.required' => 'يرجى اختيار نوع القسم'
        ]);

        products::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'section_id' => $request->section_id
        ]);

        session()->flash('add','تم اضافة المنتج بنجاح');
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = section::where('section_name',$request->section_name)->first()->id;
        $product = products::findOrFail($request->id);
        $validate = $request->validate([
            'product_name' => 'required',
        ],[
            'product_name.required' => 'يرجى ملاء خانة المنتج',
        ]);
        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'section_id' => $id,
        ]);

        session()->flash('edit','تم تعديل المنتج بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $product = products::findOrFail($request->id);
        $product->delete();
        session()->flash('delete','تم عملية الحذف بنجاح');
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = section::all();
        return view('sections.section',compact('sections'));
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
        $validated = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required'
        ],[
                'section_name.required' => 'يرجى ادخال القسم',
                'section_name.unique' => 'هدا القسم موجود مسبقا',
                'description.required' => 'يرجى ملاء الوصف'
        ]);
            section::create([
                'section_name' => $request->section_name,
                'description' => $request->description,
                'created_by' => (Auth::user()->name)
            ]);
            session()->flash('add','تم اضافة القسم بنجاح');
            return redirect('/section');
    }

    /**
     * Display the specified resource.
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, section $section)
    {
        $id = $request->id;

        $validate = $request->validate([
            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ],[
            'section_name.required' => 'يرجى ادخال القسم',
            'description' => 'يرجى ملاء الوصف',
            'section_name.unique' => 'هدا القسم موجود مسبقا',
        ]);
        $sectionid = Section::find($id);
        $sectionid->update([
            'section_name' => $request->section_name,
            'description' => $request->description
        ]);

        session()->flash('edit','تم تعديل القسم بنجاخ');
        return redirect('/section');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        section::find($id)->delete();
        session()->flash('delete','تم عملية الحذف بنجاح');
        return redirect('/section');
    }
}

<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;
use Purifier;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = FAQ::paginate(10);
        return view ('backend.index_faq', compact('faqs'));
    }

    public function frontend()
    {
        $faqs = Faq::all();
        $categories = $faqs->unique('faq_category')->pluck('faq_category')->all();
        $firstCategory = array_shift($categories);
        $minFirstCategory = trim(preg_replace('/\s+/', '', $firstCategory));
        return view ('frontend.support.faq', compact('faqs','categories','firstCategory','minFirstCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faqs = Faq::all();
        $categories = $faqs->unique('faq_category')->pluck('faq_category')->all();
        return view('backend.create_faq' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
        'faq_category' => 'required',
        'faq_question' =>'required',
        'faq_answer' =>'required'
        ]);
        
        $faq = new Faq;
        $faq->faq_category = $request->faq_category;
        $faq->faq_answer = Purifier::clean($request->faq_answer);
        $faq->faq_question = $request->faq_question;
        $faq->save();
        
        return redirect(route('backend.faq.index'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq = Faq::find($id);
        $faqs = Faq::all();
        $categories = $faqs->unique('faq_category')->pluck('faq_category')->all();
        return view('backend.show_faq' , compact('categories','faq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate(request(), [
        'faq_category' => 'required',
        'faq_question' =>'required',
        'faq_answer' =>'required'
        ]);
        
        $faq = Faq::find($id);
        $faq->faq_category = $request->faq_category;
        $faq->faq_answer = Purifier::clean($request->faq_answer);
        $faq->faq_question = $request->faq_question;
        $faq->save();
        
        return redirect(route('backend.faq.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->back();
    }
    
}

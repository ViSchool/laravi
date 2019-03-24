<?php

namespace App\Http\Controllers;

use App\User;
use App\Differentiation;
use Illuminate\Http\Request;

class DifferentiationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $teacher = User::find($id);
        $differentiation_groups = $teacher->differentiations->where('differentiation_group','!=','Alle')->pluck('differentiation_group')->unique();
        return view ('teacher.teacher_differentiations', compact('teacher','differentiation_groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        'differentiation_group' => 'required', 
        'differentiation_1' => 'required',
        'differentiation_2' => 'required'
        ]);

        $differentiation1 =new Differentiation;
        $differentiation1->differentiation_group = $request->differentiation_group;
        $differentiation1->differentiation_title = $request->differentiation_1;
        $differentiation1->user_id = $request->teacher_id;
        $differentiation1->save();

        $differentiation2 =new Differentiation;
        $differentiation2->differentiation_group = $request->differentiation_group;
        $differentiation2->differentiation_title = $request->differentiation_2;
        $differentiation2->user_id = $request->teacher_id;
        $differentiation2->save();

        if (isset($request->differentiation_3)) {
            $differentiation3 =new Differentiation;
            $differentiation3->differentiation_group = $request->differentiation_group;
            $differentiation3->differentiation_title = $request->differentiation_3;
            $differentiation3->user_id = $request->teacher_id;
            $differentiation3->save();
        }

        if (isset($request->differentiation_4)) {
            $differentiation4 =new Differentiation;
            $differentiation4->differentiation_group = $request->differentiation_group;
            $differentiation4->differentiation_title = $request->differentiation_4;
            $differentiation4->user_id = $request->teacher_id;
            $differentiation4->save();
        }

        if (isset($request->differentiation_5)) {
            $differentiation5 =new Differentiation;
            $differentiation5->differentiation_group = $request->differentiation_group;
            $differentiation5->differentiation_title = $request->differentiation_5;
            $differentiation5->user_id = $request->teacher_id;
            $differentiation5->save();
        }

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Differentiation  $differentiation
     * @return \Illuminate\Http\Response
     */
    public function show(Differentiation $differentiation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Differentiation  $differentiation
     * @return \Illuminate\Http\Response
     */
    public function edit(Differentiation $differentiation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Differentiation  $differentiation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Differentiation $differentiation)
    {
        $this->validate(request(), [
        'differentiation_group' => 'required', 
        'differentiation_1' => 'required',
        'differentiation_2' => 'required'
        ]);

        $differentiation1 =findOrFail::Differentiation($request->differentiationId_1);
        $differentiation1->differentiation_group = $request->differentiation_group;
        $differentiation1->differentiation_title = $request->differentiation_1;
        $differentiation1->save();

        $differentiation2 =findOrFail::Differentiation($request->differentiationId_2);
        $differentiation2->differentiation_group = $request->differentiation_group;
        $differentiation2->differentiation_title = $request->differentiation_2;
        $differentiation2->save();

        if (isset($request->differentiation_3)) {
            $differentiation3 =findOrFail::Differentiation($request->differentiationId_3);
            $differentiation3->differentiation_group = $request->differentiation_group;
            $differentiation3->differentiation_title = $request->differentiation_3;
            $differentiation3->save();
        }

        if (isset($request->differentiation_4)) {
            $differentiation4 =findOrFail::Differentiation($request->differentiationId_4);
            $differentiation4->differentiation_group = $request->differentiation_group;
            $differentiation4->differentiation_title = $request->differentiation_4;
            $differentiation4->save();
        }

        if (isset($request->differentiation_5)) {
            $differentiation5 =findOrFail::Differentiation($request->differentiationId_5);
            $differentiation5->differentiation_group = $request->differentiation_group;
            $differentiation5->differentiation_title = $request->differentiation_5;
            $differentiation5->save();
        }

        return redirect()->back();

    }


    /**
     * Switch the option to use differentiated blocks on or off. 
     * 
     * Default: switched off (all units will have default value "Alle")
     * If Teacher switches on:
     * (1) show option to administrate differentiations (via JS in view)
     * (2) for new Units: check whether teacher has already created more than one group/
     * if more than one: show differentiation group
     * if only one or none show only differentiations at createBlocks/updateBlocks
     * (3) for existing units nothing changes ("Alle" is used)
     * 
     * If Teacher switches off, after he had switched it on already
     * (1) Check if differentiations for this teacher exist
     * if one or more differenations exist show alert, that existing differentiations will be further 
     *    available, keep Administrationlinks, 
     * check for every unit if it uses differentiation 
     * - if so: keep option to change exiting units with differentiation
     * if no differentiation exists - hide administration links
     * (2) hide differentiation groups/differentiations for new units
     * 
     *  
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Differentiation  $differentiation
     * @return \Illuminate\Http\Response
     */

    public function diffSwitchOn($teacher_id) 
    {
        $teacher = User::find($teacher_id);
        $teacher->differentiation_on = 1;
        $teacher->save();
        return ("Eingeschaltet");
    }

    public function diffSwitchOff($teacher_id) 
    {
        $teacher = User::find($teacher_id);
        $teacher->differentiation_on = 0;
        $teacher->save();
        return ("Ausgeschaltet");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Differentiation  $differentiation
     * @return \Illuminate\Http\Response
     */
    public function destroy($teacher_id, $differentiation_group)
    {
        $differentiations = Differentiation::where([
            ['user_id',$teacher_id],
            ['differentiation_group',$differentiation_group],
            ])->get();
        foreach($differentiations as $differentiation) {
            $differentiation->delete();
        }
        return redirect()->back();

    }
}

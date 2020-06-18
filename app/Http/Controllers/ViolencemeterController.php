<?php

namespace App\Http\Controllers;

use App\Violencemeter;
use Illuminate\Http\Request;

class ViolencemeterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $violencemeters = Violencemeter::all();
        if($request->wantsJson()){
            return response()->json(compact('violencemeters'));
        }
        return view('violencemeters.index');
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
        $name = $request->get('name');
        $risk_level = $request->get('risk_level');
        $attention_route = $request->get('attention_route');
        Violencemeter::create([
            'name'=>$request->get('name'),
            'risk_level'=>$request->get('risk_level'),
            'attention_route'=>$request->get('attention_route')
        ]);
        return response()->json([
            'status'=>201,
            'message'=>'Nuevo item creado'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Violencemeter  $violencemeter
     * @return \Illuminate\Http\Response
     */
    public function show(Violencemeter $violencemeter)
    {
        return response()->json($violencemeter);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Violencemeter  $violencemeter
     * @return \Illuminate\Http\Response
     */
    public function edit(Violencemeter $violencemeter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Violencemeter  $violencemeter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Violencemeter $violencemeter)
    {
        $violencemeter->name = $request->get('name');
        $violencemeter->risk_level = $request->get('risk_level');
        $violencemeter->attention_route = $request->get('attention_route');
        $violencemeter->save();
        return response()->json([
            'status'=>200,
            'message'=>'Item actualizado exitosamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Violencemeter  $violencemeter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Violencemeter $violencemeter)
    {
        $violencemeter->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Item eliminado exitosamente'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Http\Requests\StoreHabitacionRequest;
use App\Http\Requests\UpdateHabitacionRequest;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Habitacion::with('hotel')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHabitacionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHabitacionRequest $request)
    {
        $habitacion = Habitacion::create($request->all());

        return response()->json($habitacion, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function show(Habitacion $habitacion,$id)
    {
        return response()->json(Habitacion::find($id), 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHabitacionRequest  $request
     * @param  \App\Models\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHabitacionRequest $request, Habitacion $habitacion,$id)
    {
        $habitacion = Habitacion::find($id);
        $habitacion->update($request->all());

        return response()->json($habitacion, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Habitacion $habitacion,$id)
    {
        $habitacion = Habitacion::find($id);
        $habitacion->delete();

        return response()->json(null, 204);
    }
}

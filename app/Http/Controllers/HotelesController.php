<?php

namespace App\Http\Controllers;

use App\Models\Hoteles;
use App\Http\Requests\StoreHotelesRequest;
use App\Http\Requests\UpdateHotelesRequest;
use PHPUnit\Runner\Hook;

class HotelesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Hoteles::orderBy('id','desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHotelesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHotelesRequest $request)
    {
        $hotel = Hoteles::create($request->all());
        return response()->json(['data'=> $hotel,'message'=> 'Hotel creado exitosamente!'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hoteles  $hoteles
     * @return \Illuminate\Http\Response
     */
    public function show(Hoteles $hoteles,$id)
    {
        return response()->json(Hoteles::find($id), 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHotelesRequest  $request
     * @param  \App\Models\Hoteles  $hoteles
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHotelesRequest $request, Hoteles $hoteles,$id)
    {
        $hoteles = Hoteles::find($id);
        $hoteles->update($request->all());

        return response()->json(['data'=> $hoteles,'message'=> 'Hotel creado exitosamente!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hoteles  $hoteles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hoteles $hoteles,$id)
    {
        $hoteles = Hoteles::find($id);
        $hoteles->delete();

        return response()->json(null, 204);
    }
}

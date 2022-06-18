<?php

namespace App\Http\Controllers;

use App\Models\Hoteles;
use App\Http\Requests\StoreHotelesRequest;
use App\Http\Requests\UpdateHotelesRequest;

class HotelesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Hoteles::all();
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

        return response()->json($hotel, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hoteles  $hoteles
     * @return \Illuminate\Http\Response
     */
    public function show(Hoteles $hoteles)
    {
        return response()->json(Hoteles::find($hoteles), 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHotelesRequest  $request
     * @param  \App\Models\Hoteles  $hoteles
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHotelesRequest $request, Hoteles $hoteles)
    {
        $hoteles->update($request->all());

        return response()->json($hoteles, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hoteles  $hoteles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hoteles $hoteles)
    {
        $hoteles->delete();

        return response()->json(null, 204);
    }
}

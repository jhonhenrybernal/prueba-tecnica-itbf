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
        //
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
     * @param  \App\Http\Requests\StoreHotelesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHotelesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hoteles  $hoteles
     * @return \Illuminate\Http\Response
     */
    public function show(Hoteles $hoteles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hoteles  $hoteles
     * @return \Illuminate\Http\Response
     */
    public function edit(Hoteles $hoteles)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hoteles  $hoteles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hoteles $hoteles)
    {
        //
    }
}

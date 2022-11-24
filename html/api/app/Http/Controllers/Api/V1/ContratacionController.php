<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Contratacion;
use Illuminate\Http\Request;

use App\Http\Resources\V1\ContratacionResource;
use App\Http\Resources\V1\ContratacionCollection;

class ContratacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ContratacionResource::collection(Contratacion::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contratacion  $contratacion
     * @return \Illuminate\Http\Response
     */
    public function show(Contratacion $contratacion)
    {
        //
        return new ContratacionResource($contratacion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contratacion  $contratacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contratacion $contratacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contratacion  $contratacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contratacion $contratacion)
    {
        //
    }
}

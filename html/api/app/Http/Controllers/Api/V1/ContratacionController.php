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
    /**
     * @OA\Get(
     *     path="/api/v1/contratacion/",
     *     summary="Lista de contrataciones",
     *     description="Devuelve la lista de los datos de todas las contrataciones almacenadas en el sistema",
     *     operationId="v1getContratacionList",
     *     tags={"V1"},
     *     security={{"bearerAuth":{}}},

     *     @OA\Response(
     *         response=200,
     *         description="Json con datos de la lista de contrataciones",
     *         @OA\JsonContent()
     *
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="No autentificado",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated"),
     *         )
     *     )
     *
     * )
     *
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

     /**
     * @OA\Get(
     *     path="/api/v1/contratacion/{contratacionId}",
     *     summary="Buscar una contratación por ID",
     *     description="Devuelve la información de una contratación específico",
     *     operationId="v1getContratacion",
     *     tags={"V1"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="contratacionId",in="path",required=true,
     *      description="ID de la Contratación",
     *      @OA\Schema(type="integer",default="1",format="int64")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Se optiene los datos con éxito",
     *          @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="No se encontraron datos",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="No autentificado",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated"),
     *         )
     *     )
     *
     * )
     *
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

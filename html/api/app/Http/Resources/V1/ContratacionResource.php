<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ContratacionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'objeto_contracion' => $this->objeto_contracion,
            'cuce' => $this->cuce,
            'estado' => [
                'id' => $this->estado->id,
                'name' => $this->estado->nombre
            ],

            'tipo' => [
                'id' => $this->estado->id,
                'name' => $this->estado->nombre
            ],
            'modalidad' => [
                'id' => $this->modalidad->id,
                'sigla' => $this->modalidad->sigla
            ],
            'procesador' => $this->procesador,
            'codigo_interno' => $this->codigo_interno,
            'proponente' => $this->proponente,
            'monto' => $this->monto,

        ];
    }
}

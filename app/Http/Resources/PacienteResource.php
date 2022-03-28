<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
USE Illuminate\Support\Str;

class PacienteResource extends JsonResource
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
            'identificador' => $this->id, //CAMBIAR PROPIEDAD
            'nombre' => Str::of($this->nombre)->upper(), //CAMBIAR DE FORMATO DE LAS  PALARAS
            'apellido' => Str::of($this->apellido)->upper(),
            'edad' => $this->edad,
            'sexo' => $this->sexo,
            'CI' => $this->CI,
            'tipo_sangre' => $this->tipo_sangre,
            'telefono' => $this->telefono,
            'correo' => $this->correo,
            'direccion' => $this->direccion,
            'Fecha_creado' => $this->created_at->format('d-m-Y'), //CAMBIAR FORMATO DE FECHA
            'Fecha_modificada' => $this->updated_at->format('d-m-Y') //PUEDE MOSTRAR DATOS OCULTOS DEFINIDOS EN HIDDEN

            //UTIL CUANDO QUIERES CAMBIAR DE INGLES A ESPAÑOL PARA EL FRONT

        ];
        /* return parent::toArray($request); */
    }

    public function with($request)
    {
        return [
            'res' => true,
        ];
    }
}

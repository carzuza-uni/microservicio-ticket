<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Libro extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'libro_id ' => $this->libro_id ,
            'nombre' => $this->nombre,
            'autor' => $this->autor,
            'anio_edicion' => $this->anio_edicion,
        ];
        //return parent::toArray($request);
    }
}

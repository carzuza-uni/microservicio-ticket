<?php

namespace App\Services;

use App\Repositories\TicketRepository;
use Illuminate\Support\Facades\Validator;


class TicketService
{
    public $repositoryTicket;

    public function __construct()
    {
        $this->repositoryTicket = new TicketRepository();
    }

    public function crud($request){
        $data = $request;

        $datosValidar['parking_space_id'] = 'required';
        $datosValidar['placa'] = 'required';
        $datosValidar['fecha_entrada'] = 'required';
        $datosValidar['hora_entrada'] = 'required';

        $mensajeValidar = [
            'required' => 'El campo :attribute es obligatorio.',
            'max' => 'El :attribute no puede ser mayor que :max.',
        ];

        $customAttributes = [
            'parking_space_id' => 'espacio de estacionamiento',
            'placa' => 'Placa',
            'fecha_entrada' => 'Fecha de entrada',
            'hora_entrada' => 'Hora de entrada',
        ];

        $validator = Validator::make($data, $datosValidar, $mensajeValidar, $customAttributes);
        if ($validator->fails()) {
            $message = $validator->errors()->toArray();
            $res = [false, $message, 'Todos los campos son obligatorias*'];
            return [$message,200];
        }
        $datos = [];
        $datos = $this->repositoryTicket->crear($data);
        
        $res = [true, [], 'Datos guardados con éxito!'];
        return [$datos,200];
    }

    public function detalle($id){
        $datos = $this->repositoryTicket->detalle($id);
        $res = [true, $datos, 'Detalle del Ticket'];
        return [$datos,200];
    }

    public function listado(){
        $datos = $this->repositoryTicket->listado();
        $res = [true, $datos, 'Listado de Tickets'];
        return [$datos,200];
    }

    public function cambiarEstado($id, $estado){
        $datos = $this->repositoryTicket->cambiarEstado($id, $estado);
        $res =  ['res' => true, 'data' => [], 'message' => 'Ticket cancelado con éxito!'];
        return [$res,200];
    }
}

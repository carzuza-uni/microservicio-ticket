<?php

namespace App\Services;

use App\Repositories\LiquidacionRepository;
use App\Repositories\TicketRepository;
use Illuminate\Support\Facades\Validator;


class LiquidacionService
{
    public $repositoryLiquidacion;

    public function __construct()
    {
        $this->repositoryLiquidacion = new LiquidacionRepository();
    }

    public function crud($request){
        $data = $request;

        $datosValidar['ticket_id'] = 'required';
        $datosValidar['valor'] = 'required';

        $mensajeValidar = [
            'required' => 'El campo :attribute es obligatorio.',
            'max' => 'El :attribute no puede ser mayor que :max.',
        ];

        $customAttributes = [
            'ticket_id' => 'ID Ticket',
            'valor' => 'Valor',
        ];

        $validator = Validator::make($data, $datosValidar, $mensajeValidar, $customAttributes);
        if ($validator->fails()) {
            $message = $validator->errors()->toArray();
            $res = ['res' => false, 'data' => $message, 'message' => 'Todos los campos son obligatorias*'];
            return [$res,200];
        }
        $repositoryTicket = new TicketRepository();
        $ticket = $repositoryTicket->detalle($data['ticket_id']);
        if(empty($ticket) || $ticket['estado'] == 3){
            $res =  ['res' => false, 'data' => [], 'message' => 'El ID Ticket no se encuentra registrado'];
            return [$res,200];
        }
        $datos = $this->repositoryLiquidacion->crear($data);
        // liquidar
        $repositoryTicket->liquidar($data['ticket_id']);
        
        $res = [true, [], 'Liquidación realizada con éxito!'];
        return [$datos,200];
    }

    public function listado(){
        $datos = $this->repositoryLiquidacion->listado();
        $res = [true, $datos, 'Listado de liquidaciones'];
        return [$datos,200];
    }

    public function cambiarEstado($id, $estado){
        $datos = $this->repositoryLiquidacion->cambiarEstado($id, $estado);
        $repositoryTicket = new TicketRepository();
        $repositoryTicket->cancelarLiquidacion($datos['ticket_id']);
        $res =  ['res' => true, 'data' => [], 'message' => 'Liquidacion cancelada con éxito!'];
        return [$res,200];
    }
}

<?php

namespace App\Repositories;

use App\Models\Ticket;

class TicketRepository
{
    protected $modelTicket;

    /**
     * __construct function
     */
    public function __construct()
    {
        $this->modelTicket = new Ticket();
    }

    public function crear($data){
        $this->modelTicket->parking_space_id = $data['parking_space_id'];
        $this->modelTicket->placa = $data['placa'];
        $this->modelTicket->fecha_entrada = $data['fecha_entrada'];
        $this->modelTicket->hora_entrada = $data['hora_entrada'];
        $this->modelTicket->saveOrFail();
        return $this->modelTicket;
    }

    public function detalle($ticket_id){
        $ticket = Ticket::where('ticket_id',$ticket_id)->first();
        return $ticket ? $ticket->toArray() : [];
    }

    public function listado(){
        return $this->modelTicket->orderBy('ticket_id', 'DESC')
            ->get()
            ->toArray();
    }

    // public function listadoVehiculo($vehiculo_id){
    //     return $this->modelTicket->where('vehiculo_id',$vehiculo_id)
    //         ->orderBy('nombre', 'ASC')
    //         ->get()
    //         ->toArray();
    // }

    public function cambiarEstado($ticket_id, $estado){
        $ticket = $this->modelTicket->findOrFail($ticket_id);
        $ticket->estado = $estado;
        $ticket->update();
        return $ticket;
    }

    public function liquidar($ticket_id){
        $ticket = $this->modelTicket->findOrFail($ticket_id);
        $ticket->fecha_salida = date('Y-m-d');
        $ticket->hora_salida = date('H:i');
        $ticket->estado = 2; // Cerrado
        $ticket->update();
        return $ticket;
    }

    public function cancelarLiquidacion($ticket_id){
        $ticket = $this->modelTicket->findOrFail($ticket_id);
        $ticket->fecha_salida = null;
        $ticket->hora_salida = null;
        $ticket->estado = 1; // Ingresado
        $ticket->update();
        return $ticket;
    }
}
<?php

namespace App\Repositories;

use App\Models\Liquidacion;

class LiquidacionRepository
{
    protected $modelLiquidacion;

    /**
     * __construct function
     */
    public function __construct()
    {
        $this->modelLiquidacion = new Liquidacion();
    }

    public function crear($data){
        $this->modelLiquidacion->ticket_id = $data['ticket_id'];
        $this->modelLiquidacion->valor = $data['valor'];
        $this->modelLiquidacion->fecha = date('Y-m-d H:i:s');
        $this->modelLiquidacion->saveOrFail();
        return $this->modelLiquidacion;
    }

    public function listado(){
        return $this->modelLiquidacion->orderBy('liquidacion_id', 'DESC')
            ->get()
            ->toArray();
    }

    public function cambiarEstado($liquidacion_id, $estado){
        $ticket = $this->modelLiquidacion->findOrFail($liquidacion_id);
        $ticket->estado = $estado;
        $ticket->update();
        return $ticket;
    }
}
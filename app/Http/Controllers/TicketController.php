<?php

namespace App\Http\Controllers;

use App\Services\TicketService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    private $serviceTicket;

    public function __construct()
    {
        $this->serviceTicket = new TicketService();
    }

    public function listado()
    {
        $r = $this->serviceTicket->listado();
        return response()->json($r[0],$r[1]);
    }

    public function store(Request $request)
    {
        $r = $this->serviceTicket->crud($request->all());
        return response()->json($r[0],$r[1]);
    }

    public function detalle($id)
    {
        $r = $this->serviceTicket->detalle($id);
        return response()->json($r[0],$r[1]);
    }

    public function cambiarEstado($id, $estado)
    {
        $r = $this->serviceTicket->cambiarEstado($id, $estado);
        return response()->json($r[0],$r[1]);
    }

    
}

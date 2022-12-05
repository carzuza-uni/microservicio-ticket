<?php

namespace App\Http\Controllers;

use App\Services\LiquidacionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LiquidacionController extends Controller
{
    private $serviceLiquidacion;

    public function __construct()
    {
        $this->serviceLiquidacion = new LiquidacionService();
    }

    public function listado()
    {
        $r = $this->serviceLiquidacion->listado();
        return response()->json($r[0],$r[1]);
    }

    public function store(Request $request)
    {
        $r = $this->serviceLiquidacion->crud($request->all());
        return response()->json($r[0],$r[1]);
    }

    public function cambiarEstado($id, $estado)
    {
        $r = $this->serviceLiquidacion->cambiarEstado($id, $estado);
        return response()->json($r[0],$r[1]);
    }

    
}

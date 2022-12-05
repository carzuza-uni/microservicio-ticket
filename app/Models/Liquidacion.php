<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    protected $table = 'liquidaciones';
    protected $primaryKey = 'liquidacion_id';
    public $timestamps = false;

    //protected $with = ['ticket'];

    public function ticket(){
        return $this->hasOne('App\Models\Ticket','ticket_id','ticket_id');
    }
}

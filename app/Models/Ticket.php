<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'ticket_id';
    public $timestamps = false;

    protected $with = ['liquidacion'];

    public function liquidacion(){
        return $this->hasOne('App\Models\Liquidacion','ticket_id','ticket_id');
    }
}

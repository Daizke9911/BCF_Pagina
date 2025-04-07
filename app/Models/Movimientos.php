<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimientos extends Model
{
    protected $fillable = [
        'user_id',
        'reference',
        'concept',
        'movedMoney',
        'saldo',
        'cuentaType',
        'cuenta_transferida',
        'user_id_transferido',
        'cuenta_recibida',
        'user_id_recibido',
        'created_at'
    ];

    public function user(){
        return $this->belongsTo(Cuenta::class);
    }
}

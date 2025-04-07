<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $fillable = [
        'cedula',
        'phone',
        'nacimiento',
        'user_id',
        'accountNumber',
        'availableBalance',
        'cuentaType'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function movimientos(){
        return $this->hasMany(Movimientos::class);
    }
}

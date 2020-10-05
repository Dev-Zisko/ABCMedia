<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayPI extends Model
{
    protected $fillable = [
        'metodo', 'estado', 'fecha', 'monto', 'id_user', 'id_product',
    ];
}

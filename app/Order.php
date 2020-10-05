<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'mensaje', 'cantidad', 'fecha', 'id_user', 'id_product',
    ];
}

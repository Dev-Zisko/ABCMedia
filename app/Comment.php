<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'nombre', 'descripcion', 'fecha', 'id_user', 'id_product',
    ];
}

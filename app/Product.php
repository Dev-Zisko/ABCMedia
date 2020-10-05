<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nombre', 'categoria', 'descripcion', 'precio', 'preciobs', 'cantidad', 'peso', 'medidas', 'imagen1', 'imagen2', 'imagen3', 'id_user',
    ];
}

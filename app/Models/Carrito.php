<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carrito';
    protected $fillable = array(
                        'nombre',
                        'imagen',
                        'precio',
                        'cantidad',
                        'total'
                        );
    protected $primaryKey = 'id';
    protected $hidden = [
        'created_at', 'updated_at','deleted_at'
    ];
}

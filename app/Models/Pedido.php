<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedido';
    protected $fillable = array(
                        'fecha',
                        'nombre_cli',
                        'apellido_cli',
                        'dni_cli',
                        'telefono_cli',
                        'correo_cli',
                        'departamento_cli',
                        'distrito_cli',
                        'direccion_cli',
                        'referencia_cli',
                        'mensaje_cli',
                        'producto',
                        'metodo_pago',
                        'banca_billetera',
                        'estado_pedido'
                        );
    protected $primaryKey = 'id';
    protected $hidden = [
        'created_at', 'updated_at','deleted_at'
    ];
}

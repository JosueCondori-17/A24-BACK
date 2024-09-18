<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $fillable = [
        'id_categoria',
        'nombre',
        'precio',
        'stock',
        'imagen',
        'nombre_categoria'
    ];
    protected $primaryKey = 'id';
    protected $hidden = [
        'created_at', 'updated_at','deleted_at'
    ];
    protected $appends = [
        'url_imagen'
    ];

    public function getUrlImagenAttribute()
    {
        return asset('storage/productos/'.$this -> imagen);
    }
    public function Categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id');
    }
}

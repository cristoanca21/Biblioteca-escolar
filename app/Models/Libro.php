<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $fillable = [
        'categoria_id',
        'titulo',
        'autor',
        'año',
        'portada',
    ];
    
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}

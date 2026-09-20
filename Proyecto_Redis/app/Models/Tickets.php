<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'Persona'];

    public function scopePersona($query, $persona)
    {
        return $query->where('Persona', $persona);
    }

    public function scopeBuscar($query, $texto)
    {
        return $query->where('nombre', 'like', "%{$texto}%");
    }
}
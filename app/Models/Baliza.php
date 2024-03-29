<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baliza extends Model {

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 'latitud', 'longitud', 'altitud', 'temperatura', 'humedad', 'viento', 'viento Max', 'viento Dir', 'precipitacion'
    ];
}
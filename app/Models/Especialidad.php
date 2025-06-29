<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = 'especialidad';
    protected $primaryKey = 'id_especialidad';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function getRouteKeyName()
    {
        return 'id_especialidad';
    }

    public function medico()
    {
        return $this->hasMany(Medico::class, 'id_especialidad', 'id_especialidad');
    }
}


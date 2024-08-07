<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vacante extends Model
{
    use HasFactory;

    protected $casts = ['ultimo_dia'=>'date'];

    protected $fillable = [
        'titulo',
        'salario_id',
        'categoria_id',
        'empresa',
        'ultimo_dia',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function categoria(){
        return $this->belongsTo(categoria::class);
    }

    public function salario(){
        return $this->belongsTo(salario::class);
    }

    public function candidato(){
        return $this->hasMany(candidato::class)->orderBy('created_at', 'DESC');
    }

    public function reclutador(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

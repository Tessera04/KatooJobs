<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use Livewire\Component;

class CrearVacante extends Component
{
    public $titulo;
    public $categoria;
    public $salario;
    public $empresa;
    public $descripcion;
    public $imagen;
    public $ultimo_dia;

    protected $rules = [
        'titulo' => 'required|string',
        'categoria' => 'required',
        'salario' => 'required',
        'empresa' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required',
        'ultimo_dia' => 'required',
    ];

    public function crearVacante(){
        $datos = $this->validate();
    }

    public function render()
    {
        //Consultar BD
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}

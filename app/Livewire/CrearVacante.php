<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\vacante;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CrearVacante extends Component
{
    public $titulo;
    public $categoria;
    public $salario;
    public $empresa;
    public $descripcion;
    public $imagen;
    public $ultimo_dia;

    use WithFileUploads;

    protected $rules = [
        'titulo' => 'required|string',
        'categoria' => 'required',
        'salario' => 'required',
        'empresa' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024',
        'ultimo_dia' => 'required',
    ];

    public function crearVacante(){
        $datos = $this->validate();

        //Almacenar imagen

        $imagen = $this->imagen->store('public/vacantes');
        $datos['imagen'] = str_replace('public/vacantes/', '', $imagen);
        //Crear Vacante, llamar controller

        vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $datos['imagen'],
            'user_id' => auth()->user()->id
        ]);

        //Crear Mensaje
        session()->flash('mensaje', 'Tu vacante se publico correctamente');

        //Redireccionar usuario
        return redirect()->route('vacantes.index');
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

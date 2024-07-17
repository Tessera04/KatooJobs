<?php

namespace App\Livewire;

use App\Models\Salario;
use App\Models\Categoria;
use App\Models\vacante;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditarVacantes extends Component
{
    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    public $imagen_nueva;

    use WithFileUploads;

    protected $rules = [
        'titulo' => 'required|string',
        'categoria' => 'required',
        'salario' => 'required',
        'empresa' => 'required',
        'descripcion' => 'required',
        'ultimo_dia' => 'required',
        'imagen_nueva' => 'nullable|image|max:1024',
    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante_id = $vacante->id; //esto no funciona
        //le estamos diciendo que este titulo es el mismo que el de editar-vacantes, por eso lo completa en la vista del otro 
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;
    }
    
    public function editarVacante()
    {
        //$datos tiene la data nueva, despues de la validacion
        $datos = $this->validate();

        //Si hay una nueva imagen
        if($this->imagen_nueva){
            $imagen = $this->imagen_nueva->store('public/vacantes');
            $datos['imagen'] = str_replace('public/vacantes/', '', $imagen);
        }

        //Encontrar vacante a editar
        //$vacante tiene la data de la base de datos
        $vacante = Vacante::find($this->vacante_id);

        //Asignar los valores
        //Asi entonces reescribimos vacante (base de datos) con el valor actual de $datos[titulo] (lo que pusimos nuevo)
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->ultimo_dia = $datos['ultimo_dia'];
        $vacante->descripcion = $datos['descripcion'];
        $vacante->imagen = $datos['imagen'] ?? $vacante->imagen;

        //Guardar la vacante
        $vacante->save();

        //Redireccionar
        session()->flash('mensaje', 'La Vacante se actualizo correctamente');

        return redirect()->route('vacantes.index');
    }

    public function render()
    {

        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.editar-vacantes', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}

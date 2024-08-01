<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\vacante;
use App\Notifications\NuevoCandidato;

class PostularVacante extends Component
{
    use WithFileUploads;

    public $cv;
    public $vacante;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    public function mount(vacante $vacante){
        $this->vacante = $vacante;
    }

    public function postularme(){
        $this->validate();

        //Almacenar cv en el disco duro
        $datos = $this->validate();

        $cv = $this->cv->store('public/cv');
        $datos['cv'] = str_replace('public/cv/', '', $cv);

        //Crear candidato a la Vacante
        $this->vacante->candidato()->create([
            'user_id' => auth()->user()->id,
            'cv' => $datos['cv']
        ]);

        //Crear notificacion y enviar el email
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));

        //Mostrar al user que esta todo ok
        session()->flash('mensaje', 'Su informacion se envio exitosamente, muchas gracias!!');
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}

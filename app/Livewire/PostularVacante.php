<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{

    use WithFileUploads;
    public $cv;
    public $vacante;

    protected $rules = [
        'cv' =>'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante){
    $this->vacante = $vacante;
    }

    public function postularme(){
    
    $datos = $this->validate();

    //Almacenar cv
    $nombreArchivo = time() . '.' . $this->cv->getClientOriginalExtension();
    $this->cv->storeAs('cv', $nombreArchivo, 'public');
    $datos['cv'] = $nombreArchivo;
    
        //crear candidato vacante
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $datos['cv'],
            'vacante_id' => $this->vacante->id,
        ]);
        
        //crear notificacion
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id ));


        //mostrar al usuario un ok
        session()->flash('mensaje', 'El CV se envió correctamente, Buena Suerte!');
        return redirect()->back();
    }


    public function render()
    {
        return view('livewire.postular-vacante');
    }
}

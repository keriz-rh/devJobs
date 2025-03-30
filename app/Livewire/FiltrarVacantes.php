<?php

namespace App\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;

class FiltrarVacantes extends Component
{
    public $termino;
    public $categoria; // Aquí almacenamos la categoría seleccionada
    public $salario;   // Aquí almacenamos el salario seleccionado

    // Método para disparar el evento cuando se envía el formulario
    public function leerDatosFormulario()
    {
        // Disparamos el evento para actualizar las vacantes con los filtros aplicados
        $this->dispatch('terminosBusqueda', $this->termino, $this->categoria, $this->salario);
    }

    // Método render para cargar las categorías y salarios
    public function render()
    {
        $categorias = Categoria::all();  // Cargar todas las categorías
        $salarios = Salario::all();      // Cargar todos los salarios
    
        return view('livewire.filtrar-vacantes', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}

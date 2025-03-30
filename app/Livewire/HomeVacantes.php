<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{
    public $termino;
    public $categoria;
    public $salario;

    // Escucha el evento disparado desde el componente FiltrarVacantes
    protected $listeners = ['terminosBusqueda' => 'buscar'];

    // Método que maneja la actualización de los filtros
    public function buscar($termino, $categoria, $salario)
    {
        $this->termino = $termino;
        $this->categoria = $categoria;
        $this->salario = $salario;
    }

    public function render()
    {
        // Query para filtrar las vacantes basándose en los filtros
        $vacantes = Vacante::when($this->termino, function($query) {
                return $query->where('titulo', 'LIKE', '%' . $this->termino . '%');
            })
            ->when($this->termino, function($query) {
                return $query->orWhere('empresa', 'LIKE', '%' . $this->termino . '%');
            })
            ->when($this->categoria, function($query) {
                return $query->where('categoria_id', $this->categoria);
            })
            ->when($this->salario, function($query) {
                return $query->where('salario_id', $this->salario);
            })
            ->paginate(10);

        return view('livewire.home-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}

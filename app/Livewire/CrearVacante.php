<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Vacante;

class CrearVacante extends Component
{

    public  $titulo;
    public  $salario;
    public  $categoria;
    public  $empresa;
    public  $ultimo_dia;
    public  $descripcion;
    public  $imagen;

    use WithFileUploads;

    public $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required|date|after:today',
        'descripcion' => 'required|max:350',
        'imagen' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',

    ];

    public function crearVacante()
{
    // Valida los datos
    $datos = $this->validate();

   //Almacenar imagen
   $nombreImagen = time() . '.' . $this->imagen->getClientOriginalExtension();
   $this->imagen->storeAs('vacantes', $nombreImagen, 'public');
   $datos['imagen'] = $nombreImagen;
   
   // dd($nombre_imagen);

   //Crear la vacante
   Vacante::create([
    'titulo' => $datos['titulo'],
    'salario_id'=> $datos['salario'], 
    'categoria_id'=> $datos['categoria'],
    'empresa'=> $datos['empresa'],
    'ultimo_dia'=> $datos['ultimo_dia'],
    'descripcion'=> $datos['descripcion'],
    'imagen'=> $datos['imagen'],
    'user_id'=> auth()->user()->id,
   ]);

   //crear mensaje
    session()->flash('mensaje', 'Vacante creada exitosamente!');

    //Redireccionar
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

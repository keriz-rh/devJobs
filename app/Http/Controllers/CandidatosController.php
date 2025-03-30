<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacante;

class CandidatosController extends Controller
{
    public function index(Vacante $vacante){
        return view('candidatos.index', [
            'vacante' => $vacante
        ]);
    }
}

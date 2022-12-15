<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // La función __construct se ejectuca cuando el ceste controlador (PostController) es instanciado
    // Lo protegemos con midelware para que si no esta atutenticado no permita redirigir al muro.
    // Midelware se ejectura antes de la función index para comprobarlo.
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       return view('layouts.dashboard');
    }
}


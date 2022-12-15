<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    public function index(User $user)
    {
        // Redirige a su propio muro. Y le pasa el username al módelo dashboard.

       return view('layouts.dashboard', [
        'user' => $user
       ]);
    }
}


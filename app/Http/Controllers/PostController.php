<?php

namespace App\Http\Controllers;

use App\Models\Post;
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

    public function create()
    {
        //dd('Creando post...');

        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        // Otra forma de crear registros en base de datos.

        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->titulo = $request->descripcion;
        // $post->titulo = $request->imagen;
        // $post->titulo = auth()->user()->id;

        return redirect()->route('posts.index', auth()->user()->username);
    }
}


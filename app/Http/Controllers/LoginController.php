<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
       

        // dd es como un console log para comprobar.
        // Por ejemplo ahora comprobamos que los endpoints se estan comunicanco correctamente.
        // dd('Autenticando');
        
        $this->validate($request,[

            'email'=>'required|email',
            'password'=>'required',
        ]);

        

        // Con este if le preguntamos si el email y la contraseñas son correctas.
        // Construimos el mensaje en el controlador y lo consumimos en una vista.
        // Mantener sesion abierta con checkbox. Se cominuca con la vista de Login. (remember)
        // Cuando señalamos mantener sesión abierta, Laravelkl crea otra cookie y en la base de datos
        // En la tabla users vemos que se rellena la columna remember_token;
        // Así compará ese campo con la has de la cookie y por eso mantiene la sesión abierta.

        if(!auth()->attempt($request->only('email', 'password'), $request->remember))
        {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }
        
        return redirect()->route('posts.index', auth()->user()->username);
    }
}

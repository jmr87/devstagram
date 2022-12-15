<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        //Modificar Request

        $request->request->add(['username' => Str::slug($request->username)]);

        // Validación de cammpos formulario

        $this->validate($request, [
            'name'=>'required|max:40',
            'username'=>'required|unique:users|min:3|max:20',
            'email'=>'required|unique:users|email|max:60',
            'password'=>'required|confirmed|min:6',
            
        ]); 

        // Creación de usuario, datos que guardamos en base de datos Devstagram en la tabla users.
        // Además, la contraseña se guarda hasheada.
        User::create([
            'name' => $request->name,
            'username' =>  $request->username,
            'email' => $request->email,
            'password' => Hash::make( $request->password)
        ]);

        // Autenticar usuario, debuelve un booleano si se ha autenticado el email y el password.
        // Si devuelve false no deja ir al muro por que ese usuario no esta autenticado.

        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        // Otra forma de autenticar

        //auth()->attempt($request->only('email', 'password'));

        // Redireccionar al usuario cuando ha creado una cuenta.

        return redirect()->route('post.index');


    }
}

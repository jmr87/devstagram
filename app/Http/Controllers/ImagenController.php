<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $imagen = $request->file('file');

        // Generamos un id único para cada una de las imagenes que se suban.

        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        // ImagenServidor será una instancio de Intervension image. Podemos hacer muchas cosas con las imagenes con esta biblioteca. 
        // https://intervention.io/ - Consultar para más efectos.

        $imagenServidor = Image::make($imagen);
        
        // Con fit recortamos la imagen por pixeles.

        $imagenServidor->fit(1000, 1000);

        // Movemos la imagen a algún lugar del servidor. Dentro de la carpeta public en uploads.

        $imagenPath = public_path('uploads') . '/' . $nombreImagen;

        // Nunca se guardan las imagenes en base de datos. Guardamos el nombre único.
        $imagenServidor->save($imagenPath);



        return response()->json(['imagen' => $nombreImagen]);
    }
}

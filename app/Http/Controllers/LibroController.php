<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LibroController extends Controller
{
    // Mostrar lista de libros
    public function index()
    {
        $libros = Libro::with('categoria')->get()->map(function ($libro) {
            return [
                'id'        => $libro->id,
                'titulo'    => $libro->titulo,
                'autor'     => $libro->autor,
                'anio'      => $libro->año, 
                'categoria' => $libro->categoria,
                'portada'   => $libro->portada ?? null,
            ];
        });

        return Inertia::render('Libros/Index', [
            'libros' => $libros
        ]);
    }

    // Formulario de creación
    public function create()
    {
        return Inertia::render('Libros/Create', [
            'categorias' => Categoria::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'       => 'required|string|max:255',
            'autor'        => 'required|string|max:255',
            'anio'         => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'portada'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $base64Image = null;

        if ($request->hasFile('portada')) {
            $file = $request->file('portada');
            $mime = $file->getClientMimeType();
            $data = base64_encode(file_get_contents($file->getRealPath()));
            $base64Image = "data:{$mime};base64,{$data}";
        }

        Libro::create([
            'categoria_id' => $request->categoria_id,
            'titulo'       => $request->titulo,
            'autor'        => $request->autor,
            'año'          => $request->anio, 
            'portada'      => $base64Image,
        ]);

        return redirect()->route('libros.index');
    }

    // Formulario de Edición
    public function edit(Libro $libro)
    {
        return Inertia::render('Libros/Edit', [
            'libro' => [
                'id'           => $libro->id,
                'titulo'       => $libro->titulo,
                'autor'        => $libro->autor,
                'anio'         => $libro->año, 
                'categoria_id' => $libro->categoria_id,
                'portada'      => $libro->portada ?? null, 
            ],
            'categorias' => Categoria::all()
        ]);
    }

    public function update(Request $request, Libro $libro)
    {
        $request->validate([
            'titulo'       => 'required|string|max:255',
            'autor'        => 'required|string|max:255',
            'anio'         => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'portada'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $datos = [
            'categoria_id' => $request->categoria_id,
            'titulo'       => $request->titulo,
            'autor'        => $request->autor,
            'año'          => $request->anio,
        ];

        if ($request->hasFile('portada')) {
            $file = $request->file('portada');
            $mime = $file->getClientMimeType();
            $data = base64_encode(file_get_contents($file->getRealPath()));
            $datos['portada'] = "data:{$mime};base64,{$data}";
        }

        $libro->update($datos);

        return redirect()->route('libros.index');
    }

    public function destroy(Libro $libro)
    {
        $libro->delete();
        return redirect()->route('libros.index');
    }
}
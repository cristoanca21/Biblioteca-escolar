<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{
    // 1. Mostrar lista de libros
    public function index()
    {
        $libros = Libro::with('categoria')->get()->map(function ($libro) {
            return [
                'id'        => $libro->id,
                'titulo'    => $libro->titulo,
                'autor'     => $libro->autor,
                'anio'      => $libro->año, 
                'categoria' => $libro->categoria,
                // CORRECCIÓN: Si ya guardamos con 'storage/', jalamos la URL limpia directamente
                'portada'   => $libro->portada ? asset($libro->portada) : null,
            ];
        });

        return Inertia::render('Libros/Index', [
            'libros' => $libros
        ]);
    }

    // 2. Formulario de creación
    public function create()
    {
        return Inertia::render('Libros/Create', [
            'categorias' => Categoria::all()
        ]);
    }

    // 3. Guardar Libro
    public function store(Request $request)
    {
        $request->validate([
            'titulo'       => 'required|string|max:255',
            'autor'        => 'required|string|max:255',
            'anio'         => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'portada'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('portada')) {
            $path = $request->file('portada')->store('portadas', 'public');
        }

        Libro::create([
            'categoria_id' => $request->categoria_id,
            'titulo'       => $request->titulo,
            'autor'        => $request->autor,
            'año'          => $request->anio, 
            'portada'      => $path ? 'storage/' . $path : null, // Guarda: storage/portadas/archivo.jpg
        ]);

        return redirect()->route('libros.index');
    }

    // 4. Formulario de Edición (¡Aquí está el Actualizar - Vista!)
    public function edit(Libro $libro)
    {
        return Inertia::render('Libros/Edit', [
            'libro' => [
                'id'           => $libro->id,
                'titulo'       => $libro->titulo,
                'autor'        => $libro->autor,
                'anio'         => $libro->año, // Mapeamos de 'año' a 'anio' para el formulario Vue
                'categoria_id' => $libro->categoria_id,
                'portada'      => $libro->portada ? asset($libro->portada) : null,
            ],
            'categorias' => Categoria::all()
        ]);
    }

    // 5. Procesar la Actualización (¡Aquí está el Actualizar - Lógica!)
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
            // Eliminamos la portada vieja si existía para no llenar el disco de basura
            if ($libro->portada) {
                Storage::disk('public')->delete(str_replace('storage/', '', $libro->portada));
            }
            // Guardamos la nueva
            $path = $request->file('portada')->store('portadas', 'public');
            $datos['portada'] = 'storage/' . $path;
        }

        $libro->update($datos);

        return redirect()->route('libros.index');
    }

    // 6. Eliminar libro
    public function destroy(Libro $libro)
    {
        if ($libro->portada) {
            Storage::disk('public')->delete(str_replace('storage/', '', $libro->portada));
        }
        $libro->delete();
        return redirect()->route('libros.index');
    }
}
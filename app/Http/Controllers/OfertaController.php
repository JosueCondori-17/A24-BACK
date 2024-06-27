<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfertaController extends Controller
{
    public function index()
    {
        $ofertas = Oferta::all();
        foreach ($ofertas as $oferta) {
            if ($oferta->imagen) {
                $oferta->imagen = url('storage/' . $oferta->imagen);
            }
        }
        return response()->json($ofertas);
    }

    public function show($id)
    {
        $oferta = Oferta::findOrFail($id);
        if ($oferta->imagen) {
            $oferta->imagen = url('storage/' . $oferta->imagen);
        }
        return response()->json($oferta);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string|max:255',
            'stock' => 'required|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('images', 'public');
            $data['imagen'] = $path;
        }

        $oferta = Oferta::create($data);

        if ($oferta->imagen) {
            $oferta->imagen = url('storage/' . $oferta->imagen);
        }

        return response()->json($oferta, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string|max:255',
            'stock' => 'required|integer',
        ]);

        $oferta = Oferta::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('imagen')) {
            if ($oferta->imagen) {
                Storage::disk('public')->delete($oferta->imagen);
            }
            $path = $request->file('imagen')->store('images', 'public');
            $data['imagen'] = $path;
        }

        $oferta->update($data);

        if ($oferta->imagen) {
            $oferta->imagen = url('storage/' . $oferta->imagen);
        }

        return response()->json($oferta, 200);
    }

    public function destroy($id)
    {
        $oferta = Oferta::findOrFail($id);

        if ($oferta->imagen) {
            Storage::disk('public')->delete($oferta->imagen);
        }

        $oferta->delete();

        return response()->json(null, 204);
    }
}

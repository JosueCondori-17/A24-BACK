<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\Request;
use Exception;

class CarritoController extends Controller
{
    // Obtener todos los items del carrito
    public function index()
    {
        try {
            $items = Carrito::all();
            return response()->json($items, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener los items del carrito'], 400);
        }
    }

    // Obtener un item del carrito por ID
    public function show($id)
    {
        try {
            $item = Carrito::findOrFail($id);
            return response()->json($item, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener el item del carrito'], 400);
        }
    }

    // Agregar un nuevo item al carrito
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'imagen' => 'nullable|string|max:555',
                'precio' => 'required|numeric',
                'cantidad' => 'required|integer',
                'total' => 'required|numeric'
            ]);

            $data = $request->all();

            $item = Carrito::create($data);

            return response()->json($item, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al agregar el item al carrito'], 400);
        }
    }

    // Actualizar un item del carrito
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nombre' => 'sometimes|required|string|max:255',
                'imagen' => 'nullable|string|max:255',
                'precio' => 'sometimes|required|numeric',
                'cantidad' => 'sometimes|required|integer',
                'total' => 'sometimes|required|numeric'
            ]);

            $item = Carrito::findOrFail($id);
            $data = $request->all();

            $item->update($data);

            return response()->json($item, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al actualizar el item del carrito'], 400);
        }
    }

    // Eliminar un item del carrito
    public function destroy($id)
    {
        try {
            $item = Carrito::findOrFail($id);
            $item->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al eliminar el item del carrito'], 400);
        }
    }
}

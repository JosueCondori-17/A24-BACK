<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class ProductoController extends Controller
{
    public function index()
    {
        try {
            $productos = Producto::all();
            return response()->json($productos);
        }
        catch (Exception $e) {
            return response()->json(["error" => "ERROR AL TRAER PRODUCTOS"], 400);
        }
    }

    public function show($id)
    {
        try {
            $producto = Producto::findOrFail($id);
            return response()->json($producto);
        } catch (Exception $e) {
            return response()->json(["error" => "ERROR AL TRAER PRODUCTO"], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_categoria' => 'nullable|exists:categoria,id',
                'nombre' => 'required|string|max:255',
                'precio' => 'required|numeric',
                'stock' => 'required|integer',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nombre_categoria' => 'required|string|max:255'
            ]);

            $producto = Producto::create([
                'id_categoria' => $request -> id_categoria,
                'nombre' =>  $request -> nombre,
                'precio' =>  $request -> precio,
                'stock' =>  $request -> stock,
                'nombre_categoria' =>  $request -> nombre_categoria
            ]);

            if ($request->hasFile('imagen')) {
                $fechaActual = Carbon::now()->format("Y-m-d-H-i-s-u");
                $imageName = $fechaActual."-prd-".$producto->id.".".$request-> imagen -> extension();
                $request->file('imagen')->storeAs('public/productos', $imageName);
                $producto -> imagen = $imageName;
                $producto->save();
            }
            return response()->json($producto, 201);

        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'ERROR AL crear un producto',
                'message' => $e->errors()
            ], 400);
        } catch (Exception $e) {
            return response()->json(["error" => "ERROR AL crear un producto"], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_categoria' => 'nullable|exists:categoria,id',
                'nombre' => 'required|string|max:255',
                'precio' => 'numeric',
                'stock' => 'integer',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nombre_categoria' => 'string|max:255'
            ]);

            $producto = Producto::findOrFail($id);
            
            $producto->fill([
                'id_categoria' => $request -> id_categoria,
                'nombre' =>  $request -> nombre,
                'precio' =>  $request -> precio,
                'stock' =>  $request -> stock,
                'nombre_categoria' =>  $request -> nombre_categoria
            ]);

            if ($request->hasFile('imagen')) {
                // Eliminar la imagen anterior si existe
                if ($producto->imagen) {
                    Storage::delete('public/productos/'.$producto->imagen);
                }

                // Almacenar la nueva imagen
                $fechaActual = Carbon::now()->format("Y-m-d-H-i-s-u");
                $imageName = $fechaActual."-prd-".$producto->id.".".$request-> imagen -> extension();
                $request->file('imagen')->storeAs('public/productos', $imageName);
                $producto -> imagen = $imageName;
            }
            // Actualizar el producto con los nuevos datos
            $producto->save();

            return response()->json($producto, 200);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'ERROR AL actualizar el producto',
                'message' => $e->errors()
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'ERROR AL actualizar el producto',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $producto = Producto::findOrFail($id);

            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }

            $producto->delete();

            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'ERROR AL eliminar el producto',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}

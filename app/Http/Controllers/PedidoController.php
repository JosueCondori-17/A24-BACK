<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Exception;

class PedidoController extends Controller
{
    // Obtener todos los pedidos
    public function index()
    {
        try {
            $pedidos = Pedido::all();
            return response()->json($pedidos, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener los pedidos'], 400);
        }
    }

    // Obtener un pedido por ID
    public function show($id)
    {
        try {
            $pedido = Pedido::findOrFail($id);
            return response()->json($pedido, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener el pedido'], 400);
        }
    }

    // Crear un nuevo pedido
    public function store(Request $request)
    {
        try {
            $request->validate([
                'fecha' => 'required|string|max:255',
                'nombre_cli' => 'required|string|max:255',
                'apellido_cli' => 'required|string|max:255',
                'dni_cli' => 'required|integer',
                'telefono_cli' => 'required|integer',
                'correo_cli' => 'required|string|email|max:255',
                'departamento_cli' => 'required|string|max:255',
                'distrito_cli' => 'required|string|max:255',
                'direccion_cli' => 'required|string|max:255',
                'referencia_cli' => 'nullable|string|max:255',
                'mensaje_cli' => 'nullable|string|max:255',
                'producto' => 'required|string|max:555',
                'metodo_pago' => 'required|string|max:255',
                'banca_billetera' => 'required|string|max:255',
                'estado_pedido' => 'required|string|max:255'
            ]);

            $pedido = Pedido::create($request->all());

            return response()->json($pedido, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al crear el pedido'], 400);
        }
    }

    // Actualizar un pedido
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'fecha' => 'sometimes|required|string|max:255',
                'nombre_cli' => 'sometimes|required|string|max:255',
                'apellido_cli' => 'sometimes|required|string|max:255',
                'dni_cli' => 'sometimes|required|string|max:12',
                'telefono_cli' => 'sometimes|required|integer',
                'correo_cli' => 'sometimes|required|string|email|max:255',
                'departamento_cli' => 'sometimes|required|string|max:255',
                'distrito_cli' => 'sometimes|required|string|max:255',
                'direccion_cli' => 'sometimes|required|string|max:255',
                'referencia_cli' => 'nullable|string|max:255',
                'mensaje_cli' => 'nullable|string|max:255',
                'producto' => 'sometimes|required|string|max:255',
                'metodo_pago' => 'required|string|max:255',
                'banca_billetera' => 'required|string|max:255',
                'estado_pedido' => 'sometimes|required|string|max:255'
            ]);

            $pedido = Pedido::findOrFail($id);
            $pedido->update($request->all());

            return response()->json($pedido, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al actualizar el pedido', $e], 400);
        }
    }

    // Eliminar un pedido
    public function destroy($id)
    {
        try {
            $pedido = Pedido::findOrFail($id);
            $pedido->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al eliminar el pedido'], 400);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function mostrar()
    {   
        try{
            $categorias = Categoria::all();
            return response()->json($categorias);
        }
        catch(Exception $e){
            return response()->json(["ERROR AL MOSTRAR"], 404);
        }
        
    }

    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return response()->json($categoria);
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'label' => 'required|string|max:255|unique:categoria,label',
            ]);
    
            $categoria = Categoria::create($request->all());
    
            return response()->json($categoria, 201);
        }
        catch(Exception $E){
            return response()->json(["Error al Crear"], 400);
        }
    }
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'label' => 'required|string|max:255|unique:categoria,label,' . $id,
            ]);
    
            $categoria = Categoria::findOrFail($id);
            $categoria->update($request->all());
    
            return response()->json($categoria, 200);
        }
        catch(Exception $e){
            return response()->json(["error al actualizar"], 400);
        }
        
    }

    public function destroy($id)
    {
        try{
            $categoria = Categoria::findOrFail($id);
            $categoria->delete();
    
            return response()->json(["resp" => "Categoria Eliminada"], 200);
        }
        catch(Exception $e){
            return response()->json(["error" => "Error al eliminar, intentelo de nuevo", $e], 400);
        }
       
    }
}

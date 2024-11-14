<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultas;
use Illuminate\Http\Request;

class ConsultasController extends Controller
{
    public function getAll()
    {
        try {
            $consultas = Consultas::all();

            if ($consultas->isEmpty()) {
                return response()->json(['error' => true, 'message' => 'No se encontraron registros'], 404);
            }

            return response()->json([
                'error' => false,
                'data' => $consultas
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Ocurrió un error al obtener la información'
            ], 500);
        }
    }

    public function getOne($id)
    {
        try {
            $consulta = Consultas::find($id);

            if (!$consulta) {
                return response()->json(['error' => true, 'message' => 'Registro no encontrado'], 404);
            }

            return response()->json([
                'error' => false,
                'data' => $consulta
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Ocurrió un error al obtener la información'
            ], 500);
        }
    }

    public function insert(Request $request)
    {
        try {
            $consulta = $request->all();
            $consulta = Consultas::create($consulta);

            return response()->json([
                "error" => false,
                "message" => "Éxito en la creación",
                "data" => $consulta
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => "Ocurrió un error al crear el registro"
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $consulta = Consultas::find($id);

            if (!$consulta) {
                return response()->json([
                    'error' => true,
                    'message' => 'Registro no encontrado'
                ], 404);
            }

            $consulta->update($request->all());

            return response()->json([
                "error" => false,
                "message" => "Registro actualizado exitosamente",
                "data" => $consulta
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => "Ocurrió un error al actualizar el registro"
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $consulta = Consultas::find($id);

            if (!$consulta) {
                return response()->json([
                    'error' => true,
                    'message' => 'Registro no encontrado'
                ], 404);
            }

            $consulta->delete();

            return response()->json([
                "error" => false,
                "message" => "Registro eliminado exitosamente"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "error" => true,
                "message" => "Ocurrió un error al eliminar el registro"
            ], 500);
        }
    }
}

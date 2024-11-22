<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultas;
use Illuminate\Http\Request;

class ConsultasController extends Controller
{

    public function getAllRecetas(Request $request)
    {
        try {
            $pageSize = $request->query('pageSize', 10);
            $id = $request->query('id', '');

            if (empty($id)) {
                return response()->json([
                    'error' => true,
                    'message' => 'El ID de la cita es obligatorio.'
                ], 400);
            }

            $query = Consultas::where('idCita', $id)->orderBy('fecha', 'desc');

            $citas = $query->paginate($pageSize);

            if ($citas->isEmpty()) {
                return response()->json(['error' => true, 'message' => 'No se encontraron registros'], 200);
            }

            return response()->json([
                'error' => false,
                'data' => $citas->items(),
                'pagination' => [
                    'total' => $citas->total(),
                    'currentPage' => $citas->currentPage(),
                    'lastPage' => $citas->lastPage(),
                    'perPage' => $citas->perPage()
                ]
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Ocurrió un error al obtener la información'
            ], 200);
        }
    }

    public function getOne($id)
    {
        try {
            $consulta = Consultas::find($id);

            if (!$consulta) {
                return response()->json(['error' => true, 'message' => 'Registro no encontrado'], 200);
            }

            return response()->json([
                'error' => false,
                'data' => $consulta
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Ocurrió un error al obtener la información'
            ], 200);
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
            ], 200);
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
                ], 200);
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
            ], 200);
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
                ], 200);
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
            ], 200);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Citas;

class CitasController extends Controller
{
    public function getAll()
    {
        try {
            $citas = Citas::all();

            if ($citas->isEmpty()) {
                return response()->json(['error' => true, 'message' => 'No se encontraron registros'], 200);
            }

            return response()->json([
                'error' => false,
                'data' => $citas
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
            $cita = Citas::find($id);

            if (!$cita) {
                return response()->json(['error' => true, 'message' => 'Registro no encontrado'], 200);
            }

            return response()->json([
                'error' => false,
                'data' => $cita
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
            $cita = $request->all();
            $cita = Citas::create($cita);

            return response()->json([
                "error" => false,
                "message" => "Éxito en la creación",
                "data" => $cita
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
            $cita = Citas::find($id);

            if (!$cita) {
                return response()->json([
                    'error' => true,
                    'message' => 'Registro no encontrado'
                ], 200);
            }

            $cita->update($request->all());

            return response()->json([
                "error" => false,
                "message" => "Registro actualizado exitosamente",
                "data" => $cita
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
            $cita = Citas::find($id);

            if (!$cita) {
                return response()->json([
                    'error' => true,
                    'message' => 'Registro no encontrado'
                ], 200);
            }

            $cita->delete();

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

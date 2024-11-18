<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pacientes;
use Illuminate\Support\Facades\Hash;

class PacientesController extends Controller
{

    public function login(Request $request)
    {
        try {
            $paciente = Pacientes::where('correo', $request->correo)->first();

            if ($paciente && Hash::check($request->contrasenia, $paciente->contrasenia)) {
                return response()->json([
                    'error' => false,
                    'data' => $paciente->_id
                ], 200);
            }

            return response()->json([
                'error' => true,
                'message' => 'Correo o contraseña incorrectos'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Ocurrió un error al intentar iniciar sesión'
            ], 500);
        }
    }

    public function getAll()
    {
        try {
            $pacientes = Pacientes::all();

            if ($pacientes->isEmpty()) {
                return response()->json(['error' => true, 'message' => 'No se encontraron registros'], 200);
            }

            return response()->json([
                'error' => false,
                'data' => $pacientes
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
            $paciente = Pacientes::find($id);

            if (!$paciente) {
                return response()->json(['error' => true, 'message' => 'Registro no encontrado'], 200);
            }

            return response()->json([
                'error' => false,
                'data' => $paciente
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
            $data = $request->all();
            $data['contrasenia'] = Hash::make($request->contrasenia);

            $paciente = Pacientes::create($data);

            return response()->json([
                "error" => false,
                "message" => "Éxito en la creación",
                "data" => $paciente
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
            $paciente = Pacientes::find($id);

            if (!$paciente) {
                return response()->json([
                    'error' => true,
                    'message' => 'Registro no encontrado'
                ], 200);
            }

            $data = $request->all();

            if ($request->has('contrasenia')) {
                $data['contrasenia'] = Hash::make($request->contrasenia);
            }

            $paciente->update($data);

            return response()->json([
                "error" => false,
                "message" => "Registro actualizado exitosamente",
                "data" => $paciente
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
            $paciente = Pacientes::find($id);

            if (!$paciente) {
                return response()->json([
                    'error' => true,
                    'message' => 'Registro no encontrado'
                ], 200);
            }

            $paciente->delete();

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

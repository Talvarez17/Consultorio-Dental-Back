<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctores;
use Illuminate\Support\Facades\Hash;

class DoctoresController extends Controller
{

    public function login(Request $request)
    {
        try {
            $doctor = Doctores::where('correo', $request->correo)->first();

            if ($doctor && Hash::check($request->contrasenia, $doctor->contrasenia)) {
                return response()->json([
                    'error' => false,
                    'data' => $doctor->_id
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
            ], 200);
        }
    }

    public function getAll()
    {
        try {
            $doctores = Doctores::all();

            if ($doctores->isEmpty()) {
                return response()->json(['error' => true, 'message' => 'No se encontraron registros'], 200);
            }

            return response()->json([
                'error' => false,
                'data' => $doctores
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
            $doctor = Doctores::find($id);

            if (!$doctor) {
                return response()->json(['error' => true, 'message' => 'Registro no encontrado'], 200);
            }

            return response()->json([
                'error' => false,
                'data' => $doctor
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
            $data = $request->all();
            $data['contrasenia'] = Hash::make($request->contrasenia);

            $doctor = Doctores::create($data);

            return response()->json([
                "error" => false,
                "message" => "Éxito en la creación",
                "data" => $doctor
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
            $doctor = Doctores::find($id);

            if (!$doctor) {
                return response()->json([
                    'error' => true,
                    'message' => 'Registro no encontrado'
                ], 200);
            }

            $data = $request->all();

            if ($request->has('contrasenia')) {
                $data['contrasenia'] = Hash::make($request->contrasenia);
            }

            $doctor->update($data);

            return response()->json([
                "error" => false,
                "message" => "Registro actualizado exitosamente",
                "data" => $doctor
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
            $doctor = Doctores::find($id);

            if (!$doctor) {
                return response()->json([
                    'error' => true,
                    'message' => 'Registro no encontrado'
                ], 200);
            }

            $doctor->delete();

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

<?php

namespace App\Http\Controllers;

use App\Models\ModelMotor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ModelMotorController extends Controller
{
    
    public function index(): JsonResponse
    {
        $modelmotor = ModelMotor::with(['variant'])->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $modelmotor
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id_model' => 'required|integer|unique:model_motor,id_model', 
            'kategori' => 'required|string|max:50',
            'nama_model' => 'required|string|max:100',
            'is_import' => 'required|boolean',
            'bike_code' => 'required|string|max:20'
        ]);

        $modelmotor = ModelMotor::create($validated);

        return response()->json([
        'success' => true,
        'message' => 'Model motor created successfully',
        'data' => $modelmotor
        ], 201);
    }

    public function show($id): JsonResponse
    {
        $modelMotor = ModelMotor::where('id_model', $id)->with(['variant'])->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $modelMotor
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $modelMotor = ModelMotor::where('id_model',$id)->firstOrFail();

        $validated = $request->validate([
            'id_model' => 'sometimes|integer|unique:model_motor,id_model,' . $id . ',id_model',
            'kategori' => 'sometimes|string|max:50',
            'nama_model' => 'sometimes|string|max:100',
            'is_import' => 'sometimes|boolean',
            'bike_code' => 'sometimes|string|max:20'
        ]);

        $modelMotor->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Model motor updated successfully',
            'data' => $modelMotor
        ]);
    }
    public function destroy($id): JsonResponse
    {
        $modelMotor = ModelMotor::where('id_model',$id)->firstOrFail();
        $modelMotor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Model motor deleted successfully'
        ]);
    }
}





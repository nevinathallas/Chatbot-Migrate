<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MotorController extends Controller
{
    public function index(): JsonResponse
    {
        $motors = Motor::with(['Variant', 'modelMotor', 'brosur', 'harga', 'specs', 'communities', 'promos'])->paginate(10);
        
        return response()->json([
            'success' => true,
            'data' => $motors
        ]);
    }
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id_motorcycle' => 'required|integer|unique:motor,id_motorcycle',
            'model_kode' => 'required|string|max:50',
            'var' => 'required|integer|exists:variant,var',
            'warna' => 'required|string|max:50',
            'status_vr' => 'required|in:ACTIVE,INACTIVE'
        ]);

        $motor = Motor::create($validated);
        $motor->load(['modelMotor', 'Variant']);

        return response()->json([
            'success' => true,
            'message' => 'Motor created successfully',
            'data' => $motor
        ], 201);
    }
    public function show($id): JsonResponse
    {
        $motor = Motor::where('id_motorcycle', $id)->with(['Variant', 'modelMotor', 'brosur', 'harga', 'specs', 'communities', 'promos'])->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $motor
        ]);
    }
    public function update(Request $request, $id): JsonResponse
    {
        $motor = Motor::where('id_motorcycle', $id)->firstOrFail();
        
        $validated = $request->validate([
            'id_motorcycle' => 'sometimes|integer|unique:motor,id_motorcycle,' . $id . ',id_motorcycle',
            'model_kode' => 'sometimes|string|max:50',
            'var' => 'sometimes|integer|exists:variant,var',
            'warna' => 'sometimes|string|max:50',
            'status_vr' => 'sometimes|in:ACTIVE,INACTIVE'
        ]);

        $motor->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Motor updated successfully',
            'data' => $motor
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $motor = Motor::where('id_motorcycle', $id)->firstOrFail();
        $motor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Motor deleted successfully'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VariantController extends Controller
{
    public function index(): JsonResponse
    {
        $variants = Variant::with(['ModelMotor', 'Service', 'Motor'])->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Variants retrieved successfully',
            'data' => $variants
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'var' => 'required|integer|unique:variant,var',
            'color' => 'required|string|max:100',
            'Status_type' => 'required|in:ACTIVE,INACTIVE',
            'status_id' => 'required|integer|exists:service,id_servis',
            'id_model' => 'required|integer|exists:model_motor,id_model'
        ]);

        $variant = Variant::create($validated);
        $variant->load(['ModelMotor', 'Service']);

        return response()->json([
            'success' => true,
            'message' => 'Variant created successfully',
            'data' => $variant
        ], 201);
    }

    public function show($var): JsonResponse
    {
        $variant = Variant::where('var', $var)
            ->with([
                'ModelMotor', 
                'Service', 
                'Motor' => function($query) {
                    $query->with(['brosur', 'harga', 'specs', 'communities', 'promos']);
                }
            ])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'message' => 'Variant retrieved successfully',
            'data' => $variant
        ]);
    }

    public function update(Request $request, $var): JsonResponse
    {
        $variant = Variant::where('var', $var)->firstOrFail();

        $validated = $request->validate([
            'var' => 'sometimes|integer|unique:variant,var,' . $variant->id . ',id',
            'color' => 'sometimes|string|max:100',
            'Status_type' => 'sometimes|in:ACTIVE,INACTIVE',
            'status_id' => 'sometimes|integer|exists:service,id_servis',
            'id_model' => 'sometimes|integer|exists:model_motor,id_model'
        ]);

        $variant->update($validated);
        $variant->load(['ModelMotor', 'Service']);

        return response()->json([
            'success' => true,
            'message' => 'Variant updated successfully',
            'data' => $variant
        ]);
    }

    public function destroy($var): JsonResponse
    {
        $variant = Variant::where('var', $var)->firstOrFail();
        $variantName = $variant->color;
        $variant->delete();

        return response()->json([
            'success' => true,
            'message' => "Variant '{$variantName}' deleted successfully"
        ]);
    }

    // Method tambahan untuk mendapatkan semua motor dari variant tertentu
    public function getMotors($var): JsonResponse
    {
        $variant = Variant::where('var', $var)->firstOrFail();
        
        $motors = $variant->Motor()
            ->with(['modelMotor', 'brosur', 'harga', 'specs', 'communities', 'promos'])
            ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Variant motors retrieved successfully',
            'data' => $motors
        ]);
    }

    // Method untuk mendapatkan variant berdasarkan model motor
    public function getByModel($id_model): JsonResponse
    {
        $variants = Variant::where('id_model', $id_model)
            ->with(['ModelMotor', 'Service'])
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Model variants retrieved successfully',
            'data' => $variants
        ]);
    }

    // Method untuk mendapatkan variant yang aktif saja
    public function getActive(): JsonResponse
    {
        $variants = Variant::where('Status_type', 'ACTIVE')
            ->with(['ModelMotor', 'Service', 'Motor'])
            ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Active variants retrieved successfully',
            'data' => $variants
        ]);
    }
}
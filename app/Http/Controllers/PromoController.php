<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PromoController extends Controller
{
    public function index(): JsonResponse
    {
        $promos = Promo::with(['Motor.modelMotor', 'Motor.Variant'])->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Promos retrieved successfully',
            'data' => $promos
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'kategori' => 'required|string|max:20',
            'nama_promo' => 'required|string|max:100',
            'desk' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'motor_ids' => 'sometimes|array',
            'motor_ids.*' => 'integer|exists:motor,id_motorcycle'
        ]);

        $motorIds = $validated['motor_ids'] ?? [];
        unset($validated['motor_ids']);

        $promo = Promo::create($validated);

        if (!empty($motorIds)) {
            $promo->Motor()->attach($motorIds);
        }

        $promo->load(['Motor.modelMotor', 'Motor.Variant']);

        return response()->json([
            'success' => true,
            'message' => 'Promo created successfully',
            'data' => $promo
        ], 201);
    }

    public function show($id): JsonResponse
    {
        $promo = Promo::where('id', $id)
            ->with([
                'Motor.modelMotor',
                'Motor.Variant',
                'Motor.harga'
            ])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'message' => 'Promo retrieved successfully',
            'data' => $promo
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $promo = Promo::findOrFail($id);

        $validated = $request->validate([
            'kategori' => 'sometimes|string|max:20',
            'nama_promo' => 'sometimes|string|max:100',
            'desk' => 'sometimes|string',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after:start_date',
            'motor_ids' => 'sometimes|array',
            'motor_ids.*' => 'integer|exists:motor,id_motorcycle'
        ]);

        if (isset($validated['motor_ids'])) {
            $motorIds = $validated['motor_ids'];
            unset($validated['motor_ids']);
            $promo->Motor()->sync($motorIds);
        }

        $promo->update($validated);
        $promo->load(['Motor.modelMotor', 'Motor.Variant']);

        return response()->json([
            'success' => true,
            'message' => 'Promo updated successfully',
            'data' => $promo
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $promo = Promo::findOrFail($id);
        $promoName = $promo->nama_promo;
        
        $promo->Motor()->detach();
        $promo->delete();

        return response()->json([
            'success' => true,
            'message' => "Promo '{$promoName}' deleted successfully"
        ]);
    }

    // Attach motors to promo
    public function attachMotors(Request $request, $id): JsonResponse
    {
        $promo = Promo::findOrFail($id);

        $validated = $request->validate([
            'motor_ids' => 'required|array',
            'motor_ids.*' => 'integer|exists:motor,id_motorcycle'
        ]);

        $promo->Motor()->attach($validated['motor_ids']);
        $promo->load(['Motor.modelMotor']);

        return response()->json([
            'success' => true,
            'message' => 'Motors attached to promo successfully',
            'data' => $promo
        ]);
    }

    // Detach motors from promo
    public function detachMotors(Request $request, $id): JsonResponse
    {
        $promo = Promo::findOrFail($id);

        $validated = $request->validate([
            'motor_ids' => 'required|array',
            'motor_ids.*' => 'integer|exists:motor,id_motorcycle'
        ]);

        $promo->Motor()->detach($validated['motor_ids']);
        $promo->load(['Motor.modelMotor']);

        return response()->json([
            'success' => true,
            'message' => 'Motors detached from promo successfully',
            'data' => $promo
        ]);
    }

    // Get all motors for a specific promo
    public function getMotors($id): JsonResponse
    {
        $promo = Promo::findOrFail($id);
        $motors = $promo->Motor()->with(['modelMotor', 'Variant', 'harga'])->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Promo motors retrieved successfully',
            'data' => $motors
        ]);
    }

    // Get active promos
    public function activePromos(): JsonResponse
    {
        $activePromos = Promo::where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->with(['Motor.modelMotor', 'Motor.Variant'])
            ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Active promos retrieved successfully',
            'data' => $activePromos
        ]);
    }
}
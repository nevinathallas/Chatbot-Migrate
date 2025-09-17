<?php

namespace App\Http\Controllers;

use App\Models\Brosur;
use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BrosurController extends Controller
{
    public function index(): JsonResponse
    {
        $brosurs = Brosur::with(['Motor.modelMotor', 'Motor.Variant'])->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Brosurs retrieved successfully',
            'data' => $brosurs
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id_brosur' => 'required|integer|unique:brosur,id_brosur',
            'id_motorcycle' => 'required|integer|exists:motor,id_motorcycle',
            'isi' => 'required|string'
        ]);

        $brosur = Brosur::create($validated);
        $brosur->load(['Motor.modelMotor', 'Motor.Variant']);

        return response()->json([
            'success' => true,
            'message' => 'Brosur created successfully',
            'data' => $brosur
        ], 201);
    }

    public function show($id): JsonResponse
    {
        $brosur = Brosur::where('id_brosur', $id)
            ->with([
                'Motor.modelMotor',
                'Motor.Variant',
                'Motor.harga',
                'Motor.specs'
            ])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'message' => 'Brosur retrieved successfully',
            'data' => $brosur
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $brosur = Brosur::where('id_brosur', $id)->firstOrFail();

        $validated = $request->validate([
            'id_brosur' => 'sometimes|integer|unique:brosur,id_brosur,' . $id . ',id_brosur',
            'id_motorcycle' => 'sometimes|integer|exists:motor,id_motorcycle',
            'isi' => 'sometimes|string'
        ]);

        $brosur->update($validated);
        $brosur->load(['Motor.modelMotor', 'Motor.Variant']);

        return response()->json([
            'success' => true,
            'message' => 'Brosur updated successfully',
            'data' => $brosur
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $brosur = Brosur::where('id_brosur', $id)->firstOrFail();
        $motorName = $brosur->Motor->modelMotor->nama_model ?? 'Unknown';
        $brosur->delete();

        return response()->json([
            'success' => true,
            'message' => "Brosur for '{$motorName}' deleted successfully"
        ]);
    }

    // Method untuk mendapatkan semua brosur dari motor tertentu
    public function getByMotor($id_motorcycle): JsonResponse
    {
        $motor = Motor::where('id_motorcycle', $id_motorcycle)->firstOrFail();
        
        $brosurs = Brosur::where('id_motorcycle', $id_motorcycle)
            ->with(['Motor.modelMotor', 'Motor.Variant'])
            ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Motor brosurs retrieved successfully',
            'data' => $brosurs,
            'motor_info' => [
                'id_motorcycle' => $motor->id_motorcycle,
                'model' => $motor->modelMotor->nama_model ?? null,
                'variant' => $motor->Variant->color ?? null
            ]
        ]);
    }

    // Method untuk mendapatkan brosur terbaru
    public function getLatest(): JsonResponse
    {
        $brosurs = Brosur::with(['Motor.modelMotor', 'Motor.Variant'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Latest brosurs retrieved successfully',
            'data' => $brosurs
        ]);
    }

    // Method untuk search brosur berdasarkan konten
    public function search(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'keyword' => 'required|string|min:3'
        ]);

        $brosurs = Brosur::where('isi', 'LIKE', '%' . $validated['keyword'] . '%')
            ->with(['Motor.modelMotor', 'Motor.Variant'])
            ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Brosur search results',
            'data' => $brosurs,
            'keyword' => $validated['keyword']
        ]);
    }
}
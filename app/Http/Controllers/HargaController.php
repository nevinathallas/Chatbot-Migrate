<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HargaController extends Controller
{
    public function index(): JsonResponse
    {
        $harga = Harga::with(['motor'])->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $harga
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id_harga' => 'required|integer|unique:harga,id_harga',
            'id_motorcycle' => 'required|integer|exists:motor,id_motorcycle',
            'harga' => 'required|numeric|min:0'
        ]);

        $harga = Harga::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Harga created successfully',
            'data' => $harga
        ], 201);
    }

    public function show($id): JsonResponse
    {
        $harga = Harga::where('id_harga', $id)->with(['motor'])->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $harga
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $harga = Harga::where('id_harga', $id)->firstOrFail();

        $validated = $request->validate([
            'id_harga' => 'sometimes|integer|unique:harga,id_harga,' . $id . ',id_harga',
            'id_motorcycle' => 'sometimes|integer|exists:motor,id_motorcycle',
            'harga' => 'sometimes|numeric|min:0'
        ]);

        $harga->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Harga updated successfully',
            'data' => $harga
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $harga = Harga::where('id_harga', $id)->firstOrFail();
        $harga->delete();

        return response()->json([
            'success' => true,
            'message' => 'Harga deleted successfully'
        ]);
    }
}
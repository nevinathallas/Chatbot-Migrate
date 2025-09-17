<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function index(): JsonResponse
    {
        $service = Service::with(['MainDealer', 'Variant', 'Stats'])->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $service
        ]);
    }

    
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id_servis' => 'required|integer|unique:service,id_servis',
            'desc' => 'required|string',
            'syarat' => 'required|string',
            'masa_berlaku' => 'required|date',
            'notes' => 'required|string',
            'id_main' => 'required|string|exists:main_dealer,id_main'
            
        ]);

        $service = Service::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Service created successfully',
            'data' => $service
        ], 201);
    }

    public function show($id): JsonResponse
    {
        $service = Service::where('id_servis', $id)->with(['MainDealer', 'Variant', 'Stats'])->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $service
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $service = Service::where('id_servis', $id)->firstOrFail();

        $validated = $request->validate([
            'id_servis' => 'sometimes|integer|unique:service,id_servis,' . $id . ',id_servis',
            'desc' => 'sometimes|string',
            'syarat' => 'sometimes|string',
            'masa_berlaku' => 'sometimes|date',
            'notes' => 'sometimes|string',
            'id_main' => 'sometimes|string|exists:main_dealer,id_main'
            
        ]);

        $service->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Service updated successfully',
            'data' => $service
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $service = Service::where('id_servis', $id)->firstOrFail();
        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully'
        ]);
    }
}


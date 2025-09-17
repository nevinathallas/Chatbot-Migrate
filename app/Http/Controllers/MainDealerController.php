<?php

namespace App\Http\Controllers;

use App\Models\MainDealer;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MainDealerController extends Controller
{
    public function index(): JsonResponse
    {
        $mainDealers = MainDealer::with(['Cabang', 'Service'])->paginate(10);
        
        return response()->json([
            'success' => true,
            'data' => $mainDealers
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id_main' => 'required|string|unique:main_dealer,id_main', 
            'nama_main' => 'required|string|max:255',
            'alamat' => 'required|string',
            'notelp' => 'required|string', 
            'email' => 'required|email|unique:main_dealer,email'
        ]);
    

        $mainDealer = MainDealer::create($validated);

        return response()->json([
        'success' => true,
        'message' => 'Main dealer created successfully',
        'data' => $mainDealer
        ], 201);
    }
    public function show($id): JsonResponse
    {
        $mainDealer = MainDealer::where('id_main', $id)->with(['Cabang', 'Service'])->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $mainDealer
        ]);
    }
    public function update(Request $request, $id): JsonResponse
    {
        $mainDealer = MainDealer::where('id_main', $id)->firstOrFail();
        
        $validated = $request->validate([
            'id_main' => 'sometimes|string|unique:main_dealer,id_main,' . $id . ',id_main',
            'nama_main' => 'sometimes|string|max:255',
            'alamat' => 'sometimes|string',
            'notelp' => 'sometimes|string',
            'email' => 'sometimes|email|unique:main_dealer,email,' . $id . ',id_main'
        ]);

        $mainDealer->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Main dealer updated successfully',
            'data' => $mainDealer
        ]);
    }
    public function destroy($id): JsonResponse
    {
        $mainDealer = MainDealer::where('id_main', $id)->firstOrFail();
        $mainDealer->delete();

        return response()->json([
            'success' => true,
            'message' => 'Main dealer deleted successfully'
        ]);
    }

    // Get all cabangs for a specific main dealer
    public function getCabangs($id): JsonResponse
    {
        $mainDealer = MainDealer::where('id_main', $id)->firstOrFail();
        $cabangs = $mainDealer->Cabang()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $cabangs
        ]);
    }

    // Create cabang for a specific main dealer
    public function storeCabang(Request $request, $id): JsonResponse
    {
        $mainDealer = MainDealer::where('id_main', $id)->firstOrFail();

        $validated = $request->validate([
            'id_dealer' => 'required|string|unique:cabang,id_dealer',
            'nama_dealer' => 'required|string|max:255',
            'jenis_dealer' => 'required|in:DEALER,AHASS',
            'notelp_dealer' => 'required|string|max:100',
            'email_dealer' => 'required|email'
        ]);

        $validated['id_main'] = $id;
        $cabang = Cabang::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cabang created successfully',
            'data' => $cabang
        ], 201);
    }

    // Show specific cabang
    public function showCabang($mainId, $cabangId): JsonResponse
    {
        $cabang = Cabang::where('id_dealer', $cabangId)
                       ->where('id_main', $mainId)
                       ->with(['MainDealer'])
                       ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $cabang
        ]);
    }

    // Update cabang
    public function updateCabang(Request $request, $mainId, $cabangId): JsonResponse
    {
        $cabang = Cabang::where('id_dealer', $cabangId)
                       ->where('id_main', $mainId)
                       ->firstOrFail();

        $validated = $request->validate([
            'nama_dealer' => 'sometimes|string|max:255',
            'jenis_dealer' => 'sometimes|in:DEALER,AHASS',
            'notelp_dealer' => 'sometimes|string|max:100',
            'email_dealer' => 'sometimes|email'
        ]);

        $cabang->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cabang updated successfully',
            'data' => $cabang
        ]);
    }

    // Delete cabang
    public function destroyCabang($mainId, $cabangId): JsonResponse
    {
        $cabang = Cabang::where('id_dealer', $cabangId)
                       ->where('id_main', $mainId)
                       ->firstOrFail();
        $cabang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cabang deleted successfully'
        ]);
    }
}










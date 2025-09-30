<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreChallengeRequest;
use App\Http\Requests\UpdateChallengeRequest;



class AdminChallengeController extends Controller
{
    
    public function index(Request $request)
    {
    $query = Challenge::with(['creator', 'participations', 'participations.user']);

    // Filtre par statut
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filtre par recherche
    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('title', 'like', "%{$request->search}%")
              ->orWhere('description', 'like', "%{$request->search}%");
        });
    }

    // Filtre par créateur (optionnel)
    if ($request->filled('creator_id')) {
        $query->where('created_by', $request->creator_id);
    }

    // Pagination standard Laravel
    $challenges = $query->latest()->paginate(10)->withQueryString();

    return view('admin.challenges.index', compact('challenges'));
}

    public function create()
    {
        return view('admin.challenges.create');
    }

    public function store(StoreChallengeRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();   
        $data['status'] = 'pending';        

        Challenge::create($data);

        return redirect()->route('admin.challenges.index')
        ->with('success', 'Défi créé avec succès.');
    }

    public function edit($id)
    {
        $challenge = Challenge::findOrFail($id);
        return view('admin.challenges.edit', compact('challenge'));
    }

    public function update(UpdateChallengeRequest $request, $id)
    {

         $challenge = Challenge::findOrFail($id);
         

        $challenge->update($request->validated());

        return redirect()->route('admin.challenges.index')
                     ->with('success', 'Défi mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $challenge = Challenge::findOrFail($id);
    
    // Check if the challenge has any participations
    if ($challenge->participations()->exists()) {
        return redirect()->route('admin.challenges.index')
                         ->with('error', 'Impossible de supprimer un défi avec des participations actives.');
    }
    
    // If no participations, proceed with deletion
    $challenge->delete();
    
    return redirect()->route('admin.challenges.index')
                     ->with('success', 'Défi supprimé avec succès.');
    }

    // Actions simples d'approbation/rejet
    public function approve($id)
    {
        $challenge = Challenge::findOrFail($id);
        $challenge->update(['status' => 'approved', 'rejection_reason' => null]);

        return redirect()->back()->with('success', 'Défi approuvé');
    }

    public function reject(Request $request, $id)
    {
        $challenge = Challenge::findOrFail($id);

        $request->validate([
            'rejection_reason' => 'nullable|string|max:500'
        ]);

        $challenge->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason
        ]);

    return redirect()->route('admin.challenges.index')->with('success', 'Challenge rejected successfully.');
    }


    public function showDetails($id)
{
    $challenge = Challenge::with(['creator','participations.user'])->findOrFail($id);
    return view('admin.challenges._details', compact('challenge')); // vue partielle
}

    
}

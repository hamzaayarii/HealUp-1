<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;

class ChallengeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('challenges.index', [
        'challenges' => Challenge::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('challenges.create');  
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
 * Store a newly created resource in storage.
 */
public function store(Request $request): RedirectResponse
{
    // Define validation rules
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string', 
        'objectif' => 'required|integer|min:1', 
        'duration' => 'required|integer|min:1|max:365', 
        'reward' => 'required|string|max:255', 
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'is_active' => 'boolean',
    ], [
        // Customize error messages for better user experience
        'title.required' => 'Le titre du défi est obligatoire.',
        'objectif.required' => 'Veuillez définir un objectif quotidien.',
        'start_date.after_or_equal' => 'La date de début ne peut pas être dans le passé.',
        'end_date.after_or_equal' => 'La date de début ne peut pas être dans le passé.'
    ]);

    // If validation passes, create the challenge
    Challenge::create($validated);

    return redirect()->route('challenges.index')->with('success', 'Défi créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}

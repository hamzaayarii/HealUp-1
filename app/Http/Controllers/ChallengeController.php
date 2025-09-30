<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Http\Requests\StoreChallengeRequest;
use Illuminate\Http\RedirectResponse;


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
    public function store(StoreChallengeRequest $request): RedirectResponse
    {
    
        $validated = $request->validated();

        $validated['created_by'] = auth()->id();
        $validated['status'] = auth()->user()->isAdmin() ? 'approved' : 'pending';
    
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

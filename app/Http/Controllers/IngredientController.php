<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::orderBy('nom')->paginate(15);
        return view('ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        return view('ingredients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'categorie' => 'required|string|max:100',
            'calories_pour_100g' => 'required|numeric',
            'proteines_pour_100g' => 'required|numeric',
            'glucides_pour_100g' => 'required|numeric',
            'lipides_pour_100g' => 'required|numeric',
        ]);

        Ingredient::create($validated);

        return redirect()->route('ingredients.index')->with('success', 'Ingredient created successfully!');
    }

    public function show(Ingredient $ingredient)
    {
        return view('ingredients.show', compact('ingredient'));
    }

    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'categorie' => 'required|string|max:100',
            'calories_pour_100g' => 'required|numeric',
            'proteines_pour_100g' => 'required|numeric',
            'glucides_pour_100g' => 'required|numeric',
            'lipides_pour_100g' => 'required|numeric',
        ]);

        $ingredient->update($validated);

        return redirect()->route('ingredients.show', $ingredient)->with('success', 'Ingredient updated successfully!');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->route('ingredients.index')->with('success', 'Ingredient deleted successfully!');
    }
}

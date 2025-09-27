<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repas;
use App\Models\Ingredient;
use App\Models\RepasIngredient;
use Illuminate\Support\Facades\Auth;

class RepasController extends Controller
{
    public function index()
    {
        $repas = Repas::where('user_id', Auth::id())
                      ->orderBy('date_consommation', 'desc')
                      ->paginate(10);

        // CHANGÉ: nutrition.repas.index → repas.index
        return view('repas.index', compact('repas'));
    }

    public function create()
    {
        $ingredients = Ingredient::orderBy('nom')->get();
        
        // CHANGÉ: nutrition.repas.create → repas.create
        return view('repas.create', compact('ingredients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type_repas' => 'required|in:petit-dejeuner,dejeuner,diner,collation',
            'date_consommation' => 'required|date',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.id' => 'required|integer|exists:ingredients,id',
            'ingredients.*.quantite' => 'required|numeric|min:1|max:2000',
        ]);

        $repas = new Repas();
        $repas->nom = $validated['nom'];
        $repas->type_repas = $validated['type_repas'];
        $repas->date_consommation = $validated['date_consommation'];
        $repas->user_id = Auth::id();

        // Calculs nutritionnels...
        $caloriesTotal = 0;
        $proteinesTotal = 0;
        $glucidesTotal = 0;
        $lipidesTotal = 0;

        foreach ($validated['ingredients'] as $ingData) {
            $ingredient = Ingredient::find($ingData['id']);
            $facteur = $ingData['quantite'] / 100;

            $caloriesTotal += $ingredient->calories_pour_100g * $facteur;
            $proteinesTotal += $ingredient->proteines_pour_100g * $facteur;
            $glucidesTotal += $ingredient->glucides_pour_100g * $facteur;
            $lipidesTotal += $ingredient->lipides_pour_100g * $facteur;
        }

        $repas->calories_total = $caloriesTotal;
        $repas->proteines_total = $proteinesTotal;
        $repas->glucides_total = $glucidesTotal;
        $repas->lipides_total = $lipidesTotal;
        
        $repas->save();

        // Associer les ingrédients
        foreach ($validated['ingredients'] as $ingData) {
            $ingredient = Ingredient::find($ingData['id']);
            $facteur = $ingData['quantite'] / 100;
            $calories = $ingredient->calories_pour_100g * $facteur;

            RepasIngredient::create([
                'repas_id' => $repas->id,
                'ingredient_id' => $ingData['id'],
                'quantite' => $ingData['quantite'],
                'calories_calculees' => $calories
            ]);
        }

        return redirect()->route('repas.index')->with('success', 'Repas créé avec succès!');
    }

    public function show(Repas $repas)
    {
        // CHANGÉ: nutrition.repas.show → repas.show
        return view('repas.show', compact('repas'));
    }

    public function edit(Repas $repas)
    {
        $ingredients = Ingredient::orderBy('nom')->get();
        
        // CHANGÉ: nutrition.repas.edit → repas.edit  
        return view('repas.edit', compact('repas', 'ingredients'));
    }

    public function update(Request $request, Repas $repas)
    {
        // Logique de mise à jour similaire à store()...
        return redirect()->route('repas.index')->with('success', 'Repas mis à jour avec succès!');
    }

    public function destroy(Repas $repas)
    {
        $repas->delete();
        return redirect()->route('repas.index')->with('success', 'Repas supprimé avec succès!');
    }
}

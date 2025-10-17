<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Services\AIRepasService;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index(Request $request)
    {
        $query = Ingredient::query();

        // 🔍 Recherche par nom
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nom', 'like', "%{$search}%");
        }

        // 🏷️ Filtre par catégorie
        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        // 🔥 Filtre par calories (pour 100g)
        if ($request->filled('min_calories')) {
            $query->where('calories_pour_100g', '>=', $request->min_calories);
        }
        if ($request->filled('max_calories')) {
            $query->where('calories_pour_100g', '<=', $request->max_calories);
        }

        // 💪 Filtre par protéines
        if ($request->filled('min_proteines')) {
            $query->where('proteines_pour_100g', '>=', $request->min_proteines);
        }

        // 🥖 Filtre par glucides
        if ($request->filled('max_glucides')) {
            $query->where('glucides_pour_100g', '<=', $request->max_glucides);
        }

        // 🧈 Filtre par lipides
        if ($request->filled('max_lipides')) {
            $query->where('lipides_pour_100g', '<=', $request->max_lipides);
        }

        // 📊 Tri dynamique
        $sortField = $request->get('sort', 'nom');
        $sortDirection = $request->get('direction', 'asc');
        
        $allowedSorts = ['nom', 'categorie', 'calories_pour_100g', 'proteines_pour_100g', 'glucides_pour_100g', 'lipides_pour_100g', 'fibres_pour_100g'];
        if (in_array($sortField, $allowedSorts)) {
            $query->orderBy($sortField, $sortDirection);
        }

        $ingredients = $query->paginate(15)->withQueryString();
        
        // Récupérer les catégories distinctes pour le filtre
        $categories = Ingredient::distinct()->pluck('categorie')->filter()->sort();

        return view('ingredients.index', compact('ingredients', 'categories'));
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

    /**
     * 🔄 Suggérer des alternatives à un ingrédient
     */
    public function alternatives($id, Request $request, AIRepasService $aiService)
    {
        $ingredient = Ingredient::findOrFail($id);
        
        $criteria = [
            'calories_similar' => $request->boolean('calories_similar', true),
            'proteines_similar' => $request->boolean('proteines_similar', false)
        ];

        $result = $aiService->suggestAlternativeIngredients($ingredient, $criteria);

        return response()->json([
            'success' => true,
            'ingredient' => $ingredient,
            'alternatives' => $result['alternatives'],
            'ai_analysis' => $result['ai_analysis']
        ]);
    }

    /**
     * 📊 Obtenir les statistiques d'un ingrédient
     */
    public function stats($id)
    {
        $ingredient = Ingredient::with('repasIngredients.repas')->findOrFail($id);
        
        $utilisations = $ingredient->repasIngredients;
        $totalUtilisations = $utilisations->count();
        $quantiteMoyenne = $utilisations->avg('quantite');
        $caloriesMoyennes = $utilisations->avg('calories_calculees');
        
        $dernierUtilisation = $utilisations->sortByDesc('created_at')->first();

        return response()->json([
            'success' => true,
            'stats' => [
                'total_utilisations' => $totalUtilisations,
                'quantite_moyenne' => round($quantiteMoyenne, 1),
                'calories_moyennes' => round($caloriesMoyennes, 1),
                'dernier_utilisation' => $dernierUtilisation ? $dernierUtilisation->created_at->format('Y-m-d') : null
            ]
        ]);
    }
}

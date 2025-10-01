<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\RepasIngredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class IngredientController extends Controller
{
    /**
     * Display a listing of ingredients with statistics
     */
    public function index(Request $request)
    {
        $query = Ingredient::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'LIKE', "%{$search}%")
                    ->orWhere('categorie', 'LIKE', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('categorie') && $request->categorie) {
            $query->where('categorie', $request->categorie);
        }

        // Sort
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortBy, $sortDirection);

        $ingredients = $query->withCount('repasIngredients')->paginate(15);

        // Statistics
        $stats = [
            'total' => Ingredient::count(),
            'categories' => Ingredient::distinct('categorie')->count('categorie'),
            'most_used' => Ingredient::withCount('repasIngredients')
                ->orderBy('repas_ingredients_count', 'desc')
                ->take(5)
                ->get(),
            'recent' => Ingredient::orderBy('created_at', 'desc')->take(5)->get(),
            'by_category' => Ingredient::selectRaw('categorie, COUNT(*) as count')
                ->groupBy('categorie')
                ->orderBy('count', 'desc')
                ->get(),
        ];

        // Get all categories for filter
        $categories = Ingredient::distinct('categorie')
            ->orderBy('categorie')
            ->pluck('categorie');

        return view('admin.ingredients.index', compact('ingredients', 'stats', 'categories'));
    }

    /**
     * Show the form for creating a new ingredient
     */
    public function create()
    {
        return view('admin.ingredients.create');
    }

    /**
     * Store a newly created ingredient
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:ingredients,nom',
            'categorie' => 'required|string|max:100',
            'calories_pour_100g' => 'required|numeric|min:0|max:9999',
            'proteines_pour_100g' => 'required|numeric|min:0|max:100',
            'glucides_pour_100g' => 'required|numeric|min:0|max:100',
            'lipides_pour_100g' => 'required|numeric|min:0|max:100',
            'fibres_pour_100g' => 'nullable|numeric|min:0|max:100',
            'allergenes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle allergenes as array
        if (isset($validated['allergenes'])) {
            $validated['allergenes'] = array_map('trim', explode(',', $validated['allergenes']));
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('ingredients', 'public');
        }

        Ingredient::create($validated);

        return redirect()->route('admin.nutrition.ingredients.index')
            ->with('success', 'Ingredient created successfully!');
    }

    /**
     * Display the specified ingredient with details
     */
    public function show(Ingredient $ingredient)
    {
        $ingredient->loadCount('repasIngredients');
        
        // Get meals using this ingredient
        $repasUsage = $ingredient->repas()
            ->with('user')
            ->orderBy('date_consommation', 'desc')
            ->take(10)
            ->get();

        // Usage statistics
        $usageStats = [
            'total_usage' => $ingredient->repasIngredients->count(),
            'total_quantity' => RepasIngredient::where('ingredient_id', $ingredient->id)
                ->sum('quantite'),
            'avg_quantity' => RepasIngredient::where('ingredient_id', $ingredient->id)
                ->avg('quantite'),
            'users_count' => $ingredient->repas()->distinct('user_id')->count('user_id'),
        ];

        return view('admin.ingredients.show', compact('ingredient', 'repasUsage', 'usageStats'));
    }

    /**
     * Show the form for editing the specified ingredient
     */
    public function edit(Ingredient $ingredient)
    {
        return view('admin.ingredients.edit', compact('ingredient'));
    }

    /**
     * Update the specified ingredient
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255', Rule::unique('ingredients')->ignore($ingredient->id)],
            'categorie' => 'required|string|max:100',
            'calories_pour_100g' => 'required|numeric|min:0|max:9999',
            'proteines_pour_100g' => 'required|numeric|min:0|max:100',
            'glucides_pour_100g' => 'required|numeric|min:0|max:100',
            'lipides_pour_100g' => 'required|numeric|min:0|max:100',
            'fibres_pour_100g' => 'nullable|numeric|min:0|max:100',
            'allergenes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle allergenes as array
        if (isset($validated['allergenes'])) {
            $validated['allergenes'] = array_map('trim', explode(',', $validated['allergenes']));
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($ingredient->image) {
                Storage::disk('public')->delete($ingredient->image);
            }
            $validated['image'] = $request->file('image')->store('ingredients', 'public');
        }

        $ingredient->update($validated);

        return redirect()->route('admin.nutrition.ingredients.show', $ingredient)
            ->with('success', 'Ingredient updated successfully!');
    }

    /**
     * Remove the specified ingredient
     */
    public function destroy(Ingredient $ingredient)
    {
        // Check if ingredient is being used in any meals
        $usageCount = $ingredient->repasIngredients()->count();
        
        if ($usageCount > 0) {
            return redirect()->route('admin.nutrition.ingredients.index')
                ->with('error', "Cannot delete ingredient. It is used in {$usageCount} meal(s).");
        }

        // Delete image if exists
        if ($ingredient->image) {
            Storage::disk('public')->delete($ingredient->image);
        }

        $ingredient->delete();

        return redirect()->route('admin.nutrition.ingredients.index')
            ->with('success', 'Ingredient deleted successfully!');
    }

    /**
     * Get statistics for dashboard
     */
    public function statistics()
    {
        return [
            'total' => Ingredient::count(),
            'categories' => Ingredient::distinct('categorie')->count('categorie'),
            'most_used' => Ingredient::withCount('repasIngredients')
                ->orderBy('repas_ingredients_count', 'desc')
                ->first(),
            'recent_count' => Ingredient::where('created_at', '>=', now()->subDays(7))->count(),
        ];
    }
}

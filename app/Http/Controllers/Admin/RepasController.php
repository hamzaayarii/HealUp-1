<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Repas;
use App\Models\Ingredient;
use App\Models\RepasIngredient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepasController extends Controller
{
    /**
     * Display a listing of all meals with statistics
     */
    public function index(Request $request)
    {
        $query = Repas::with(['user', 'repasIngredients.ingredient']);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'LIKE', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }

        // Filter by meal type
        if ($request->has('type_repas') && $request->type_repas) {
            $query->where('type_repas', $request->type_repas);
        }

        // Filter by user
        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('date_consommation', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('date_consommation', '<=', $request->date_to);
        }

        // Sort
        $sortBy = $request->get('sort', 'date_consommation');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortBy, $sortDirection);

        $repas = $query->paginate(15);

        // Statistics
        $stats = [
            'total' => Repas::count(),
            'today' => Repas::whereDate('date_consommation', today())->count(),
            'this_week' => Repas::whereBetween('date_consommation', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Repas::whereMonth('date_consommation', now()->month)->count(),
            'avg_calories' => round(Repas::avg('calories_total'), 2),
            'total_calories' => round(Repas::sum('calories_total'), 2),
            'by_type' => Repas::selectRaw('type_repas, COUNT(*) as count')
                ->groupBy('type_repas')
                ->get(),
            'active_users' => Repas::distinct('user_id')->count('user_id'),
            'top_users' => Repas::select('user_id', DB::raw('COUNT(*) as meal_count'))
                ->groupBy('user_id')
                ->orderBy('meal_count', 'desc')
                ->take(5)
                ->with('user')
                ->get(),
        ];

        // Get users for filter
        $users = User::orderBy('name')->get();

        return view('admin.repas.index', compact('repas', 'stats', 'users'));
    }

    /**
     * Display the specified meal with full details
     */
    public function show(Repas $repas)
    {
        $repas->load(['user', 'repasIngredients.ingredient']);

        // Nutritional breakdown
        $nutritionBreakdown = [
            'calories' => $repas->calories_total,
            'proteines' => $repas->proteines_total,
            'glucides' => $repas->glucides_total,
            'lipides' => $repas->lipides_total,
            'ingredients_count' => $repas->repasIngredients->count(),
        ];

        return view('admin.repas.show', compact('repas', 'nutritionBreakdown'));
    }

    /**
     * Show the form for creating a new meal (admin can create for any user)
     */
    public function create()
    {
        $ingredients = Ingredient::orderBy('nom')->get();
        $users = User::orderBy('name')->get();
        return view('admin.repas.create', compact('ingredients', 'users'));
    }

    /**
     * Store a newly created meal
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nom' => 'required|string|max:255',
            'type_repas' => 'required|in:petit-dejeuner,dejeuner,diner,collation',
            'date_consommation' => 'required|date',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.id' => 'required|integer|exists:ingredients,id',
            'ingredients.*.quantite' => 'required|numeric|min:1|max:2000',
        ]);

        $repas = new Repas();
        $repas->user_id = $validated['user_id'];
        $repas->nom = $validated['nom'];
        $repas->type_repas = $validated['type_repas'];
        $repas->date_consommation = $validated['date_consommation'];

        // Nutritional calculations
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

        // Create relationships
        foreach ($validated['ingredients'] as $ingData) {
            $ingredient = Ingredient::find($ingData['id']);
            $facteur = $ingData['quantite'] / 100;

            RepasIngredient::create([
                'repas_id' => $repas->id,
                'ingredient_id' => $ingData['id'],
                'quantite' => $ingData['quantite'],
                'calories_calculees' => $ingredient->calories_pour_100g * $facteur,
            ]);
        }

        return redirect()->route('admin.nutrition.repas.index')
            ->with('success', 'Meal created successfully!');
    }

    /**
     * Show the form for editing the specified meal
     */
    public function edit(Repas $repas)
    {
        $repas->load(['repasIngredients.ingredient']);
        $ingredients = Ingredient::orderBy('nom')->get();
        $users = User::orderBy('name')->get();
        return view('admin.repas.edit', compact('repas', 'ingredients', 'users'));
    }

    /**
     * Update the specified meal
     */
    public function update(Request $request, Repas $repas)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nom' => 'required|string|max:255',
            'type_repas' => 'required|in:petit-dejeuner,dejeuner,diner,collation',
            'date_consommation' => 'required|date',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.id' => 'required|integer|exists:ingredients,id',
            'ingredients.*.quantite' => 'required|numeric|min:1|max:2000',
        ]);

        $repas->user_id = $validated['user_id'];
        $repas->nom = $validated['nom'];
        $repas->type_repas = $validated['type_repas'];
        $repas->date_consommation = $validated['date_consommation'];

        // Nutritional recalculations
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

        // Delete old relationships and recreate
        RepasIngredient::where('repas_id', $repas->id)->delete();

        foreach ($validated['ingredients'] as $ingData) {
            $ingredient = Ingredient::find($ingData['id']);
            $facteur = $ingData['quantite'] / 100;

            RepasIngredient::create([
                'repas_id' => $repas->id,
                'ingredient_id' => $ingData['id'],
                'quantite' => $ingData['quantite'],
                'calories_calculees' => $ingredient->calories_pour_100g * $facteur,
            ]);
        }

        return redirect()->route('admin.nutrition.repas.show', $repas)
            ->with('success', 'Meal updated successfully!');
    }

    /**
     * Remove the specified meal
     */
    public function destroy(Repas $repas)
    {
        try {
            RepasIngredient::where('repas_id', $repas->id)->delete();
            $repas->delete();

            return redirect()->route('admin.nutrition.repas.index')
                ->with('success', 'Meal deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.nutrition.repas.index')
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Get nutrition statistics for dashboard
     */
    public function statistics()
    {
        return [
            'total_meals' => Repas::count(),
            'today_meals' => Repas::whereDate('date_consommation', today())->count(),
            'avg_calories' => round(Repas::avg('calories_total'), 2),
            'total_users' => Repas::distinct('user_id')->count('user_id'),
        ];
    }
}

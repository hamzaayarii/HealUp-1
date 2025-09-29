<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Habit;
use App\Models\Category;
use Illuminate\Http\Request;

class HabitController extends Controller
{
    public function index(Request $request)
    {
        $query = Habit::with(['category', 'user']);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter by frequency
        if ($request->has('frequency') && $request->frequency) {
            $query->where('frequency', $request->frequency);
        }

        $habits = $query->orderBy('created_at', 'desc')->paginate(12);
        $categories = Category::all();

        return view('admin.habits.index', compact('habits', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.habits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'frequency' => 'required|in:daily,weekly,monthly',
            'difficulty_level' => 'required|in:easy,medium,hard',
            'points_per_completion' => 'required|integer|min:0',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
        ]);

        $validated['user_id'] = auth()->id();

        Habit::create($validated);

        return redirect()->route('admin.habits.index')
            ->with('success', 'Habit template created successfully!');
    }

    public function show(Habit $habit)
    {
        $habit->load(['category', 'user', 'userHabits.user', 'userHabits.dailyProgress']);
        $habit->loadCount('userHabits');

        return view('admin.habits.show', compact('habit'));
    }

    public function edit(Habit $habit)
    {
        $categories = Category::all();
        return view('admin.habits.edit', compact('habit', 'categories'));
    }

    public function update(Request $request, Habit $habit)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'frequency' => 'required|in:daily,weekly,monthly',
            'difficulty_level' => 'required|in:easy,medium,hard',
            'points_per_completion' => 'required|integer|min:0',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
        ]);

        $habit->update($validated);

        return redirect()->route('admin.habits.index')
            ->with('success', 'Habit template updated successfully!');
    }

    public function destroy(Habit $habit)
    {
        $habit->delete();

        return redirect()->route('admin.habits.index')
            ->with('success', 'Habit template deleted successfully!');
    }

    public function users(Habit $habit)
    {
        $userHabits = $habit->userHabits()
            ->with(['user', 'dailyProgress'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.habits.users', compact('habit', 'userHabits'));
    }
}

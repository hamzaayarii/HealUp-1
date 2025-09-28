<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\Category;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index(Request $request)
    {
        $query = Challenge::with(['category', 'user']);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        $challenges = $query->orderBy('created_at', 'desc')->paginate(12);
        $categories = Category::all();

        return view('admin.challenges.index', compact('challenges', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.challenges.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'duration_days' => 'required|integer|min:1|max:365',
            'difficulty_level' => 'required|in:easy,medium,hard',
            'points_reward' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['is_active'] = $request->has('is_active');

        Challenge::create($validated);

        return redirect()->route('admin.challenges.index')
            ->with('success', 'Challenge created successfully!');
    }

    public function show(Challenge $challenge)
    {
        $challenge->load(['category', 'user', 'participations.user']);

        return view('admin.challenges.show', compact('challenge'));
    }

    public function edit(Challenge $challenge)
    {
        $categories = Category::all();
        return view('admin.challenges.edit', compact('challenge', 'categories'));
    }

    public function update(Request $request, Challenge $challenge)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'duration_days' => 'required|integer|min:1|max:365',
            'difficulty_level' => 'required|in:easy,medium,hard',
            'points_reward' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $challenge->update($validated);

        return redirect()->route('admin.challenges.index')
            ->with('success', 'Challenge updated successfully!');
    }

    public function destroy(Challenge $challenge)
    {
        $challenge->delete();

        return redirect()->route('admin.challenges.index')
            ->with('success', 'Challenge deleted successfully!');
    }

    public function toggleStatus(Challenge $challenge)
    {
        $challenge->update(['is_active' => !$challenge->is_active]);

        return response()->json([
            'success' => true,
            'status' => $challenge->is_active,
            'message' => $challenge->is_active ? 'Challenge activated' : 'Challenge deactivated'
        ]);
    }

    public function participants(Challenge $challenge)
    {
        $participants = $challenge->participations()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.challenges.participants', compact('challenge', 'participants'));
    }
}

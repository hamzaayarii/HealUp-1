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
        $query = Challenge::withCount('participations');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        $challenges = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('admin.challenges.index', compact('challenges'));
    }

    public function create()
    {
        return view('admin.challenges.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'objectif' => 'nullable|string',
            'duration' => 'required|integer|min:1|max:365',
            'reward' => 'required|integer|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Challenge::create($validated);

        return redirect()->route('admin.challenges.index')
            ->with('success', 'Challenge created successfully!');
    }

    public function show(Challenge $challenge)
    {
        $challenge->load(['participations.user']);

        return view('admin.challenges.show', compact('challenge'));
    }

    public function edit(Challenge $challenge)
    {
        return view('admin.challenges.edit', compact('challenge'));
    }

    public function update(Request $request, Challenge $challenge)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'objectif' => 'nullable|string',
            'duration' => 'required|integer|min:1|max:365',
            'reward' => 'required|integer|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advice;
use App\Models\User;
use Illuminate\Http\Request;

class AdviceController extends Controller
{
    public function index(Request $request)
    {
        $query = Advice::with(['user', 'advisor']);

        // Filter by title (partial)
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Filter by source (partial)
        if ($request->filled('source')) {
            $query->where('source', 'like', '%' . $request->source . '%');
        }

        // Filter by specific user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by status (read/unread)
        if ($request->filled('status')) {
            if ($request->status === 'read') {
                $query->where('is_read', true);
            } elseif ($request->status === 'unread') {
                $query->where('is_read', false);
            }
        }

        $advices = $query->latest()->paginate(10)->withQueryString();

        // For the User dropdown in the filter
        $users = User::orderBy('name')->get();

        return view('admin.advices.index', compact('advices', 'users'));
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            return view('admin.advices.partials.advice-form');
        }

        return view('admin.advices.create'); // full page
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'source'  => 'required|in:AI,professor,system',
            'user_id' => 'required|exists:users,id',
        ]);

        Advice::create([
            'user_id'    => $request->user_id,
            'advisor_id' => auth()->id(),
            'title'      => $request->title,
            'content'    => $request->content,
            'source'     => $request->source,
            'is_read'    => false,
        ]);

        return redirect()->route('admin.advices.index')->with('success', 'Advice created successfully.');
    }

    public function update(Request $request, Advice $advice)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'source'  => 'required|in:AI,professor,system',
            'is_read' => 'boolean',
        ]);

        $advice->update($request->only(['title', 'content', 'source', 'is_read']));

        return redirect()->route('admin.advices.index')->with('success', 'Advice updated successfully.');
    }

    public function show(Request $request, Advice $advice)
    {
        // Load relationships for use in the Blade view
        $advice->load(['user', 'advisor']);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.advices.show', compact('advice'))->render(),
            ]);
        }

        return view('admin.advices.show', compact('advice'));
    }

    public function edit(Request $request, Advice $advice)
    {
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.advices.edit', compact('advice'))->render(),
            ]);
        }

        return view('admin.advices.edit', compact('advice'));
    }

    public function destroy(Advice $advice)
    {
        $advice->delete();
        return redirect()->route('admin.advices.index')->with('success', 'Advice deleted successfully.');
    }
}

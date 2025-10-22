<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    // Show details for a single event (admin view)
    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }
    // Show participants for a given event (admin view)
    public function participants($eventId)
    {
        $event = Event::with('users')->findOrFail($eventId);
        $participants = $event->users;
        return view('admin.events.participants', compact('event', 'participants'));
    }
    // Display a listing of events with optional search by title
    public function index(Request $request)
    {
        $query = Event::query();
        if ($request->filled('search')) {
            $query->where('events.title', 'like', '%' . $request->search . '%');
        }
        $sort = $request->input('sort', 'date');
        $direction = $request->input('direction', 'desc');
    $allowedSorts = ['date', 'category'];
        $allowedDirections = ['asc', 'desc'];
        if (!in_array($sort, $allowedSorts)) $sort = 'date';
        if (!in_array($direction, $allowedDirections)) $direction = 'desc';
        if ($sort === 'category') {
            $query->join('categories', 'events.category_id', '=', 'categories.id')
                  ->orderBy('categories.name', $direction)
                  ->select('events.*');
        } else {
            $query->orderBy($sort, $direction);
        }
        $events = $query->paginate(20)->appends(['search' => $request->search, 'sort' => $sort, 'direction' => $direction]);
        return view('admin.events.index', compact('events', 'sort', 'direction'));
    }

    // Show the form for creating a new event
    public function create()
    {
        $categories = \App\Models\Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.events.create', compact('categories'));
    }

    // Store a newly created event
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_participants' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
        ]);
        $validated['current_participants'] = 0;
        $validated['is_active'] = true;
        Event::create($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    // Show the form for editing an event
    public function edit(Event $event)
    {
        $categories = \App\Models\Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    // Update the specified event
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_participants' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
        ]);
        $event->update($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    // Remove the specified event
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}
